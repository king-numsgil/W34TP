<?php
if (!isset($_GET["mode"]) || empty($_GET["mode"])) {
	header("Location: index.php?page=admin&action=modify&mode=dupe");
	die();
}

$mode = $_GET["mode"];
$id = isset($_GET["id"]) ? $_GET["id"] : false;
?>

<h1>Modify</h1>
<ul class="nav nav-tabs">
	<li class="nav-item">
		<a class="nav-link <?= $mode === "dupe" ? "active" : "" ?>"
		   href="index.php?page=admin&action=modify&mode=dupe">
			Duplicant
		</a>
	</li>
	<li class="nav-item">
		<a class="nav-link <?= $mode === "trait" ? "active" : "" ?>"
		   href="index.php?page=admin&action=modify&mode=trait">
			Trait
		</a>
	</li>
</ul>

<?php if ($mode === "dupe") {
	if (isset($_GET["apply"])) {
		$db->query("UPDATE duplicants SET " .
			"attr_agriculture = {$_POST["agriculture"]}, " .
			"attr_athletics = {$_POST["athletics"]}, " .
			"attr_construction = {$_POST["construction"]}, " .
			"attr_creativity = {$_POST["creativity"]}, " .
			"attr_cuisine = {$_POST["cuisine"]}, " .
			"attr_excavation = {$_POST["excavation"]}, " .
			"attr_husbandry = {$_POST["husbandry"]}, " .
			"attr_machinery = {$_POST["machinery"]}, " .
			"attr_medicine = {$_POST["medicine"]}, " .
			"attr_science = {$_POST["science"]}, " .
			"attr_strength = {$_POST["strength"]}, " .
			"name = '{$_POST["name"]}', " .
			"price = {$_POST["price"]}, " .
			"picture = '{$_POST["pic"]}'" .
			" WHERE id = $id");

		$db->query("DELETE FROM duplicant_traits WHERE dupe_id = $id");
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
			header("Location: index.php?page=details&id=" . $id);
			die();
		}
	} else { ?>

		<form class="mt-sm-4 form-inline" method="get" action="index.php">
			<input type="hidden" name="page" value="admin"/>
			<input type="hidden" name="action" value="modify"/>
			<input type="hidden" name="mode" value="dupe"/>
			<select class="form-control" name="id">
				<?php
				$result = $db->query("SELECT name, id FROM duplicants ORDER BY name");
				while ($dupe = $result->fetch_assoc()) { ?>
					<option value="<?= $dupe["id"] ?>" <?= ($id !== false && $id === $dupe["id"]) ? "selected" : "" ?>>
						<?= $dupe["name"] ?>
					</option>
				<?php } ?>
			</select>
			<button type="submit" class="btn btn-info">Load</button>
		</form>

		<?php if ($id !== false) { ?>
			<form class="mt-sm-4" method="post"
			      action="index.php?page=admin&action=modify&mode=dupe&id=<?= $id ?>&apply">
				<?php $dupe = $db->query("SELECT * FROM duplicants WHERE id = $id")->fetch_assoc(); ?>
				<div class="form-group row">
					<label for="dupe_name" class="col-sm-2 col-form-label">Name :</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" id="dupe_name" name="name" required maxlength="32"
						       value="<?= $dupe["name"] ?>"/>
					</div>
				</div>
				<div class="form-group row">
					<label for="dupe_pic" class="col-sm-2 col-form-label">Picture :</label>
					<div class="col-sm-10">
						<input type="text" class="form-control" id="dupe_pic" name="pic" required maxlength="32"
						       value="<?= $dupe["picture"] ?>"/>
					</div>
				</div>

				<div class="form-group row">
					<label for="dupe_agriculture" class="col-sm-2 col-form-label">Agriculture :</label>
					<div class="col-sm-4">
						<input type="number" class="form-control" id="dupe_agriculture" name="agriculture" required
						       value="<?= $dupe["attr_agriculture"] ?>" step="1" min="-5" max="10"/>
					</div>

					<label for="dupe_athletics" class="col-sm-2 col-form-label">Athletics :</label>
					<div class="col-sm-4">
						<input type="number" class="form-control" id="dupe_athletics" name="athletics" required
						       value="<?= $dupe["attr_athletics"] ?>" step="1" min="-5" max="10"/>
					</div>
				</div>

				<div class="form-group row">
					<label for="dupe_construction" class="col-sm-2 col-form-label">Construction :</label>
					<div class="col-sm-4">
						<input type="number" class="form-control" id="dupe_construction" name="construction" required
						       value="<?= $dupe["attr_construction"] ?>" step="1" min="-5" max="10"/>
					</div>

					<label for="dupe_creativity" class="col-sm-2 col-form-label">Creativity :</label>
					<div class="col-sm-4">
						<input type="number" class="form-control" id="dupe_creativity" name="creativity" required
						       value="<?= $dupe["attr_creativity"] ?>" step="1" min="-5" max="10"/>
					</div>
				</div>

				<div class="form-group row">
					<label for="dupe_cuisine" class="col-sm-2 col-form-label">Cuisine :</label>
					<div class="col-sm-4">
						<input type="number" class="form-control" id="dupe_cuisine" name="cuisine" required
						       value="<?= $dupe["attr_cuisine"] ?>" step="1" min="-5" max="10"/>
					</div>

					<label for="dupe_excavation" class="col-sm-2 col-form-label">Excavation :</label>
					<div class="col-sm-4">
						<input type="number" class="form-control" id="dupe_excavation" name="excavation" required
						       value="<?= $dupe["attr_excavation"] ?>" step="1" min="-5" max="10"/>
					</div>
				</div>

				<div class="form-group row">
					<label for="dupe_husbandry" class="col-sm-2 col-form-label">Husbandry :</label>
					<div class="col-sm-4">
						<input type="number" class="form-control" id="dupe_husbandry" name="husbandry" required
						       value="<?= $dupe["attr_husbandry"] ?>" step="1" min="-5" max="10"/>
					</div>

					<label for="dupe_machinery" class="col-sm-2 col-form-label">Machinery :</label>
					<div class="col-sm-4">
						<input type="number" class="form-control" id="dupe_machinery" name="machinery" required
						       value="<?= $dupe["attr_machinery"] ?>" step="1" min="-5" max="10"/>
					</div>
				</div>

				<div class="form-group row">
					<label for="dupe_medicine" class="col-sm-2 col-form-label">Medicine :</label>
					<div class="col-sm-4">
						<input type="number" class="form-control" id="dupe_medicine" name="medicine" required
						       value="<?= $dupe["attr_medicine"] ?>" step="1" min="-5" max="10"/>
					</div>

					<label for="dupe_science" class="col-sm-2 col-form-label">Science :</label>
					<div class="col-sm-4">
						<input type="number" class="form-control" id="dupe_science" name="science" required
						       value="<?= $dupe["attr_science"] ?>" step="1" min="-5" max="10"/>
					</div>
				</div>

				<div class="form-group row">
					<label for="dupe_strength" class="col-sm-2 col-form-label">Strength :</label>
					<div class="col-sm-4">
						<input type="number" class="form-control" id="dupe_strength" name="strength" required
						       value="<?= $dupe["attr_strength"] ?>" step="1" min="-5" max="10"/>
					</div>

					<label for="dupe_price" class="col-sm-2 col-form-label">Price :</label>
					<div class="col-sm-4">
						<input type="number" class="form-control" id="dupe_price" name="price" required
						       value="<?= $dupe["price"] ?>" step="0.25" min="0" max="100"/>
					</div>
				</div>

				<div class="form-group row">
					<?php
					$dupe_traits = array();
					$result = $db->query("SELECT trait_id FROM duplicants INNER JOIN duplicant_traits on id = dupe_id WHERE id = $id");

					while ($tid = $result->fetch_assoc()) {
						$dupe_traits[$tid["trait_id"]] = false;
					}
					?>
					<label for="dupe_positive" class="col-sm-2 col-form-label">Positive :</label>
					<div class="col-sm-2">
						<select class="form-control" id="dupe_positive" name="positive">
							<?php
							$found = false;
							$result = $db->query("SELECT title, id FROM traits WHERE is_positive = true");
							while ($trait = $result->fetch_assoc()) {
								$selected = "";
								if (!$found && isset($dupe_traits[$trait["id"]]) && $dupe_traits[$trait["id"]] === false) {
									$dupe_traits[$trait["id"]] = true;
									$selected = "selected";
									$found = true;
								} ?>
								<option value="<?= $trait["id"] ?>" <?= $selected ?>><?= $trait["title"] ?></option>
							<?php } ?>
						</select>
					</div>

					<label for="dupe_negative" class="col-sm-2 col-form-label">Negative :</label>
					<div class="col-sm-2">
						<select class="form-control" id="dupe_negative" name="negative">
							<?php
							$found = false;
							$result = $db->query("SELECT title, id FROM traits WHERE is_positive = false");
							while ($trait = $result->fetch_assoc()) {
								$selected = "";
								if (!$found && isset($dupe_traits[$trait["id"]]) && $dupe_traits[$trait["id"]] === false) {
									$dupe_traits[$trait["id"]] = true;
									$selected = "selected";
								} ?>
								<option value="<?= $trait["id"] ?>" <?= $selected ?>><?= $trait["title"] ?></option>
							<?php } ?>
						</select>
					</div>

					<label for="dupe_extra" class="col-sm-2 col-form-label">Extra :</label>
					<div class="col-sm-2">
						<select class="form-control" id="dupe_extra" name="extra">
							<option value="0">None</option>
							<?php
							$found = false;
							$result = $db->query("SELECT title, id FROM traits");
							while (!$found && $trait = $result->fetch_assoc()) {
								$selected = "";
								if (isset($dupe_traits[$trait["id"]]) && $dupe_traits[$trait["id"]] === false) {
									$dupe_traits[$trait["id"]] = true;
									$selected = "selected";
								} ?>
								<option value="<?= $trait["id"] ?>" <?= $selected ?>><?= $trait["title"] ?></option>
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
	}
} else {
	if (isset($_GET["apply"])) {
		$db->query("INSERT INTO traits(title, is_positive, description) VALUES " .
			"('{$_POST["title"]}', {$_POST["positive"]}, '{$_POST["desc"]}')");
		header("Location: index.php?page=admin&action=create&mode=trait");
		die();
	} else { ?>

		<form class="mt-sm-4" method="post" action="index.php?page=admin&action=modify&mode=trait&apply">
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
