<?php
if (!isset($_SESSION["login"]) || empty($_SESSION["login"])) {
	header("Location: index.php?page=home");
	die();
}

$user = $db->query("SELECT * FROM users where email = '{$_SESSION["login"]}'")->fetch_assoc();
if (!$user["is_admin"]) {
	header("Location: index.php?page=home");
	die();
}

if (!isset($_GET["action"])) { ?>
	Menu
<?php } else {
	$action = $_GET["action"];

	if ($action === "modify") {?>

		Modify

	<?php } elseif ($action === "create") { ?>

		Create

	<?php } elseif ($action === "delete") { ?>

		Delete

	<?php }
}
