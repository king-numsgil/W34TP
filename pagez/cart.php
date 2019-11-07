<?php
$user = null;

if (!isset($_SESSION["cart"])) {
	$_SESSION["cart"] = array();
}

if (isset($_SESSION["login"])) {
	$user = $db->query("SELECT * FROM users WHERE email = '{$_SESSION["login"]}'")->fetch_assoc();
}

if (isset($_GET["action"])) {
	if (empty($_GET["action"])) {
		header("Location: index.php?page=cart");
		die();
	}

	$action = $_GET["action"];
	if ($action === "add" && isset($_GET["id"]) && !empty($_GET["id"])) {
		$_SESSION["cart"][] = $_GET["id"];
		header("Location: index.php?page=cart");
		die();
	}
} else {
	if (count($_SESSION["cart"]) === 0) { ?>
		<div class="row justify-content-center">
			<div class="col-md-4">
				<div class="card text-center">
					<div class="card-header">Your Cart</div>
					<div class="card-body">
						<p class="card-text" style="margin-top: 0">Your Cart is empty!</p>
					</div>
					<div class="card-footer">
						<a class="btn btn-link" href="index.php?page=shop">
							See the shop!
						</a>
					</div>
				</div>
			</div>
		</div>
	<?php } else {

	}
} ?>
