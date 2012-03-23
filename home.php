<?php
include 'common.php';

//init the session TODO: why need to do this every time?
session_start();

//request sign out
if (isset($_POST['signout']))
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

<html>

<head>Welcome <?php echo $_SESSION['name'] ?></head>

<body>
<br>
<?php
//assuming session is active
//retrive user's data

//TODO 1. retrieve user's detail
//$user_detail_query = "INSERT INTO `user_password`(`username`, `password`) VALUES ('".$username."','".$password."')";
?>

<table>
<tr>
<td><?php //TODO display detail info here
 echo "Your email: ".$_SESSION['name']
 ?></td> 
</tr>
</table>

<?php 
//2. retrieve user's posts
?>
Your Posts: <br>
<?php 
$user_posts = "SELECT * FROM `user_post` WHERE uid = ".$uid;
if ($result = mysql_query($user_posts, $connection))
{	
	if (mysql_num_rows($result) > 0) {	
		echo "<table>";
		while (list($post_id, $user_id, $title, $full_text) = mysql_fetch_row($result)){
			$url = $post_id;//TODO add .php in front of it
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
<br>
Your enrolled interest groups: <br>
<?php
$user_groups = "SELECT ig.group_id, name, description FROM group_enrollment ge, interest_group ig WHERE uid = ".$uid. " AND ge.group_id=ig.group_id";
if ($result = mysql_query($user_groups, $connection))
{
	if (mysql_num_rows($result) > 0) {
		echo "<table>";
		while (list($group_id, $name, $description) = mysql_fetch_row($result)){
			$url = 'group.php?gid='.$group_id;
			echo "<tr><td><a href=\"".$url."\">".$name."</a></td></tr>";
		}
		echo "</table>";
	} else
	{
		echo "You don't have any enrolled group yet. <br>";
	}
?>
	
	<form action="group_list.php" method="post" >
	<input type="submit" name="groupList" value="Enroll in a group">
	</form>
	
	<form action="create_group.php" method="post" >
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


<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" >
<input type="submit" name="signout" value="Sign out!">
</form>

</body>


</html>