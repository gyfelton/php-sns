<?php
include "common.php";
$connection = connectToDB();
$key = $_POST["msg"];
$search_result = "SELECT first_name, last_name, username FROM user_detail_info, user_password WHERE user_detail_info.first_name LIKE '%" .$key. "%' OR user_detail_info.last_name LIKE '%" .$key. "%' OR user_password.username LIKE '%" .$key. "%'";
?>
<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>Home</title>
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
<h2>Search Result:</h2>
<br>	<?php 
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
