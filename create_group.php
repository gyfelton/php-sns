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
	<p align="left">
		Group name: <input type="text" name="group_name">
	</p>
	<p align="left">
		Description: <input type="text" name="group_desc">
	</p>
	<p align="left">
		<input type="submit" name="submit" value="Create group">
	</p>
</form>
<?php 
}
?>