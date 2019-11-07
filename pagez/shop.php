<?php
$result = $db->query("SELECT * FROM duplicants");
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
					<a class="btn-sm btn-primary float-md-right" href="index.php?page=details&id=<?= $row["id"] ?>">
						Details
					</a>
				</div>
			</div>
		</div>
	<?php } ?>
</div>
