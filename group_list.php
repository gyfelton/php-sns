<?php
include "common.php";

session_start();
$connection = connectToDB();
if (!isset($_SESSION['id']))
{
	//jump to start page
	die("ERROR: no session id or no group id");
}

$uid = $_SESSION['id'];


$list_of_groups = "SELECT * FROM interest_group";
$enrolled_group_guery = "SELECT * FROM group_enrollment e, interest_group WHERE uid =" .$uid. "AND e.group_id = group_id";
$not_in_groups_query = "SELECT * FROM interest_group WHERE group_id NOT IN (SELECT group_id FROM group_enrollment WHERE uid =" .$uid. ")";

//SELECT * FROM interest_group, group_enrollment WHERE uid = .$uid and
?>
<html>
<body>
	<?php 
	if (isset($_GET['enroll_to']))
	{
		$group_id = $_GET['enroll_to'];
		$enroll_group_query = "INSERT INTO `group_enrollment`(`uid`, `group_id`, `start_date`) 
								VALUES (".$uid.",".$group_id.",NOW())";
		if( mysql_query($enroll_group_query, $connection) )
		{
			echo "Success!<br>";
		} else
		{
			echo "ERROR!<br>";
		}
	}

	echo "Click any of the group below to enroll<br>";
	
	if ($result = mysql_query($not_in_groups_query, $connection))
	{
		if (mysql_num_rows($result) > 0) {
			echo "<table>";
			while (list($group_id, $name, $description) = mysql_fetch_row($result))
			{
				$url = "group_list.php?showDesc=".$group_id; //TODO show description if user clicked on the group
				echo "<tr>";
				echo "<td>Group name: <a href=\"".$url."\">".$name."</a></td>";
				echo "<td>";
				//add enroll or delete button, depends on whether he is enrolled
				echo "<form action=\"group_list?enroll_to=".$group_id."\" method=\"post\" >";
				echo "<input type=\"submit\" name=\"join_group\" value=\"Join this group\">";
				echo "</form>";
				echo "</td>";
				echo "</tr>";
				if ( isset($_GET['showDesc']) and $_GET['showDesc'] === $group_id)
				{
					echo "<tr><td>".$description."</td></tr>";
				}
			}
			echo "</table>";
		} else
		{
			echo "No interest group found. <br>";
		}
	}

	if ($result = mysql_query($enrolled_group_guery, $connection))
	{
		if (mysql_num_rows($result) > 0) {
			echo "<table>";
			while (list($group_id, $name, $description) = mysql_fetch_row($result))
			{
				$url = ""; //TODO show description if user clicked on the group
				echo "<tr>";
				echo "<td>Group name: <a href=\"".$url."\">".$name."</a></td>";
				echo "<td>";
				//add enroll or delete button, depends on whether he is enrolled
				echo "<form action=\"enroll_group.php?gid=".$group_id."\" method=\"post\" >";
				echo "<input type=\"submit\" name=\"leave_group\" value=\"Leave this group\">";
				echo "</form>";
				//TODO show withdraw from the group when user already enroll
				echo "</td>";
				echo "</tr>";
			}
			echo "</table>";
		} else
		{
			echo "No interest group found. <br>";
		}
	}


	?>
</body>
</html>
