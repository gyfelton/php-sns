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
$enrolled_group_guery = "SELECT ig.group_id, ig.name, ig.description FROM group_enrollment e, interest_group ig WHERE e.uid  = $uid AND e.group_id = ig.group_id";
$not_in_groups_query = "SELECT group_id, name, description FROM interest_group WHERE group_id NOT IN (SELECT group_id FROM group_enrollment WHERE uid =" .$uid. ")";
?>

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
			<td bgcolor="white" align="center" style="width: 244px"><a href="home.php">Home</a></td>
			<td bgcolor="white" align="center" style="width: 231px"><a href="group_list.php">Group</a></td>
			<td bgcolor="white" align="center" style="width: 307px"><a href="home.php?signout=1">Sign out</a></td>
		</tr>
	</table>
</div>
<br>
<br>
<br>
<br>
<br>
</head>

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
	} else if (isset($_GET['withdraw_from']))
	{
		$group_id = $_GET['withdraw_from'];
		$withdraw_group_query = "DELETE FROM group_enrollment WHERE uid = $uid AND group_id = $group_id";
		if( mysql_query($withdraw_group_query, $connection) )
		{
			echo "Success!<br><p>";
		} else
		{
			echo "ERROR!<br><p>";
		}
	}

	echo "Click 'Join this group' to enroll<br>";
	
	if ($result = mysql_query($not_in_groups_query, $connection))
	{
		if (mysql_num_rows($result) > 0) {
			echo "<table>";
			while (list($group_id, $name, $description) = mysql_fetch_row($result))
			{
				$url = "group_list.php?showDesc=".$group_id;
				echo "<tr>";
				echo "<td>Group name: <a href=\"".$url."\">".$name."</a></td>";
				echo "<td>";
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

	echo "Click 'Withdraw from this group' to withdraw<br>";
	
	if ($result = mysql_query($enrolled_group_guery, $connection))
	{
		if (mysql_num_rows($result) > 0) {
			echo "<table>";
			while (list($group_id, $name, $description) = mysql_fetch_row($result))
			{
				"group_list.php?showDesc=".$group_id;
				echo "<tr>";
				echo "<td>Group name: <a href=\"".$url."\">".$name."</a></td>";
				echo "<td>";
				echo "<form action=\"group_list?withdraw_from=".$group_id."\" method=\"post\" >";
				echo "<input type=\"submit\" name=\"withdraw_group\" value=\"Withdraw from this group\">";
				echo "</form>";
				echo "</td>";
				echo "</tr>";
			}
			echo "</table>";
		} else
		{
			echo "No interest group found. <br>";
		}
	} else
	{
		echo 'ERROR when trying to get groups enrolled in'.mysql_error();
	}


	?>
</body>
</html>
