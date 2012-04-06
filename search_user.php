<?php
include "common.php";
$connection = connectToDB();
$key = $_POST["msg"];
$search_result = "SELECT first_name, last_name, username FROM user_detail_info, user_password WHERE user_detail_info.first_name LIKE '%" .$key. "%' OR user_detail_info.last_name LIKE '%" .$key. "%' OR user_password.username LIKE '%" .$key. "%'";
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
			echo "<table cellpadding=10 border=1>";
			echo "<tr>";
			echo "<td>username</td>";
			echo "<td>Full name</td>";
			echo "</tr>";
			while (list($username, $first_name, $last_name) = mysql_fetch_row($result))
			{
		 		 echo "<tr>";

				  echo "<td>$username</td>";

		 		 echo "<td>$first_name $last_name</td>";

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
