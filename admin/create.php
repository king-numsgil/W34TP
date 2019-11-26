<?php
if (!isset($_GET["mode"]) || empty($_GET["mode"])) {
	header("Location: index.php?page=admin&action=create&mode=dupe");
	die();
}

$mode = $_GET["mode"];
?>

<h1>Create</h1>
<ul class="nav nav-tabs">
	<li class="nav-item">
		<a class="nav-link <?= $mode === "dupe" ? "active" : "" ?>"
		   href="index.php?page=admin&action=create&mode=dupe">
			Duplicant
		</a>
	</li>
	<li class="nav-item">
		<a class="nav-link <?= $mode === "trait" ? "active" : "" ?>"
		   href="index.php?page=admin&action=create&mode=trait">
			Trait
		</a>
	</li>
</ul>

<?php if ($mode === "dupe") {
	if (isset($_GET["apply"])) {
		$db->query("INSERT INTO duplicants(name, attr_construction, attr_excavation, attr_machinery, " .
			"attr_athletics, attr_science, attr_cuisine, attr_creativity, attr_strength, attr_medicine, " .
			"attr_agriculture, attr_husbandry, picture, price) VALUES (" .
			"'{$_POST["name"]}', " .
			"'{$_POST["construction"]}', " .
			"'{$_POST["excavation"]}', " .
			"'{$_POST["machinery"]}', " .
			"'{$_POST["athletics"]}', " .
			"'{$_POST["science"]}', " .
			"'{$_POST["cuisine"]}', " .
			"'{$_POST["creativity"]}', " .
			"'{$_POST["strength"]}', " .
			"'{$_POST["medicine"]}', " .
			"'{$_POST["agriculture"]}', " .
			"'{$_POST["husbandry"]}', " .
			"'{$_POST["pic"]}', " .
			"'{$_POST["price"]}'" .
			")");
		$id = $db->query("SELECT LAST_INSERT_ID()")->fetch_assoc()["LAST_INSERT_ID()"];
		$db->query("INSERT INTO duplicant_traits(dupe_id, trait_id) VALUES " .
			"($id, {$_POST["positive"]}), " .
			"($id, {$_POST["negative"]})");

		if ($_POST["extra"] === $_POST["positive"] || $_POST["extra"] === $_POST["negative"]) { ?>
			<h2>Can't have duplicate Traits!</h2>
			<?php
		} else {
			if ($_POST["extra"] !== 0) {
				$db->query("INSERT INTO duplicant_traits(dupe_id, trait_id) VALUES " .
					"($id, {$_POST["extra"]})");
			}
			header("Location: index.php?page=details&id=".$id);
			die();
		}
	} else { ?>

		<form class="mt-sm-4" method="post" action="index.php?page=admin&action=create&mode=dupe&apply">
			<div class="form-group row">
				<label for="dupe_name" class="col-sm-2 col-form-label">Name :</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" id="dupe_name" name="name" required maxlength="32"/>
				</div>
			</div>
			<div class="form-group row">
				<label for="dupe_pic" class="col-sm-2 col-form-label">Picture :</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" id="dupe_pic" name="pic" required maxlength="32"/>
				</div>
			</div>

			<div class="form-group row">
				<label for="dupe_agriculture" class="col-sm-2 col-form-label">Agriculture :</label>
				<div class="col-sm-4">
					<input type="number" class="form-control" id="dupe_agriculture" name="agriculture" required
					       value="0"
					       step="1" min="-5" max="10"/>
				</div>

				<label for="dupe_athletics" class="col-sm-2 col-form-label">Athletics :</label>
				<div class="col-sm-4">
					<input type="number" class="form-control" id="dupe_athletics" name="athletics" required value="0"
					       step="1" min="-5" max="10"/>
				</div>
			</div>

			<div class="form-group row">
				<label for="dupe_construction" class="col-sm-2 col-form-label">Construction :</label>
				<div class="col-sm-4">
					<input type="number" class="form-control" id="dupe_construction" name="construction" required
					       value="0" step="1" min="-5" max="10"/>
				</div>

				<label for="dupe_creativity" class="col-sm-2 col-form-label">Creativity :</label>
				<div class="col-sm-4">
					<input type="number" class="form-control" id="dupe_creativity" name="creativity" required value="0"
					       step="1" min="-5" max="10"/>
				</div>
			</div>

			<div class="form-group row">
				<label for="dupe_cuisine" class="col-sm-2 col-form-label">Cuisine :</label>
				<div class="col-sm-4">
					<input type="number" class="form-control" id="dupe_cuisine" name="cuisine" required value="0"
					       step="1" min="-5" max="10"/>
				</div>

				<label for="dupe_excavation" class="col-sm-2 col-form-label">Excavation :</label>
				<div class="col-sm-4">
					<input type="number" class="form-control" id="dupe_excavation" name="excavation" required value="0"
					       step="1" min="-5" max="10"/>
				</div>
			</div>

			<div class="form-group row">
				<label for="dupe_husbandry" class="col-sm-2 col-form-label">Husbandry :</label>
				<div class="col-sm-4">
					<input type="number" class="form-control" id="dupe_husbandry" name="husbandry" required value="0"
					       step="1" min="-5" max="10"/>
				</div>

				<label for="dupe_machinery" class="col-sm-2 col-form-label">Machinery :</label>
				<div class="col-sm-4">
					<input type="number" class="form-control" id="dupe_machinery" name="machinery" required value="0"
					       step="1" min="-5" max="10"/>
				</div>
			</div>

			<div class="form-group row">
				<label for="dupe_medicine" class="col-sm-2 col-form-label">Medicine :</label>
				<div class="col-sm-4">
					<input type="number" class="form-control" id="dupe_medicine" name="medicine" required value="0"
					       step="1" min="-5" max="10"/>
				</div>

				<label for="dupe_science" class="col-sm-2 col-form-label">Science :</label>
				<div class="col-sm-4">
					<input type="number" class="form-control" id="dupe_science" name="science" required value="0"
					       step="1" min="-5" max="10"/>
				</div>
			</div>

			<div class="form-group row">
				<label for="dupe_strength" class="col-sm-2 col-form-label">Strength :</label>
				<div class="col-sm-4">
					<input type="number" class="form-control" id="dupe_strength" name="strength" required value="0"
					       step="1" min="-5" max="10"/>
				</div>

				<label for="dupe_price" class="col-sm-2 col-form-label">Price :</label>
				<div class="col-sm-4">
					<input type="number" class="form-control" id="dupe_price" name="price" required value="0.0"
					       step="0.25" min="0" max="100"/>
				</div>
			</div>

			<div class="form-group row">
				<label for="dupe_positive" class="col-sm-2 col-form-label">Positive :</label>
				<div class="col-sm-2">
					<select class="form-control" id="dupe_positive" name="positive">
						<?php
						$result = $db->query("SELECT title, id FROM traits WHERE is_positive = true");
						while ($trait = $result->fetch_assoc()) { ?>
							<option value="<?= $trait["id"] ?>"><?= $trait["title"] ?></option>
						<?php } ?>
					</select>
				</div>

				<label for="dupe_negative" class="col-sm-2 col-form-label">Negative :</label>
				<div class="col-sm-2">
					<select class="form-control" id="dupe_negative" name="negative">
						<?php
						$result = $db->query("SELECT title, id FROM traits WHERE is_positive = false");
						while ($trait = $result->fetch_assoc()) { ?>
							<option value="<?= $trait["id"] ?>"><?= $trait["title"] ?></option>
						<?php } ?>
					</select>
				</div>

				<label for="dupe_extra" class="col-sm-2 col-form-label">Extra :</label>
				<div class="col-sm-2">
					<select class="form-control" id="dupe_extra" name="extra">
						<option value="0" selected>None</option>
						<?php
						$result = $db->query("SELECT title, id FROM traits");
						while ($trait = $result->fetch_assoc()) { ?>
							<option value="<?= $trait["id"] ?>"><?= $trait["title"] ?></option>
						<?php } ?>
					</select>
				</div>
			</div>

			<div class="form-group row justify-content-center">
				<div class="col-sm-9">
					<button type="submit" class="btn btn-block btn-warning">Save</button>
				</div>
			</div>
		</form>

	<?php }
} else {
	if (isset($_GET["apply"])) {
		$db->query("INSERT INTO traits(title, is_positive, description) VALUES " .
			"('{$_POST["title"]}', {$_POST["positive"]}, '{$_POST["desc"]}')");
		header("Location: index.php?page=admin&action=create&mode=trait");
		die();
	} else { ?>

		<form class="mt-sm-4" method="post" action="index.php?page=admin&action=create&mode=trait&apply">
			<div class="form-group row">
				<label for="trait_title" class="col-sm-2 col-form-label">Title :</label>
				<div class="col-sm-6">
					<input type="text" class="form-control" id="trait_title" name="title" required maxlength="64"/>
				</div>

				<label for="trait_positive" class="col-sm-2 col-form-label">Positive? :</label>
				<div class="col-sm-2">
					<select class="form-control" id="trait_positive" name="positive">
						<option value="true" selected>Positive</option>
						<option value="false">Negative</option>
					</select>
				</div>
			</div>
			<div class="form-group row">
				<label for="trait_description" class="col-sm-2 col-form-label">Description :</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" id="trait_description" name="desc" required/>
				</div>
			</div>

			<div class="form-group row justify-content-center">
				<div class="col-sm-9">
					<button type="submit" class="btn btn-block btn-warning">Save</button>
				</div>
			</div>
		</form>

	<?php }
} ?>

<hr/>
<a class="btn btn-block btn-success" href="index.php?page=admin">Back to Administration page</a>
