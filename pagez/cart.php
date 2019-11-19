<?php
$user = null;

setlocale(LC_MONETARY, 'en_CA');
function money_format($format, $number) {
	$regex = '/%((?:[\^!\-]|\+|\(|\=.)*)([0-9]+)?' .
		'(?:#([0-9]+))?(?:\.([0-9]+))?([in%])/';
	if (setlocale(LC_MONETARY, 0) == 'C') {
		setlocale(LC_MONETARY, '');
	}
	$locale = localeconv();
	preg_match_all($regex, $format, $matches, PREG_SET_ORDER);
	foreach ($matches as $fmatch) {
		$value = floatval($number);
		$flags = array(
			'fillchar' => preg_match('/\=(.)/', $fmatch[1], $match) ? $match[1] : ' ',
			'nogroup' => preg_match('/\^/', $fmatch[1]) > 0,
			'usesignal' => preg_match('/\+|\(/', $fmatch[1], $match) ? $match[0] : '+',
			'nosimbol' => preg_match('/\!/', $fmatch[1]) > 0,
			'isleft' => preg_match('/\-/', $fmatch[1]) > 0,
		);
		$width = trim($fmatch[2]) ? (int)$fmatch[2] : 0;
		$left = trim($fmatch[3]) ? (int)$fmatch[3] : 0;
		$right = trim($fmatch[4]) ? (int)$fmatch[4] : $locale['int_frac_digits'];
		$conversion = $fmatch[5];

		$positive = true;
		if ($value < 0) {
			$positive = false;
			$value *= -1;
		}
		$letter = $positive ? 'p' : 'n';

		$prefix = $suffix = $cprefix = $csuffix = $signal = '';

		$signal = $positive ? $locale['positive_sign'] : $locale['negative_sign'];
		switch (true) {
			case $locale["{$letter}_sign_posn"] == 1 && $flags['usesignal'] == '+':
				$prefix = $signal;
				break;
			case $locale["{$letter}_sign_posn"] == 2 && $flags['usesignal'] == '+':
				$suffix = $signal;
				break;
			case $locale["{$letter}_sign_posn"] == 3 && $flags['usesignal'] == '+':
				$cprefix = $signal;
				break;
			case $locale["{$letter}_sign_posn"] == 4 && $flags['usesignal'] == '+':
				$csuffix = $signal;
				break;
			case $flags['usesignal'] == '(':
			case $locale["{$letter}_sign_posn"] == 0:
				$prefix = '(';
				$suffix = ')';
				break;
		}
		if (!$flags['nosimbol']) {
			$currency = $cprefix .
				($conversion == 'i' ? $locale['int_curr_symbol'] : $locale['currency_symbol']) . $csuffix;
		} else {
			$currency = '';
		}
		$space = $locale["{$letter}_sep_by_space"] ? ' ' : '';

		$value = number_format($value, $right, $locale['mon_decimal_point'], $flags['nogroup'] ? '' : $locale['mon_thousands_sep']);
		$value = @explode($locale['mon_decimal_point'], $value);

		$n = strlen($prefix) + strlen($currency) + strlen($value[0]);
		if ($left > 0 && $left > $n) {
			$value[0] = str_repeat($flags['fillchar'], $left - $n) . $value[0];
		}
		$value = implode($locale['mon_decimal_point'], $value);
		if ($locale["{$letter}_cs_precedes"]) {
			$value = $prefix . $currency . $space . $value . $suffix;
		} else {
			$value = $prefix . $value . $space . $currency . $suffix;
		}
		if ($width > 0) {
			$value = str_pad($value, $width, $flags['fillchar'], $flags['isleft'] ? STR_PAD_RIGHT : STR_PAD_LEFT);
		}

		$format = str_replace($fmatch[0], $value, $format);
	}
	return $format;
}

if (!isset($_SESSION["cart"])) {
	$_SESSION["cart"] = array();
}

if (isset($_SESSION["login"])) {
	$user = $db->query("SELECT * FROM users WHERE email = '{$_SESSION["login"]}'")->fetch_assoc();
}

if (isset($_GET["action"])) {
	if (empty($_GET["action"])) {
		header("Location: index.php?page=cart");
		die();
	}

	$action = $_GET["action"];
	if ($action === "add" && isset($_GET["id"])) {
		if (isset($_SESSION["cart"][$_GET["id"]])) {
			$_SESSION["cart"][$_GET["id"]]++;
		} else {
			$_SESSION["cart"][$_GET["id"]] = 1;
		}

		header("Location: index.php?page=cart");
		die();
	}
	if ($action === "remove" && isset($_GET["id"])) {
		if (isset($_SESSION["cart"][$_GET["id"]])) {
			unset($_SESSION["cart"][$_GET["id"]]);
		}
		header("Location: index.php?page=cart");
		die();
	}
	if ($action === "update") {
		foreach ($_POST as $name => $qty) {
			if (substr($name, 0, 3) === "qty") {
				$id = intval(substr($name, 3));
				$_SESSION["cart"][$id] = $qty;
			}
		}
		header("Location: index.php?page=cart");
		die();
	}
} else {
	if (count($_SESSION["cart"]) === 0) { ?>
		<div class="row justify-content-center">
			<div class="col-md-4">
				<div class="card text-center">
					<div class="card-header">Your Cart</div>
					<div class="card-body">
						<p class="card-text" style="margin-top: 0">Your Cart is empty!</p>
					</div>
					<div class="card-footer">
						<a class="btn btn-link" href="index.php?page=shop">
							See the shop!
						</a>
					</div>
				</div>
			</div>
		</div>
	<?php } else { ?>
		<form method="post" action="index.php?page=cart&action=update">
			<div class="row">
				<?php $subtotal = 0.0;
				foreach ($_SESSION["cart"] as $id => $qty) {
					$row = $db->query("SELECT * FROM duplicants WHERE id = $id")->fetch_assoc();
					$subtotal += $row["price"] * $qty;
					?>
					<div class="col-lg-4 col-md-10 mt-auto" style="margin-bottom: 1rem">
						<div class="card">
							<div class="card-header">Dupe #<?= $row["id"] ?></div>
							<img class="card-img-top" src="<?= $row['picture'] ?>" alt="Dupe"/>
							<div class="card-body">
								<p class="card-text">Say hello to <?= $row["name"] ?></p>
							</div>
							<ul class="list-group list-group-flush">
								<li class="list-group-item text-muted" style="padding: 4px 20px;">
									<small><?= $row["price"] ?>$ Each</small>
								</li>
							</ul>
							<div class="card-footer text-center" style="padding: 0">
								<div class="btn-toolbar justify-content-between" style="width: 100%">
									<div class="input-group input-group-sm">
										<div class="input-group-prepend">
											<button id="add<?= $id ?>" type="button" class="btn btn-success"
											        style="max-width: 2rem; border-top-left-radius: 0"
											        onclick="add(<?= $id ?>)">+
											</button>
										</div>
										<input id="qty<?= $id ?>" type="number" class="form-control form-control-sm"
										       style="max-width: 7.5rem" readonly
										       value="<?= $qty ?>" name="qty<?= $id ?>"/>
										<div class="input-group-append">
											<button id="sub<?= $id ?>" type="button" class="btn btn-success"
											        style="max-width: 2rem"
											        onclick="sub(<?= $id ?>)">-
											</button>
										</div>
									</div>
									<div class="btn-group" role="group" aria-label="Cart Actions">
										<a class="btn btn-sm btn-primary" href="index.php?page=details&id=<?= $id ?>">
											Details
										</a>
										<a class="btn btn-sm btn-danger" style="border-top-right-radius: 0"
										   href="index.php?page=cart&action=remove&id=<?= $id ?>">
											Remove
										</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				<?php } ?>
			</div>
			<div class="row justify-content-between align-items-end">
				<div class="col-3">
					<button type="submit" class="btn btn-lg btn-warning btn-block">Update Cart</button>
				</div>
				<div class="col-3">
					<ul class="list-group list-group-flush text-right">
						<li class="list-group-item">
							Subtotal : <?= money_format('%.2n', $subtotal) ?>
						</li>
						<li class="list-group-item">
							Taxes : <?= money_format('%.2n', $subtotal * 0.15) ?>
						</li>
						<li class="list-group-item">
							Total : <?= money_format('%.2n', $subtotal + ($subtotal * 0.15)) ?>
						</li>
						<li class="list-group-item" style="padding: 0">
							<a class="btn btn-lg btn-success btn-block" href="#">
								Checkout
							</a>
						</li>
					</ul>
				</div>
			</div>
		</form>
	<?php }
} ?>

<script>
	function add(id) {
		let qty = document.getElementById("qty" + id);
		qty.value = qty.valueAsNumber + 1;
	}

	function sub(id) {
		let qty = document.getElementById("qty" + id);
		if (qty.valueAsNumber >= 1) {
			qty.value = qty.valueAsNumber - 1;
		}
	}
</script>
