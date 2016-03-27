<!DOCTYPE html>
<html>
<head>
	<title>Login/Register</title>
	<link rel="stylesheet" type="text/css" href="assets/stylesheets/style.css">
</head>
<body>
	<div id="container">
	<h1>Welcome!</h1>
		<div id="register">
			<fieldset>
				<legend>Register</legend>
				<form method="post" action="Register">
					<p>Name<input type="text" name="name"></p>
					<p>Alias<input type="text" name="alias"></p>
					<p>Email<input type="text" name="email"></p>
					<p>Password<input type="password" name="password"></p>
					<p>*Password should contain at least 8 characters</p>
					<p>Date of Birth<input type="date" name="dob"></p>
					<input type="submit" value="Register">
				</form>
			</fieldset>
			<?php 
			echo "<span class='green'>" . $this->session->userdata('RegSuccess') . "</span>"; 
			echo "<span class='red'>" . $this->session->userdata('errors') . "</span>";
			?>
		</div>
		<div id="login">
			<fieldset>
				<legend>Login</legend>
				<form method="post" action="Login">
					<p>Email<input type="text" name="email"></p>
					<p>Password<input type="password" name="password"></p>
					<input type="submit" value="Login">
				</form>
			</fieldset>
			<?php 
			echo "<span class='red'>" . $this->session->userdata('errorsL') . "</span>"; 
			?>
		</div>
	</div>
</body>
</html>