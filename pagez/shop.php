<?php
if (isset($_GET["clear"])) {
	$_SESSION["search"]["good"] = 0;
	$_SESSION["search"]["bad"] = 0;
	header("Location: index.php?page=shop&offset=0&limit=6");
	die();
}
if (!isset($_GET["offset"]) || !isset($_GET["limit"])) {
	header("Location: index.php?page=shop&offset=0&limit=6");
	die();
} else {
	$filter = " ";
	if (!isset($_SESSION["search"])) {
		$_SESSION["search"] = array();
		$_SESSION["search"]["good"] = 0;
		$_SESSION["search"]["bad"] = 0;
	}
	if (isset($_POST["trait_good"]) && isset($_POST["trait_bad"]) &&
		$_POST["trait_good"] != 0 && $_POST["trait_bad"] != 0) {
		$_SESSION['search']['good'] = $_POST['trait_good'];
		$_SESSION['search']['bad'] = $_POST['trait_bad'];
	} else {
		if (isset($_POST["trait_good"]) && $_POST["trait_good"] != 0) {
			$_SESSION["search"]["good"] = $_POST["trait_good"];
			$_SESSION['search']['bad'] = 0;
		}
		if (isset($_POST["trait_bad"]) && $_POST["trait_bad"] != 0) {
			$_SESSION['search']['bad'] = $_POST['trait_bad'];
			$_SESSION['search']['good'] = 0;
		}
	}
	if ($_SESSION["search"]["good"] != 0 && $_SESSION["search"]["bad"] != 0) {
		$filter = "INNER JOIN duplicant_traits ON duplicants.id = duplicant_traits.dupe_id
		WHERE duplicant_traits.trait_id = {$_SESSION['search']['good']}
			OR duplicant_traits.trait_id = {$_SESSION['search']['bad']}
		GROUP BY duplicants.id";
	} else if ($_SESSION["search"]["good"] != 0) {
		$filter = "INNER JOIN duplicant_traits ON duplicants.id = duplicant_traits.dupe_id
		WHERE duplicant_traits.trait_id = {$_SESSION['search']['good']}";
	} else if ($_SESSION['search']['bad'] != 0) {
		$filter = "INNER JOIN duplicant_traits ON duplicants.id = duplicant_traits.dupe_id
		WHERE duplicant_traits.trait_id = {$_SESSION['search']['bad']}";
	} else {
		$filter = "";
	}

	$offset = $_GET["offset"];
	$limit = $_GET["limit"];
	$count = $db->query("SELECT COUNT(id) FROM duplicants " . $filter)->fetch_assoc()["COUNT(id)"];
	$result = $db->query("SELECT * FROM duplicants " . $filter . " LIMIT $limit OFFSET $offset");

	$traits_good = $db->query("SELECT title, id FROM traits WHERE is_positive = true");
	$traits_bad = $db->query("SELECT title, id FROM traits WHERE is_positive = false");
	?>
	<button class="btn btn-primary mb-3" type="button" data-toggle="collapse" data-target="#filter"
	        aria-expanded="false" aria-controls="filter">
		Traits Filter
	</button>
	<button class="btn btn-warning mb-3" type="button" onclick="window.location='index.php?page=shop&clear'">
		Clear Filters
	</button>
	<div class="collapse bg-light" style="padding:12px" id="filter">
		<!-- Form for search filters -->
		<form action="#" method="post" class="row">
			<div class="col-12 text-muted mb-2">
				Pick what you want in your dupe : a good trait, a bad trait, or both! We'll sort out the duplicants with
				those traits for you.
			</div>
			<div class="col-md-6">
				<select name="trait_good" class="browser-default custom-select custom-select-lg mb-3">
					<option class="text-muted" value="0">-- Good Traits --</option>
					<?php while ($good_row = $traits_good->fetch_assoc()) { ?>
						<option value="<?= $good_row["id"] ?>" <?= (isset($_POST["trait_good"]) && $_POST["trait_good"] === $good_row["id"]) ? 'selected' : '' ?>><?= $good_row["title"] ?></option>
					<?php } ?>
				</select>
			</div>
			<div class="col-md-6">
				<select name="trait_bad" class="browser-default custom-select custom-select-lg mb-3">
					<option class="text-muted" value="0">-- Bad Traits --</option>
					<?php while ($bad_row = $traits_bad->fetch_assoc()) { ?>
						<option value="<?= $bad_row["id"] ?>" <?= (isset($_POST["trait_bad"]) && $_POST["trait_bad"] === $bad_row["id"]) ? 'selected' : '' ?>><?= $bad_row["title"] ?></option>
					<?php } ?>
				</select>
			</div>
			<div class="col-12">
				<button type="submit" class="btn btn-success btn-block">
					Search
				</button>
			</div>
		</form>
		<!-- End of Form for search filters -->
	</div>
	
	<div class="row" style="margin-bottom:16px;">
		<div class="col text-left">
			<?php if ($offset > 0) { ?>
				<a class="btn btn-outline-danger"
				   href="index.php?page=shop&offset=<?= max($offset - $limit, 0) ?>&limit=<?= $limit ?>">
					Previous <?= $limit ?>
				</a>
			<?php } else { ?>
				<a class="btn btn-outline-danger disabled" href="#">Previous <?= $limit ?></a>
			<?php } ?>
		</div>
		<div class="col text-right">
			<?php if ($offset < $count - $limit) { ?>
				<a class="btn btn-outline-danger"
				   href="index.php?page=shop&offset=<?= min($offset + $limit, $count - $limit) ?>&limit=<?= $limit ?>">
					Next <?= $limit ?>
				</a>
			<?php } else { ?>
				<a class="btn btn-outline-danger disabled" href="#">Next <?= $limit ?></a>
			<?php } ?>
		</div>
	</div>

	<div class="row align-items-start">
		<?php while ($row = $result->fetch_assoc()) { ?>
			<div class="col-lg-4 col-md-10" style="margin-bottom: 1rem">
				<div class="card">
					<div class="card-header">Dupe #<?= $row["id"] ?></div>
					<img class="card-img-top" src="<?= $row['picture'] ?>" alt="Dupe"/>
					<div class="card-body">
						<p class="card-text">Say hello to <?= $row["name"] ?></p>
					</div>
					<ul class="list-group list-group-flush">
						<?php
						$dupe_traits = $db->query("
								SELECT title, is_positive FROM traits 
								INNER JOIN duplicant_traits 
								ON duplicant_traits.trait_id = traits.id
								INNER JOIN duplicants
								ON duplicants.id = duplicant_traits.dupe_id
								WHERE duplicants.id = {$row["id"]}
								");
						while ($t_row = $dupe_traits->fetch_assoc()) {
							if ($t_row["is_positive"] == true) { ?>
								<li class="list-group-item" style="color:green"><?= $t_row["title"] ?></li>
							<?php } else { ?>
								<li class="list-group-item" style="color:red"><?= $t_row["title"] ?></li>
							<?php }
						} ?>
						<li class="list-group-item text-muted" style="padding: 4px 20px;">
							<small><?= $row["price"] ?>$ Each</small>
						</li>
					</ul>
					<div class="card-footer" style="padding: 0; border: 0">
						<div class="btn-group" style="width: 100%" role="group" aria-label="Dupe Footer">
							<a class="btn btn-sm btn-light disabled" style="border-top-left-radius: 0" href="#">Interested?</a>
							<a class="btn btn-sm btn-success"
							   href="index.php?page=cart&action=add&id=<?= $row["id"] ?>">
								Add to Cart
							</a>
							<a class="btn btn-sm btn-primary" style="border-top-right-radius: 0"
							   href="index.php?page=details&id=<?= $row["id"] ?>">
								Details
							</a>
						</div>
					</div>
				</div>
			</div>
		<?php } ?>

	</div>
	<div class="row">
		<div class="col text-left">
			<?php if ($offset > 0) { ?>
				<a class="btn btn-outline-danger"
				   href="index.php?page=shop&offset=<?= max($offset - $limit, 0) ?>&limit=<?= $limit ?>">
					Previous <?= $limit ?>
				</a>
			<?php } else { ?>
				<a class="btn btn-outline-danger disabled" href="#">Previous <?= $limit ?></a>
			<?php } ?>
		</div>
		<div class="col text-right">
			<?php if ($offset < $count - $limit) { ?>
				<a class="btn btn-outline-danger"
				   href="index.php?page=shop&offset=<?= min($offset + $limit, $count - $limit) ?>&limit=<?= $limit ?>">
					Next <?= $limit ?>
				</a>
			<?php } else { ?>
				<a class="btn btn-outline-danger disabled" href="#">Next <?= $limit ?></a>
			<?php } ?>
		</div>
	</div>
<?php } ?>