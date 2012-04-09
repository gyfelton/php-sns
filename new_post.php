<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>New post</title>
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
<br>
<br>
<br>
</head>

<body>
<?php 
include "common.php";

//init the session TODO: why need to do this every time?
session_start();

//user's home page
if (!isset($_SESSION['id']) || !isset($_GET['gid']))
{
	//jump to start page
	die("ERROR: no session id or no group id");
}

$uid = $_SESSION['id'];
$gid = $_GET['gid'];
if (isset($_POST['title']) and isset($_POST['content']) and $_POST['title'] <> '' )
{
	$connection = connectToDB();
	$new_post_query = "INSERT INTO `user_post`(`uid`, `title`, `full_text`, date)
	VALUES (".$uid.",'".$_POST['title']."','".$_POST['content']."', NOW() )";
	if (mysql_query($new_post_query, $connection))
	{
		//link the post to the group
		$post_id = mysql_insert_id($connection);
		$link_post_to_group = "INSERT INTO `post_belonging_to_group`(`post_id`, `group_id`)
		VALUES (".$post_id.",".$gid.")";
		if (mysql_query($link_post_to_group, $connection)) {
			echo 'Successful!';
			header("Location: group.php?gid=$gid");
		} else
		{
			//show ERROR
		}
	} else
	{
		//TODO show error
	}

	// close connection
	mysql_close($connection);
} else {
	?>	<form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
		<p align="left">
			Title: <br>
			<input type="text" name="title" style="width: 338px">
		</p>

		Content:
		<p>
<span>
			<textarea name="content" COLS=40 style="height: 254px"></textarea></span>
		</p>
		<p align="left">
			<input type="submit" name="submit" value="Submit">
		</p>
	</form>
</body>

</html>
<?php 
}
?>