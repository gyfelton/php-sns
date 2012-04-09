<?php
include 'common.php';

session_start();

//request sign out
if (isset($_GET['signout']))
{
	session_destroy();
	header("Location: start.php");
}

//user's home page
if (!isset($_SESSION['id']))
{
	//jump to start page
	die("ERROR: no session id");
}

$connection = connectToDB();
$uid = $_SESSION['id'];
$username = $_SESSION['name'];
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>Home</title>
<span>
<div style="position: absolute; width: 1023px; height: 63px; z-index: 1; left: 10px; top: 16px; color: #FFFFFF; font-family: Arial, Helvetica, sans-serif; font-size: xx-large; font-style: normal; font-weight: bold; background-color: #00FFFF;" id="layer1">
	<table>
		<tr>
			<td><img height="63" src="header_friendy.jpg" width="241" /></td>
			<td bgcolor="white" align="center" style="width: 244px"><a href="home.php">Home</a></td>
			<td bgcolor="white" align="center" style="width: 231px"><a href="group_list.php">Group</a></td>
			<td bgcolor="white" align="center" style="width: 307px"><a href="home.php?signout=1">Sign out</a></td>
		</tr>
	</table>
</div>
<br>
<br>
<br>
<br>
<br>
</head>

<body>
<table>
<tr>
<td>
Welcome
<?php echo $_SESSION['name'] ?>
	<form action="search_user.php" method="post">
		<input type="text" name="msg" size="20"> <input type="submit"
			value="Search User">
	</form>
	<form action="search_group.php" method="post">
		<input type="text" name="msg" size="20"> <input type="submit"
			value="Search Group">
	</form>
	<?php

	//assuming session is active
	//retrive user's data

	//1. retrieve user's detail
	//$user_detail_query = "INSERT INTO `user_password`(`username`, `password`) VALUES ('".$username."','".$password."')";
	//Number of posts, number of group

	$user_detail_query = "SELECT email, dob FROM user_detail_info WHERE uid = ".$uid;
	if ($result = mysql_query($user_detail_query, $connection))
	{
		list($u_email, $dob) = mysql_fetch_row($result);
		echo "Your email: $u_email<br/>" ;
		echo "DOB: $dob<br>";
	}


	$num_post_query = "SELECT count(*) FROM user_post WHERE uid = ".$uid;
	$num_group_query = "SELECT count(*) FROM group_enrollment WHERE uid = ".$uid;

	if ($result = mysql_query($num_post_query, $connection))
	{
		list($num_post) = mysql_fetch_row($result);
		echo "You have $num_post posts<br/>";
	}
	if ($result = mysql_query($num_group_query, $connection))
	{
		list($num_group) = mysql_fetch_row($result);
		echo "You are enrolled in $num_group groups<p>";

	}
	
	//$result = mysql_query($num_post_query, $connection);
	//$num_post = mysql_fetch_row($result);
	//echo $num_post;
	
	//edit user profile
	echo "<a href=\"user_detail.php?uid=".$uid."\">Edit your profile</a><p>"; //TODO link data to the fields
	?>
	
	
	<table>
		<tr>
			<td><?php //TODO display detail info here



	//echo "Your email: ".$_SESSION['name']
	?>
			</td>
		</tr>
	</table>
</td>
	<?php 
	//2. retrieve user's posts
	?>
<td>
	Your Posts:
	<br>
	<?php 
	$user_posts = "SELECT * FROM `user_post` WHERE uid = ".$uid;
	if ($result = mysql_query($user_posts, $connection))
	{
		if (mysql_num_rows($result) > 0) {
			echo "<table>";
			while (list($post_id, $user_id, $title, $full_text) = mysql_fetch_row($result)){
				$url = 'post.php?pid='.$post_id;
				echo "<tr><td><a href=\"".$url."\">".$title."</a></td></tr>";
			}
			echo "</table>";
		} else
		{
			echo "You don't have any post yet. <br>";
		}
	} else
	{
		echo "error when getting user's posts:".mysql_error();
	}
	mysql_free_result($result);
	//3. retrieve user's interest groups

	?>
</td>
<td>
	<br> Your enrolled interest groups:
	<br>
	<?php
	$user_groups = "SELECT ig.group_id, name, description FROM group_enrollment ge, interest_group ig WHERE uid = ".$uid. " AND ge.group_id=ig.group_id";
	if ($result = mysql_query($user_groups, $connection))
	{s
		if (mysql_num_rows($result) > 0) {
			echo "<table>";
			while (list($group_id, $name, $description) = mysql_fetch_row($result)){
				$url = 'group.php?gid='.$group_id;
				echo "<tr><td><a href=\"".$url."\">".$name."</a></td></tr>";
			}
			echo "</table>";
		} else
		{
			echo "You don't have any enrolled group yet. <sssbr>";
		}
		?>

	<form action="group_list.php" method="post">
		<input type="submit" name="groupList" value="Enroll in a group">
	</form>

	<form action="create_group.php" method="post">
		<input type="submit" name="creatGroup" value="Create a new group">
	</form>
	<?php 
	} else
	{
		echo "error when getting user's enrollment:".mysql_error();
	}

	// free result set memory

	mysql_free_result($result);

	// close connection

	mysql_close($connection);

	?>
	<br>
</td>
</tr>
</body>


</html>
