<?php
//this is a file containing common functions and includes needed for this project
//do include them in all php files!

//set the debug error log on
ini_set('display_errors', 'On');
ini_set("html_errors", 1);

include 'connectDB.php';

function showBackButton()
{
	echo "<a href=\"".$_SERVER['HTTP_REFERER']."\">Back</a>";
	die();
}
?>