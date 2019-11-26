<?php
	if (!isset($_GET["mode"]) || empty($_GET["mode"])) {
	header("Location: index.php?page=admin&action=modify&mode=dupe");
	die();
	}

	$mode = $_GET["mode"];

	if ($mode === "dupe"){
		$db->query("DELETE FROM duplicant_traits WHERE dupe_id = ".$_GET["id"]);
		$db->query("DELETE FROM duplicants WHERE id = ".$_GET["id"]);
?>
		<script>
			alert("Duplicant succesfully deleted. Goodbye, <?= $_GET['name']?>!");
			window.location="index.php?page=admin&action=modify&mode=dupe";
		</script>
<?php
	}
	else if($mode === "trait"){
		$trait_found = $db->query("SELECT count(trait_id) FROM duplicant_traits WHERE trait_id = ".$_GET["id"])->fetch_assoc()["count(trait_id)"];

		if($trait_found === 0){
			$db->query("DELETE FROM traits WHERE id = ".$_GET["id"]);
?>
			<script>
				alert("This trait was succesfully deleted!");
				window.location="index.php?page=admin&action=modify&mode=trait";
			</script>
<?php
		} else{ ?>
			<script>
				alert("Cannot delete this trait, unless you are heartless and want duplicants to lose a piece of their personnality... Anyway, no!");
				window.location="index.php?page=admin&action=modify&mode=trait";
			</script>
<?php
		}
	}
?>
