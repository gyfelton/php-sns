<?php
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