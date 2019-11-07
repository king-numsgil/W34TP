<?php
$result = $db->query("SELECT * FROM duplicants");
?>
<div class="row">
	<?php
	while ($row = $result->fetch_assoc()) {
		?>
		<div class="col-lg-4 col-md-10 mt-auto">
			<div class="jumbotron">
				<h1 class="display-8">Dupe #<?= $row["id"] ?></h1>
				<p class="lead">Say hello to <?= $row["name"] ?></p>
				<img src="<?= $row['picture'] ?>" alt="Dupe"/>
				<hr class="my-4">
				<p>Interested?</p>
				<a class="btn btn-primary btn-sm" href="index.php?page=details&id=<?= $row["id"] ?>" role="button">
					Click for more details
				</a>
			</div>
		</div>
		<?php
	}
	?>
</div>
