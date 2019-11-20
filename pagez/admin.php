<?php
if (!isset($_SESSION["login"]) || empty($_SESSION["login"])) {
	header("Location: index.php?page=home");
	die();
}

if (!$user["is_admin"]) {
	header("Location: index.php?page=home");
	die();
}

if (!isset($_GET["action"])) { ?>
	<div class="row justify-content-center" style="margin-bottom: 2rem">
		<div class="col-5 text-center">
			<h4 class="display-4">Admin Actions</h4>
		</div>
	</div>
	<div class="row justify-content-between">
		<div class="col-md-3">
			<a class="btn btn-lg btn-block btn-success" href="index.php?page=admin&action=create">
				Create
			</a>
		</div>
		
		<div class="col-md-3">
			<a class="btn btn-lg btn-block btn-warning" href="index.php?page=admin&action=modify">
				Modify
			</a>
		</div>

		<div class="col-md-3">
			<a class="btn btn-lg btn-block btn-danger" href="index.php?page=admin&action=delete">
				Delete
			</a>
		</div>
	</div>
<?php } else {
	$action = $_GET["action"];

	if ($action === "modify") {
		include_once "admin/modify.php";
	} else if ($action === "create") {
		include_once "admin/create.php";
	} else if ($action === "delete") {
		include_once "admin/delete.php";
	}
}
