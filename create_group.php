<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>Create a group</title>
<span>
<div style="position: absolute; width: 1023px; height: 63px; z-index: 1; left: 10px; top: 16px; color: #FFFFFF; font-family: Arial, Helvetica, sans-serif; font-size: xx-large; font-style: normal; font-weight: bold; background-color: #00FFFF;" id="layer1">
	<table>
		<tr>
			<td><img height="63" src="header_friendy.jpg" width="241" /></td>
			<td bgcolor="white" align="center" style="width: 244px"><a href="home.php">
			Home</a></td>
			<td bgcolor="white" align="center" style="width: 231px"><a href="group_list.php">
			Group</a></td>
			<td bgcolor="white" align="center" style="width: 307px"><a href="home.php?signout=1">
			Sign out</a></td>
		</tr>
	</table>
</div>
<br>
<br>
<br>
<br>
<br>
<br>
</head>

<body>
<?php 
include "common.php";

//init the session
session_start();

//user's home page
if (!isset($_SESSION['id']))
{
	//jump to start page
	die("ERROR: no session id");
}

$uid = $_SESSION['id'];

if (isset($_POST['group_name']) and isset($_POST['group_desc']))
{
	$connection = connectToDB();
	$create_group_query = "INSERT INTO `interest_group`(`name`, `description`, `creator_id`)
	VALUES ('".$_POST['group_name']."','".$_POST['group_desc']."',".$uid.")";

	if (mysql_query($create_group_query, $connection))
	{
		//link the post to the group
		$group_id = mysql_insert_id($connection);
		$link_creator_to_group = "INSERT INTO `group_enrollment`(`uid`, `group_id`, `start_date`)
		VALUES (".$uid.",".$group_id.", NOW() )";
		if (mysql_query($link_creator_to_group, $connection)) {
			echo 'Successful!<br>';
			echo "<a href=\"group.php?gid=".$group_id."\">Click here to jump to group page</a>";
		} else
		{
			//show ERROR
			die ("ERROR! ");
		}
	} else
	{
		//TODO show error
		die ("ERROR! Group name already exists!");
	}

	// close connection
	mysql_close($connection);
} else {
	?>
<form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
	<p align="left">
		Group name: <br>
		<input type="text" name="group_name" style="width: 315px">
	</p>
	<p align="left">
		Description: <br>
		<input type="text" name="group_desc" style="width: 313px; height: 141px">
	</p>
	<p align="left">
		<input type="submit" name="submit" value="Create group">
	</p>
</form>
<?php 
}
?>
</body>
</html>