<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>Search Result</title>
<span>
<div style="position: absolute; width: 1023px; height: 63px; z-index: 1; left: 10px; top: 16px; color: #FFFFFF; font-family: Arial, Helvetica, sans-serif; font-size: xx-large; font-style: normal; font-weight: bold; background-color: #00FFFF;" id="layer1">
	<table>
		<tr>
			<td><img height="63" src="header_friendy.jpg" width="241" /></td>
			<td bgcolor="white" align="center" style="width: 244px"><a href="home.php">
			Home</a></td>
			<td bgcolor="white" align="center" style="width: 231px"><a href="group_list.php">
			Group</a></td>
			<td bgcolor="white" align="center" style="width: 307px"><a href="home.php?signout=1">
			Sign out</a></td>
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
include "common.php";
$connection = connectToDB();
$key = $_POST["msg"];
$search_result = "SELECT group_id,name, description FROM interest_group WHERE name LIKE '%" .$key. "%'";
?>
<h2>Search Result:</h2>
<br>	<?php 
	if ($result = mysql_query($search_result, $connection))
	{
		if (mysql_num_rows($result) > 0) {
			echo "<table cellpadding=10 border=1>";
			echo "<tr>";
			echo "<td>Name</td>";
			echo "<td>Description</td>";
			echo "</tr>";
			while (list($group_id, $name, $description) = mysql_fetch_row($result))
			{
		 		 echo "<tr>";

		 		 echo "<td><a href=\"group.php?gid=$group_id\">$name</a></td>";

				  echo "<td>$description</td>";

		  			echo "</tr>";
			}
			echo "</table>";
		} else
		{
			echo "No Results Found! <br>";
		}
		// free result set memory
		mysql_free_result($result);
	} else
	{
		echo 'ERROR Occurs'.mysql_error();
	}

	// close connection
	mysql_close($connection);
	?>
</body>
</html>
