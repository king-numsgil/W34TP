<?php
$user = null;

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
		<div class="row">
			<?php foreach ($_SESSION["cart"] as $id => $qty) {
				$row = $db->query("SELECT * FROM duplicants WHERE id = $id")->fetch_assoc();
				?>
				<div class="col-lg-4 col-md-10 mt-auto" style="margin-bottom: 1rem">
					<div class="card">
						<div class="card-header">Dupe #<?= $row["id"] ?></div>
						<img class="card-img-top" src="<?= $row['picture'] ?>" alt="Dupe"/>
						<div class="card-body">
							<p class="card-text">Say hello to <?= $row["name"] ?></p>
						</div>
						<div class="card-footer text-center" style="padding: 0">
							<div class="btn-toolbar justify-content-between" style="width: 100%">
								<div class="input-group input-group-sm">
									<div class="input-group-prepend">
										<button id="add<?= $id ?>" class="btn btn-success"
										        style="max-width: 2rem; border-top-left-radius: 0"
										        onclick="add(<?= $id ?>)">+</button>
									</div>
									<input id="qty<?= $id ?>" type="number" class="form-control form-control-sm"
									       style="max-width: 7.5rem" readonly
									       value="<?= $qty ?>" name="qty<?= $id ?>"/>
									<div class="input-group-append">
										<button id="sub<?= $id ?>" class="btn btn-success"
										        style="max-width: 2rem"
										        onclick="sub(<?= $id ?>)">-</button>
									</div>
								</div>
								<div class="btn-group" role="group" aria-label="Cart Actions">
									<a class="btn btn-sm btn-primary" href="index.php?page=details&id=<?= $id ?>">
										Details
									</a>
									<a class="btn btn-sm btn-danger" style="border-top-right-radius: 0" href="index.php?page=cart&action=remove&id=<?= $id ?>">
										Remove
									</a>
								</div>
							</div>

						</div>
					</div>
				</div>
			<?php } ?>
		</div>
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
