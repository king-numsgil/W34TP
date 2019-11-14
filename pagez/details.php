<?php
$result = $db->query("SELECT * FROM duplicants WHERE id = " . $_GET["id"]);

$row = $result->fetch_assoc();

$t_result = $db->query("
		SELECT traits.* FROM duplicants 
		INNER JOIN duplicant_traits
		ON duplicants.id = duplicant_traits.dupe_id
		INNER JOIN traits
		ON duplicant_traits.trait_id = traits.id
		WHERE duplicants.id = " . $_GET["id"]
);
?>
<div class="row justify-content-center">
	<div class="col-8">
		<div class="card" style="border-radius: .25rem .25rem 20px .25rem;">
			<div class="card-header text-center"><h4><?= $row["name"] ?></h4></div>
			<div class="card-body" style="padding: 0 15px 0 0;">
				<div class="row">
					<div class="col-lg-8" style="padding-right: 0">
						<img class="img-fluid" style="width: 100%" src="<?= $row["picture"] ?>" alt="Dupe"/>
						<table style="background-color: lightgrey; width:100%">
							<?php while ($traits_row = $t_result->fetch_assoc()) { ?>
								<tr>
									<td>
										<?php if ($traits_row["is_positive"] == true) { ?>
											<h5 style="color:green; margin: 0"><?= $traits_row["title"] ?></h5>
										<?php } else { ?>
											<h5 style="color:red; margin: 0"><?= $traits_row["title"] ?></h5>
										<?php } ?>
									</td>
								</tr>
								<tr>
									<td><?= $traits_row["description"] ?></td>
								</tr>
							<?php } ?>
						</table>
					</div>
					<div class="col-lg-4" style="padding-right: 0">
						<table class="table table-sm table-borderless table-striped table-hover text-monospace stat-block">
							<tbody>
								<tr><td>Agriculture</td><td><?= $row["attr_agriculture"] ?></td></tr>
								<tr><td>Athletics</td><td><?= $row["attr_athletics"] ?></td></tr>
								<tr><td>Construction</td><td><?= $row["attr_construction"] ?></td></tr>
								<tr><td>Creativity</td><td><?= $row["attr_creativity"] ?></td></tr>
								<tr><td>Cuisine</td><td><?= $row["attr_cuisine"] ?></td></tr>
								<tr><td>Excavation</td><td><?= $row["attr_excavation"] ?></td></tr>
								<tr><td>Husbandry</td><td><?= $row["attr_husbandry"] ?></td></tr>
								<tr><td>Machinery</td><td><?= $row["attr_machinery"] ?></td></tr>
								<tr><td>Medicine</td><td><?= $row["attr_medicine"] ?></td></tr>
								<tr><td>Science</td><td><?= $row["attr_science"] ?></td></tr>
								<tr><td>Strength</td><td><?= $row["attr_strength"] ?></td></tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<div class="card-footer" style="padding: 0">
				<div class="btn-group" style="width: 100%" role="group" aria-label="Dupe Footer">
					<a class="btn btn-sm btn-light disabled" style="border-top-left-radius: 0" href="#">Interested?</a>
					<a class="btn btn-sm btn-success" style="border-top-right-radius: 0" href="index.php?page=cart&action=add&id=<?= $row["id"] ?>">
						Add to Cart
					</a>
				</div>
			</div>							
		</div>
	</div>
</div>
