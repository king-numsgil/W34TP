<?php
if (isset($_GET["action"]) && empty($_GET["action"])) {
	$error = false;
	function error($msg) {
		echo "<script>alert('$msg'); window.location = 'index.php?page=register';</script>";
	}

	if (!isset($_POST["first_name"]) || empty($_POST["first_name"])) {
		error("Please enter your first name");
		$error = true;
	}

	if (!isset($_POST["last_name"]) || empty($_POST["last_name"])) {
		error("Please enter your last name");
		$error = true;
	}

	if (!isset($_POST["email"]) || empty($_POST["email"])) {
		error("Please enter your email");
		$error = true;
	}

	if (!isset($_POST["password1"]) || empty($_POST["password1"]) ||
		!isset($_POST["password2"]) || empty($_POST["password2"])) {
		error("Please enter your password");
		$error = true;
	}

	if ($error === false && $_POST["password1"] != $_POST["password2"]) {
		error("Both passwords must be the same");
		$error = true;
	}

	$db = new mysqli('localhost', 'dupe_store', 'ewHE4eNuPikdxIxP', 'dupe_store');
	$user = $db->query("SELECT * FROM users WHERE email = '{$_POST["email"]}'");
	if ($user->num_rows > 0) {
		error("This email is already in use");
		$error = true;
	}

	if ($error === false) {
		$user = $db->query("insert into users(first_name, last_name, email, password) VALUE"
		. "('{$_POST["first_name"]}', '{$_POST["last_name"]}', '{$_POST["email"]}', '{$_POST["password1"]}')");

		if ($user === false) {
			error("Internal database error");
		} else {
			$_SESSION["login"] = $_POST["email"];
			header("Location:index.php?page=home");
			die();
		}
	}
} else { ?>
<form method="post" action="index.php?page=register&action">
	<div class="row">
		<div class="col">
			<div class="control-group control-group-inline">
				<div class="form-group floating-label-form-group controls">
					<label for="txtRegisterFirstName">First Name</label>
					<input id="txtRegisterFirstName" type="text" class="form-control" placeholder="First Name" name="first_name" required/>
				</div>
			</div>
		</div>
		<div class="col">
			<div class="control-group control-group-inline">
				<div class="form-group floating-label-form-group controls">
					<label for="txtRegisterLastName">Last Name</label>
					<input id="txtRegisterLastName" type="text" class="form-control" placeholder="Last Name" name="last_name" required/>
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col">
			<div class="control-group">
				<div class="form-group floating-label-form-group controls">
					<label for="txtRegisterEmail">Email Address</label>
					<input id="txtRegisterEmail" type="email" class="form-control" placeholder="Email Address" name="email" required/>
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col">
			<div class="control-group control-group-inline">
				<div class="form-group floating-label-form-group controls">
					<label for="txtRegisterPassword1">Password</label>
					<input id="txtRegisterPassword1" type="password" class="form-control" placeholder="Password" name="password1" required/>
				</div>
			</div>
		</div>
		<div class="col">
			<div class="control-group control-group-inline">
				<div class="form-group floating-label-form-group controls">
					<label for="txtRegisterPassword2">Verify Password</label>
					<input id="txtRegisterPassword2" type="password" class="form-control" placeholder="Verify Password" name="password2" required/>
				</div>
			</div>
		</div>
	</div>

	<div class="row" style="margin-top: 1rem;">
		<div class="col text-right">
			<button type="submit" class="btn btn-primary">Submit</button>
		</div>
		<div class="col text-left">
			<button type="reset" class="btn btn-primary">Reset</button>
		</div>
	</div>
</form>
<?php } ?>