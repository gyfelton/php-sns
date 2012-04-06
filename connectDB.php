<?php
// set database server access variables:
function connectToDB()
{
	$host = '127.0.0.1:6666';

	$user = 'devuser1';

	$pass = 's9b0Exukuyf';

	$db = 'devuser1';

	// open connection
	$connection = mysql_connect($host, $user, $pass) or die('Unable to connect to sever<br />'.mysql_error());
	mysql_select_db($db, $connection) or die('Unable to select db<br />'.mysql_error());

	return $connection;
}

?>