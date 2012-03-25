<?php
include "common.php";
$connection = connectToDB();
$key = $_POST["msg"];
$search_result = "SELECT uid, email, first_name, last_name FROM user_detail_info WHERE first_name LIKE '%" .$key. "%' OR last_name LIKE '%" .$key. "%' OR email LIKE '%" .$key. "%'";
?>
<html>

<head>Search Result: <br></head>
<body>
<?php 
if ($result = mysql_query($search_result, $connection))
{	
	if (mysql_num_rows($result) > 0) {
			echo "<table>";
			while (list($uid, $email, $first_name, $last_name) = mysql_fetch_row($result))
			{
		  echo "<tr>";

          echo "<td>$uid</td>";

          echo "<td>$email</td>";
		  
		  echo "<td>$first_name</td>";
		  
		  echo "<td>$last_name</td>";

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
