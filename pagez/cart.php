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
	if ($action === "add" && isset($_GET["id"])) {
		$_SESSION["cart"][] = $_GET["id"];
		header("Location: index.php?page=cart");
		die();
	}
	if ($action === "remove" && isset($_GET["i"])) {
		unset($_SESSION["cart"][$_GET["i"]]);
		$_SESSION["cart"] = array_values($_SESSION["cart"]);
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
	<?php } else { ?>
		<div class="row">
			<?php for ($i = 0; $i < count($_SESSION["cart"]); $i++) {
				$row = $db->query("SELECT * FROM duplicants WHERE id = {$_SESSION["cart"][$i]}")->fetch_assoc();
				?>
				<div class="col-lg-4 col-md-10 mt-auto" style="margin-bottom: 1rem">
					<div class="card">
						<div class="card-header">Dupe #<?= $row["id"] ?></div>
						<img class="card-img-top" src="<?= $row['picture'] ?>" alt="Dupe"/>
						<div class="card-body">
							<p class="card-text" style="margin-top: 0">Say hello to <?= $row["name"] ?></p>
						</div>
						<div class="card-footer text-center">
							<div class="btn-group" role="group" aria-label="Basic example">
								<a class="btn btn-sm btn-danger" href="index.php?page=cart&action=remove&i=<?= $i ?>">
									Remove
								</a>
								<a class="btn btn-sm btn-primary" href="index.php?page=details&id=<?= $row["id"] ?>">
									Details
								</a>
							</div>
						</div>
					</div>
				</div>
			<?php } ?>
		</div>
	<?php }
} ?>
