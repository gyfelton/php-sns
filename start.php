<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
include 'common.php';

// initialize a session
session_start();

?>

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>Start</title>
</head>

<?php

if (!isset($_SESSION['id'])) {

	// if no session under 'username'

?>

<body>
<table >
<tr>
	<td style="width: 191px" colspan="2"><img src="start_header.jpg" /></td>
</tr>
<tr>
	<td style="width: 191px" rowspan="2"><img src="start_left.jpg" />
	</td>
	<td width="600" style="height: 83px">
		<form action="login.php" method="post">

					<p align="center">
						Username: <input type="text" name="username">
					</p>
					<!-- <p align="center">Email address: <input type="text" name="email"></p>  -->
					<p align="center">
						Password: <input type="password" name="password">
					</p>
					<p align="center">
						<input type="submit" name="submit" value="Sign in">
					</p>

				</form>
	</td>
</tr>
<tr>	
	<td width="600" style="height: 183px">
				<form action="register.php" method="post">

					<p align="center">
						Username: <input type="text" name="username">
					
					</p>
					<p align="center">
						Email address: <input type="text" name="email">
					
					</p>
					<p align="center">
						Password: <input type="password" name="password">
					
					</p>
					<p align="center">
						Confirm Password: <input type="password" name="confirm_password">
					
					</p>
					<p align="center">
						<input type="submit" name="submit" value="Register">
					
					</p>
				</form>
			</td>
</tr>

</table>
	<?php

	} else if (isset($_SESSION['id'])) {

		// if a previous session exists, jump to user particular page
	header("Location: home.php");
}

?>
</body>