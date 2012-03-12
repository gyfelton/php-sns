<html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<title>New Page 1</title>
</head>

<body>

<p align="left"><font face="Cooper Black" size="5"><b>IT 2002 Online Market for 
Customer</b></font></p>
<p>&nbsp;</p>
<div style="position: absolute; width: 673px; height: 33px; z-index: 1; left: 6px; top: 65px" id="Title">
	<p align="left"><font color="#0000FF" face="Cooper Black"><b>
	<span style="background-color: #FFFF00"><a href="../index.htm">Home</a></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<a href="../Feedback.htm"><span style="background-color: #FFFF00">Feedback</span>
	</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<span style="background-color: #FFFF00"><a href="../Contact.htm">Contact </a>
	</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<span style="background-color: #FFFF00">Sign In</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<span style="background-color: #FFFF00">Search</span></b></font></p></div>
<p>&nbsp;</p>
<p>&nbsp;</p>
<div style="position: absolute; width: 759px; height: 27px; z-index: 2; left: 6px; top: 126px" id="List">
	<font face="Cooper Black"><b>Category&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
	Sub Category&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
	Item List</b></font></div>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<div style="position: absolute; width: 228px; height: 627px; z-index: 3; left: 5px; top: 164px" id="Category">
	<div style="position: absolute; width: 206px; height: 288px; z-index: 1; left: 274px; top: 15px" id="layer1">

<table border="1" cellpadding="5" cellspacing="0" width="117" height="66">

<tr>

<td>Name</td>
</tr>


<?php
// connect and set option
$str = "UID=u0904558;PWD=!5w65R6N;".
"commlinks=tcpip{host=sundbl.comp.nus.edu.sg};eng=course";
$conn = sqlanywhere_connect($str);
sqlanywhere_set_option($conn, 'auto_commit', 'off');

// select
$result = sqlanywhere_query($conn, "select CustID, CustName, Age, Gender, BillAdd, DelAdd, Email, CreditCardNo, PhoneNo, MemberCat from
Customers");




while ($row = sqlanywhere_fetch_array($result)) {

	echo "<tr>";

        echo "<td>".$row[0]."</td>";

        echo "<td>" . $row[1]."</td>";

        echo "<td>".$row[2]."</td>";

        echo "</tr>";
}





// commit
sqlanywhere_commit($conn);
// disconnect
sqlanywhere_disconnect($conn);

?>




</table>


</div>
	<font color="#0000FF"><b><a href="Groceries.htm">
	<span style="background-color: #00FF00">Groceries</span></a><span style="background-color: #00FF00">
	</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	</b></font>
	<p><font color="#0000FF"><b><a href="Beverages.htm">Beverages</a></b></font></p>
	<p><font color="#0000FF"><b><a href="Snacks.htm">Snacks</a></b></font></p>
	<p><font color="#0000FF"><b><a href="Toiletries.htm">Toiletries</a></b></font></p>
	<p><font color="#0000FF"><b><a href="Household%20Items.htm">Household Items</a></b></font></p>
	<p><font color="#0000FF"><b><a href="Electronics%20&%20Office.htm">
	Electronics &amp; Office</a></b></font></p>
	<p><font color="#0000FF"><b><a href="Movies,%20Music%20&%20Books.htm">
	Movies, Music &amp; Books</a></b></font></p>
	<p><font color="#0000FF"><b><a href="Home,%20Furniture%20&%20Outdoor.htm">
	Home, Furniture &amp; Outdoor</a></b></font></p>
	<p><font color="#0000FF"><b><a href="Baby%20&%20Kids.htm">Baby &amp; Kids</a></b></font></p>
	<p><font color="#0000FF"><b><a href="Toys%20&%20Video%20Games.htm">Toys &amp; 
	Video Games</a></b></font></p>
	<p><font color="#0000FF"><b><a href="Sports%20&%20Fitness.htm">Sports &amp; 
	Fitness</a></b></font></p>
	<p><font color="#0000FF"><b><a href="Auto%20&%20Home%20Improvement.htm">Auto 
	&amp; Home Improvement</a></b></font></p>
	<p><font color="#0000FF"><b><a href="Photo.htm">Photo</a></b></font></p>
	<p><font color="#0000FF"><b>
	<a href="Gift,%20Craft%20&%20Party%20Supplies.htm">Gift, Craft &amp; Party 
	Supplies</a></b></font></p>
	<p><font color="#0000FF"><b><a href="Pharmacy,%20Health%20&%20Beauty.htm">
	Pharmacy, Health &amp; Beauty</a></b></font></p>
	<p><font color="#0000FF"><b><a href="Others.htm">Others</a></b></font></p>
	<p>&nbsp;</div>

</body>

</html>