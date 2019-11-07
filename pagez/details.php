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
			<div class="card-header text-center"><?= $row["name"] ?></div>
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
					<div class="col-lg-4 stat-block">
						<div class="row stats">Agriculture : <?= $row["attr_agriculture"] ?></div>
						<div class="row stats">Athletics : <?= $row["attr_athletics"] ?></div>
						<div class="row stats">Construction : <?= $row["attr_construction"] ?></div>
						<div class="row stats">Creativity : <?= $row["attr_creativity"] ?></div>
						<div class="row stats">Cuisine : <?= $row["attr_cuisine"] ?></div>
						<div class="row stats">Excavation : <?= $row["attr_excavation"] ?></div>
						<div class="row stats">Husbandry : <?= $row["attr_husbandry"] ?></div>
						<div class="row stats">Machinery : <?= $row["attr_machinery"] ?></div>
						<div class="row stats">Medicine : <?= $row["attr_medicine"] ?></div>
						<div class="row stats">Science : <?= $row["attr_science"] ?></div>
						<div class="row stats">Strength : <?= $row["attr_strength"] ?></div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
