<?php
	$result = $db->query("SELECT * FROM duplicants WHERE id = ". $_GET["id"]);
?>
<!--<div class="row">
	<?php #while ($row = $result->fetch_assoc()) { ?>
		<div class="col-lg-12 col-md-16 mt-auto">
			<div class="">
				
			</div>
		</div>-->
		<div class="container">
		  <div class="row">
		    <div class="col-sm-9">
		      Level 1: .col-sm-9
		      <div class="row">
		        <div class="col-8 col-sm-6">
		          Level 2: .col-8 .col-sm-6
		        </div>
		        <div class="col-4 col-sm-6">
		          Level 2: .col-4 .col-sm-6
		        </div>
		      </div>
		    </div>
		  </div>
		</div>





		<!--<div class="col-lg-4 col-md-10 mt-auto" style="margin-bottom: 1rem">
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
		</div>-->
	<?php } ?>
</div>