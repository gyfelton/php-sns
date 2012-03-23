<html>

<head></head>
<body>

<?php
include 'common.php';

// retrieve form data
if( !$_POST['username'] or !$_POST['password'] or !$_POST['confirm_password'])
{
	//error
	die('ERROR!');
}

//now connect to database and check whether can register successfully or not

$username = $_POST['username'];
$password = $_POST['password'];
$re_type = $_POST['confirm_password'];

if ($password <> $re_type)
{
	//error: password not match
}

//connect to DB
$connection = connectToDB();

$register_query = "INSERT INTO `user_password`(`username`, `password`) VALUES ('".$username."','".$password."')";

if (mysql_query($register_query, $connection))
{
	header("Location: temp.php");
} else
{
	//duplicate username, show error
	
}

// close connection

mysql_close($connection);

?>

</body>

</html>
