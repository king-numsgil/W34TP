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
						<p class="card-text">Say hello to <?= $row["name"] ?></p>
					</div>
					<ul class="list-group list-group-flush">
						<?php
							$traits = $db->query("
								SELECT title, is_positive FROM traits 
								INNER JOIN duplicant_traits 
								ON duplicant_traits.trait_id = traits.id
								INNER JOIN duplicants
								ON duplicants.id = duplicant_traits.dupe_id
								WHERE duplicants.id = {$row["id"]}
								");
							while($t_row = $traits->fetch_assoc()){	
								if($t_row["is_positive"] == true){
								?>
							<li class="list-group-item" style="color:green"><?= $t_row["title"]?></li>
						<?php
								}
								else{
						?>
							<li class="list-group-item" style="color:red"><?= $t_row["title"]?></li>
						<?php
								}
							}
						?>
						<li class="list-group-item text-muted" style="padding: 4px 20px;">
							<small><?= $row["price"] ?>$ Each</small>
						</li>
					</ul>
					<div class="card-footer" style="padding: 0">
						<div class="btn-group" style="width: 100%" role="group" aria-label="Dupe Footer">
							<a class="btn btn-sm btn-light disabled" style="border-top-left-radius: 0" href="#">Interested?</a>
							<a class="btn btn-sm btn-success" href="index.php?page=cart&action=add&id=<?= $row["id"] ?>">
								Add to Cart
							</a>
							<a class="btn btn-sm btn-primary" style="border-top-right-radius: 0" href="index.php?page=details&id=<?= $row["id"] ?>">
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
				<a class="btn btn-outline-danger" href="index.php?page=shop&offset=<?= max($offset - $limit, 0) ?>&limit=<?= $limit ?>">
					Previous <?= $limit ?>
				</a>
			<?php } else { ?>
				<a class="btn btn-outline-danger disabled" href="#">Previous <?= $limit ?></a>
			<?php } ?>
		</div>
		<div class="col text-right">
			<?php if ($offset < $count - $limit) { ?>
				<a class="btn btn-outline-danger" href="index.php?page=shop&offset=<?= min($offset + $limit, $count - $limit) ?>&limit=<?= $limit ?>">
					Next <?= $limit ?>
				</a>
			<?php } else { ?>
				<a class="btn btn-outline-danger disabled" href="#">Next <?= $limit ?></a>
			<?php } ?>
		</div>
	</div>
<?php } ?>