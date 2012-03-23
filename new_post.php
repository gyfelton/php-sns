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
if (isset($_POST['title']) and isset($_POST['content']))
{
	$connection = connectToDB();
	$new_post_query = "INSERT INTO `user_post`(`uid`, `title`, `full_text`) 
	 						VALUES (".$uid.",'".$_POST['title']."','".$_POST['content']."')";
	if (mysql_query($new_post_query, $connection))
	{
		//link the post to the group
		$post_id = mysql_insert_id($connection);
		$link_post_to_group = "INSERT INTO `post_belonging_to_group`(`post_id`, `group_id`) 
									VALUES (".$post_id.",".$gid.")";
		if (mysql_query($link_post_to_group, $connection)) {
			echo 'Successful!';
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
?>
    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">

        <p align="left">Title: <input type="text" name="title"></p>
		<p align="left">Content: <input type="text" name="content"></p>
        <p align="left"><input type="submit" name="submit" value="Submit"></p>
    </form>
<?php 
		} 
?>	