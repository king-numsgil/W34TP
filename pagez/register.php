<?php

?>

<form method="post" action="index.php?page=register&go" novalidate>
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
