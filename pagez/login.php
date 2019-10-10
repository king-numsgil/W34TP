<?php
if (isset($_GET["action"]) && empty($_GET["action"])) {
	if (isset($_POST["email"]) && !empty($_POST["email"]) && isset($_POST["password"]) && !empty($_POST["password"])) {
		if ($_POST["email"] == "urmomma@hotmail.cum" && $_POST["password"] == "ok") {
			$_SESSION["login"] = $_POST["email"];
			header("Location:index.php?page=home");
			die();
		} else {
			echo "<script>alert('Incorrect email or password'); window.location = 'index.php?page=login';</script>";
		}
	} else {
		echo "<script>alert('Please enter all your informations'); window.location = 'index.php?page=login';</script>";
	}
} else { ?>
	<p>If you are interested by our services, you need to log in to actually buy the stuff!</p>
	<form method="post" action="index.php?page=login&action" novalidate>
		<div class="control-group">
			<div class="form-group floating-label-form-group controls">
				<label>Email Address</label>
				<input type="email" class="form-control" placeholder="Email Address" name="email" required/>
			</div>
		</div>
		<div class="control-group">
			<div class="form-group floating-label-form-group controls">
				<label>Password</label>
				<input type="password" class="form-control" placeholder="Password" name="password" required/>
			</div>
		</div>
		<br>
		<div class="form-group">
			<button type="submit" class="btn btn-primary">Login</button>
		</div>
	</form>
<?php } ?>