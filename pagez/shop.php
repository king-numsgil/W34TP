<?php
	$mysqli = new mysqli('localhost','dupe_store','ewHE4eNuPikdxIxP','dupe_store');

	$query = "SELECT * FROM duplicants";

	$result = $mysqli->query($query);
?>
<div class="container">
	<div class="row">
<?php
	while ($row = $result->fetch_assoc()) {
?>
<!--<div class="container">
	<div class="row">
		<div class="col-lg-8 col-md-10 mx-auto">
			<div class="jumbotron">
				<h1 class="display-8">Dupe #0</h1>
				<p class="lead">His name is John</p>
				<img src="pics_test/03.png">
				<hr class="my-4">
				<p>Interested?</p>
				<a class="btn btn-primary btn-sm" href="index.php?page=details&id=" role="button">Click for more details</a>
			</div>
		</div>
	</div>
</div>-->

		<div class="col-lg-4 col-md-10 mt-auto">
			<div class="jumbotron">
				<h1 class="display-8">Dupe #<?=$row["id"]?></h1>
				<p class="lead">Say hello to <?=$row["name"]?></p>
				<img src="<?=$row['picture']?>">
				<hr class="my-4">
				<p>Interested?</p>
				<a class="btn btn-primary btn-sm" href="index.php?page=details&id=<?=$row["id"]?>" role="button">Click for more details</a>
			</div>
		</div>
<?php
	}
?>
	</div>
</div>