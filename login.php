<html>

<head></head>
<body>

<?php
include 'common.php';

function showLoginFailMsg()
{
	echo 'LoginFailed:</br>'.mysql_error();
}

// retrieve form data
if( !$_POST['username'] || !$_POST['password'])
{
	//error
	//show error
	echo 'ERROR! no username or password not filled in<br>';
	showBackButton();
}

//now connect to database and check whether can register successfully or not

$username = $_POST['username'];
$password = $_POST['password'];

//connect to DB
$connection = connectToDB();
$query = "SELECT uid, username, password FROM user_password WHERE username = '".$username."'";

$result = mysql_query($query);

if (mysql_num_rows($result) > 0) {
	list($uid, $to_compare_name, $to_compare_password) = mysql_fetch_row($result);
	if ($username == $to_compare_name and $password == $to_compare_password)
	{
		//register session info
		session_start();
		$_SESSION['id'] = $uid;
		$_SESSION['name'] = $username;
		header("Location: home.php");
	} else
	{
		showLoginFailMsg();
	}
} else
{
	showLoginFailMsg();
}

// free result set memory

mysql_free_result($result);

// close connection

mysql_close($connection);

?>

</body>

</html>