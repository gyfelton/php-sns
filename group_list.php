<?php
include "common.php";

$connection = connectToDB();
$list_of_groups = "SELECT * FROM interest_group";
?>
<html>
<body>
Click any of the group below to enroll
<?php 
if ($result = mysql_query($list_of_groups, $connection)) 
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
			echo "<input type=\"submit\" name=\"join_group\" value=\"Join this group\">";
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