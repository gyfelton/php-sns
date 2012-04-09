<html>

<head></head>
<body>

	<?php
	include 'common.php';

	// retrieve form data
	if( !$_POST['username'] or !$_POST['password'] or !$_POST['confirm_password'] or !$_POST['email'])
	{
		//TODO show error message
		//error
		die('ERROR!');
	}

	//now connect to database and check whether can register successfully or not

	$username = $_POST['username'];
	$password = $_POST['password'];
	$re_type = $_POST['confirm_password'];
	$email = $_POST['email'];
	if ($password <> $re_type)
	{
		//error: password not match
		//TODO show error message
		die('ERROR! Password does not match');
	}

	//connect to DB
	$connection = connectToDB();

	$register_query = "INSERT INTO `user_password`(`username`, `password`) VALUES ('".$username."','".$password."')";

	//TODO another query to  insert the email to detail_info, then jump to filling particular page
	if (mysql_query($register_query, $connection))
	{
		$uid = mysql_insert_id($connection);
		$init_detail_info_query = "INSERT INTO `user_detail_info`(`uid`, `email`) VALUES ('".$uid."','".$email."')";
		if (mysql_query($init_detail_info_query , $connection))
		{
			//register session info
			session_start();
			$_SESSION['id'] = $uid;
			$_SESSION['name'] = $username;
			header("Location: user_detail.php");
		}
	} else
	{
		//TODO duplicate username, show error
		die("Username already exists! Please try another username.");
	}

	// close connection

	mysql_close($connection);

	?>

</body>

</html>
