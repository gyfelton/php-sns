<?php
include 'common.php';

function printListOfPosts($gid)
{
	$connection = connectToDB();
	$list_of_posts = "SELECT * FROM  post_belonging_to_group, user_post 
	          			WHERE  post_belonging_to_group.group_id = ".$gid."
						 AND  post_belonging_to_group.post_id = user_post.post_id";
	
	if ($result = mysql_query($list_of_posts, $connection))
	{
		if (mysql_num_rows($result) > 0) {
			echo "<table>";
			while (list($post_id, $name, $description) = mysql_fetch_row($result))
			{
// 				TODO 
				echo "<tr><td><a href=\"post.php?pid=".$post_id."\">".$name."</a></td></tr>";
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
	//TODO show name and description
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