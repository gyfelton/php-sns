<?php
include "common.php";

if (isset($_POST['pid']))
{
	$pid = $_POST['pid'];
	$post_detail = "SELECT * 
					FROM  user_post
					WHERE  post_id = ".$pid;
	
}