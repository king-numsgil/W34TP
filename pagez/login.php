<?php
if (isset($_GET["action"]) && empty($_GET["action"])) {

}
else { ?>
<p>If you are interested by our services, you need to log in to actually buy the stuff!</p>
<form method="post" action="index.php?page=login&action" novalidate>
	<div class="control-group">
		<div class="form-group floating-label-form-group controls">
			<label>Email Address</label>
			<input type="email" class="form-control" placeholder="Email Address" id="email" required />
		</div>
	</div>
	<div class="control-group">
		<div class="form-group floating-label-form-group controls">
			<label>Password</label>
			<input type="password" class="form-control" placeholder="Password" id="password" required />
		</div>
	</div>
	<br>
	<div class="form-group">
		<button type="submit" class="btn btn-primary">Login</button>
	</div>
</form>
<?php } ?>