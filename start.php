<?php
// initialize a session

session_start();

?>

<html>

<head></head>

<body>

<?php

if (!isset($_SESSION['username'])) {

    // if no session under 'username'

?>
	<table cellpadding=10 border=1 align = "center">	
	<tr>
	<td>
	CS2102 Project: Social network site
	</td>
	</tr>
	<tr>
	<td>
    <form action="login.php" method="post">

        <p align="center">Username: <input type="text" name="username"></p>
        <!-- <p align="center">Email address: <input type="text" name="email"></p>  -->
		<p align="center">Password: <input type="password" name="password"></p>
        <p align="center"><input type="submit" name="submit" value="Sign in"></p>

    </form>
    </td>
    </tr>
    <tr>
    <td>
    <form action="register.php" method="post">

        <p align="center">Username: <input type="text" name="username"></p>
        <!-- <p align="center">Email address: <input type="text" name="email"></p>  -->
		<p align="center">Password: <input type="password" name="password"></p>
		<p align="center">Confirm Password: <input type="password" name="confirm_password"></p>
        <p align="center"><input type="submit" name="submit" value="Register"></p>
    </form>
    </td>
    </tr>
    </table>
    
<?php

} else if (isset($_SESSION['username'])) {

	// if a previous session exists, jump to user particular page
	header("Location: temp.php");
}

?>
