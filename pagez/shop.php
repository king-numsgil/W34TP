<?php
if (!isset($_GET["offset"]) || !isset($_GET["limit"])) {
	header("Location: index.php?page=shop&offset=0&limit=3");
	die();
} else {
	$offset = $_GET["offset"]; $limit = $_GET["limit"];
	$count = $db->query("SELECT COUNT(id) FROM duplicants")->fetch_assoc()["COUNT(id)"];
	$result = $db->query("SELECT * FROM duplicants LIMIT $limit OFFSET $offset");
?>
	<div class="row">
		<?php while ($row = $result->fetch_assoc()) { ?>
			<div class="col-lg-4 col-md-10 mt-auto" style="margin-bottom: 1rem">
				<div class="card">
					<div class="card-header">Dupe #<?= $row["id"] ?></div>
					<img class="card-img-top" src="<?= $row['picture'] ?>" alt="Dupe"/>
					<div class="card-body">
						<p class="card-text" style="margin-top: 0">Say hello to <?= $row["name"] ?></p>
					</div>
					<div class="card-footer clearfix">
						Interested?
						<div class="btn-group float-md-right" role="group" aria-label="Basic example">
							<a class="btn btn-sm btn-success" href="index.php?page=cart&action=add&id=<?= $row["id"] ?>">
								Add to Cart
							</a>
							<a class="btn btn-sm btn-primary" href="index.php?page=details&id=<?= $row["id"] ?>">
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
				<a class="btn btn-outline-danger" href="index.php?page=shop&offset=<?= min($offset - $limit, 0) ?>&limit=<?= $limit ?>">
					Previous <?= $limit ?>
				</a>
			<?php } else { ?>
				<a class="btn btn-outline-danger disabled" href="#">Previous <?= $limit ?></a>
			<?php } ?>
		</div>
		<div class="col text-right">
			<?php if ($offset < $count - $limit) { ?>
				<a class="btn btn-outline-danger" href="index.php?page=shop&offset=<?= max($offset + $limit, $count - $limit) ?>&limit=<?= $limit ?>">
					Next <?= $limit ?>
				</a>
			<?php } else { ?>
				<a class="btn btn-outline-danger disabled" href="#">Next <?= $limit ?></a>
			<?php } ?>
		</div>
	</div>
<?php } ?>