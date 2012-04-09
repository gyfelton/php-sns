<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>Admin page</title>
</head>

<body>
<?php 
include "common.php";

//init the session
session_start();

$connection = connectToDB();

echo "<h3>Rank the members in a particular group according to their number of posts in that group.</h3>";
if (isset($_POST['query1_group_id']))
{
	$gid = $_POST['query1_group_id'];

	$rank_member_in_group = "SELECT u.username, COUNT(*)
	FROM user_password u, user_post up, post_belonging_to_group pg
	WHERE u.uid = up.uid
	AND up.post_id = pg.post_id
	AND pg.group_id = $gid
	GROUP BY u.username
	ORDER BY COUNT(*) DESC";

	if ($result = mysql_query($rank_member_in_group , $connection))
	{
		echo "Username ||| Count:<br>";
		while (list($username, $count) = mysql_fetch_row($result))
		{
			print "$username ||| $count<br>";
		}
	}
	echo "<br><br>";
}


?>

<form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
			Enter group id here to query:
			<input type="text" name="query1_group_id">
		<p align="left">
			<input type="submit" name="submit" value="Execute">
		</p>
</form>

<hr>

<?php 
echo "<h3>Find all users who do not belong to any group.</h3>";
if (isset($_POST['query2']))
{
	$date = $_POST['query2'];

	$do_not_belong = "SELECT u.username FROM user_password u WHERE NOT EXISTS (SELECT NULL FROM group_enrollment ge WHERE u.uid = ge.uid)";
	
	if ($result = mysql_query($do_not_belong , $connection))
	{
		echo "Username:<br>";
		$count = 0;
		while (list($username) = mysql_fetch_row($result))
		{
			echo "$username<br>";
			$count++;
		}
		if ($count==0)
		{
			echo "No such user.<br>";
		}
	}
	echo "<br>";
}


?>

<form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
			<input type="hidden" name="query2">
		<p align="left">
			<input type="submit" name="submit" value="Execute">
		</p>
</form>

<hr>

<?php 
echo "<h3>Find those who have not posted any post since a given date.</h3>";
if (isset($_POST['query3_date']))
{
	$date = $_POST['query3_date'];

	$no_post_yet = "SELECT u.username FROM user_password u WHERE u.uid <> ALL (SELECT  up.uid FROM user_post up WHERE up.date > '$date')";
	
	if ($result = mysql_query($no_post_yet , $connection))
	{
		echo "Username:<br>";
		$count = 0;
		while (list($username) = mysql_fetch_row($result))
		{
			echo "$username<br>";
			$count++;
		}
		if ($count==0)
		{
			echo "No such user.<br>";
		}
	}
	echo "<br>";
}


?>

<form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
		Enter the date here in the format "yyyy-mm-dd";
			<input type="text" name="query3_date">
		<p align="left">
			<input type="submit" name="submit" value="Execute">
		</p>
</form>

<hr>

<?php 
echo "<h3>Find the group with the most members.</h3>";
if (isset($_POST['query4']))
{
	$date = $_POST['query4'];

	$most_members = " SELECT ge1.group_id, ig.name, ig.creator_id, COUNT( * ) AS Members FROM 
 interest_group ig, group_enrollment ge1 WHERE ig.group_id = ge1.group_id GROUP BY ge1.group_id
 HAVING COUNT( ge1.group_id ) >= ALL(SELECT COUNT( ge2.group_id ) FROM group_enrollment ge2 
 GROUP BY ge2.group_id)";
	
	if ($result = mysql_query($most_members , $connection))
	{
		echo "group name:<br>";
		$count = 0;
		while (list($gid,$name) = mysql_fetch_row($result))
		{
			echo "<a href=\"group.php?gid=$gid\">$name</a><br>";
			$count++;
		}
		if ($count==0)
		{
			echo "No group found.<br>";
		}
	}
	echo "<br>";
}


?>

<form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
			<input type="hidden" name="query4">
		<p align="left">
			<input type="submit" name="submit" value="Execute">
		</p>
</form>

</body>
</html>