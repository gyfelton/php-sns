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
</head>

<body>
<?php
include 'common.php';

session_start();

function printGroupNameDescAndMembers($gid)
{
	$connection = connectToDB();
	$group_info = "SELECT name, description, creator_id FROM `interest_group` WHERE group_id =  $gid";
	if ($result = mysql_query($group_info, $connection))
	{

		if (list($name, $description, $creator_id) = mysql_fetch_row($result))
		{
			echo "$name<p>";
			echo "$description <p>";
		} else
		{
			echo 'ERROR no such group';
		}

		mysql_free_result($result);
	} else
	{
		echo 'ERROR when trying to get group info'.mysql_error();
	}
	
	//get member count
	$member_count = "SELECT COUNT(uid) FROM group_enrollment WHERE group_id = $gid";
	if ($result = mysql_query($member_count, $connection))
	{
	
		list($count) = mysql_fetch_row($result);
	
		echo "Total number of member: $count<p>";
	
		mysql_free_result($result);
	} else
	{
		echo 'ERROR when trying to get group member count'.mysql_error();
	}
		
	//get members
	echo "Members: <p>";
	$members = "SELECT u.username, u.uid FROM user_password u, group_enrollment g WHERE u.uid = g.uid AND g.group_id = $gid";
	if ($result = mysql_query($members, $connection))
	{
		while (list($username, $uid) = mysql_fetch_row($result))
		{
			echo "<a href=\"home.php?uid=$uid\">$name</a><p>";
		}
	}
	
	// close connection
	mysql_close($connection);
}

function printListOfPosts($gid)
{
	$connection = connectToDB();
	$list_of_posts = "SELECT user_post.post_id, title, user_password.username FROM  user_password, post_belonging_to_group, user_post
	WHERE  post_belonging_to_group.group_id = ".$gid."
	AND user_password.uid = user_post.uid
	AND  post_belonging_to_group.post_id = user_post.post_id";

	if ($result = mysql_query($list_of_posts, $connection))
	{
		if (mysql_num_rows($result) > 0) {
			echo "Posts: <p>";
			echo "<table>";
			while (list($post_id, $name, $post_uid) = mysql_fetch_row($result))
			{
				echo "<tr>
				<td><a href=\"post.php?pid=".$post_id."\">".$name."</a></td>
				<td>by <a href=\"user.php?uid=".$post_uid."\">".$post_uid."</a></td>
				</tr>";
			}
			echo "</table>";
		} else
		{
			echo "No post for this group yet. <br>";
		}
		// free result set memory
		mysql_free_result($result);
	} else
	{
		echo 'ERROR when trying to get list of posts'.mysql_error();
	}

	// close connection
	mysql_close($connection);
}

if ($gid = $_GET['gid'])
{
	printGroupNameDescAndMembers($gid);
	printListOfPosts($gid);
	echo "<form action=\"new_post.php?gid=".$gid."\" method=\"post\" >";
	echo "<input type=\"submit\" name=\"newPost\" value=\"Add a new post\">";
	echo "</form>";
}
else
{
	echo 'ERROR: Unauthorized request!';
}
?>
</body>
</html>