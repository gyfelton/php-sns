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
<br>
<br>
</head>

<body><?php
include "common.php";

//init the session
session_start();

if (isset($_GET['pid']))
{
	$connection = connectToDB();
	$pid = $_GET['pid'];
	$post_detail = "SELECT p.title, p.full_text, user.username, g.name
	FROM  user_post p, post_belonging_to_group pg, interest_group g, user_password user
	WHERE pg.post_id = p.post_id AND g.group_id = pg.group_id AND user.uid = p.uid AND  p.post_id = ".$pid;
	
	if ($result = mysql_query($post_detail, $connection))
	{
		list($post_name, $post_full_text, $username, $groupname) = mysql_fetch_row($result);
		echo $post_name."<p>";
		echo "By ".$username."<p> From ".$groupname."<p>";
		echo $post_full_text."<p>";
	} else
	{
		//TODO show error
	}
}

</body>
</html>