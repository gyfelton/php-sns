<?php
include "common.php";
$connection = connectToDB();
$key = $_POST["msg"];
$search_result = "SELECT name, description FROM interest_group WHERE name LIKE '%" .$key. "%'";
?>
<html>

<head>
Search Result:
<br>
</head>
<body>
	<?php 
	if ($result = mysql_query($search_result, $connection))
	{
		if (mysql_num_rows($result) > 0) {
			echo "<table cellpadding=10 border=1>";
			echo "<tr>";
			echo "<td>Name</td>";
			echo "<td>Description</td>";
			echo "</tr>";
			while (list($name, $description) = mysql_fetch_row($result))
			{
		 		 echo "<tr>";

		 		 echo "<td>$name</td>";

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
