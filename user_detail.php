<?php
include 'common.php';

// initialize a session
session_start();
$uid = $_SESSION['id'];
$usrname = $_SESSION['name'];

//connect to DB
$connection = connectToDB();
//query to get available information
$existing_info = "SELECT first_name, last_name, gender, dob, occupation, facebook, twitter FROM `user_detail_info` WHERE uid = $uid";

if ($result = mysql_query($existing_info, $connection))
{
	list($first_name, $last_name, $gender, $dob, $occupation, $facebook, $twitter) = mysql_fetch_row($result);
	mysql_free_result($result);
} else
{
	echo 'ERROR when trying to get user info'.mysql_error();
}

//if data is filled in, update the entry
if (isset($_POST['first_name']) && isset($_POST['last_name']))
{
	//TODO
	$first_name = $_POST['first_name'];
	$last_name = $_POST['last_name'];
	$gender = $_POST['gender'];
	$year = $_POST['year1'];
	$month = $_POST['month1'];
	$day = $_POST['day1'];
	if ($year =='-Year-' or $month == '-Month-' or $day == '-Day-' )
	{
	} else
	{
		$dob = $year."-".$month."-".$day;
	}
	$twitter = $_POST['twitter'];
	$facebook = $_POST['facebook'];
	$occupation = $_POST['occupation'];

	$update_detail_info_query = "UPDATE `user_detail_info` SET `gender`='".$gender."',`dob`='".$dob."',`first_name`='".$first_name."',`last_name`='".$last_name."',`twitter`='".$twitter."',`facebook`='".$facebook."',`occupation`='".$occupation."' WHERE uid = ".$uid."";

	//TODO another query to  insert the email to detail_info, then jump to filling particular page
	if (mysql_query($update_detail_info_query , $connection))
	{
		//jump to user's home page
		header("Location: home.php");
	} else
	{
		echo "ERROR! ";
	}
}
?>

<html>

<head>
Welcome
<?php echo $usrname; ?>
 ! Please take a moment
to let us know your information below.

<title></title>
<script type="text/javascript">
/*<![CDATA[*/

function SelDate(d,m,y){
d=document.getElementById(d);
m=document.getElementById(m);
y=document.getElementById(y);
d.options.length=1;
if (m.value&&y.value){
var days=new Date(y.value,m.value,1,-1).getDate(); // the first day of the next month minus 1 hour
for (var z0=1;z0<=days;z0++){
d.options[z0]=new Option(z0,z0,true,true);
}
d.selectedIndex=0;
}
}
/*]]>*/
</script>
</head>


<body>

	<form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">

		<p align="left">
			First Name:<input type="text" value = "<?php echo $first_name?>" name="first_name">
		
		<p align="left">
			Last Name:<input type="text" value = "<?php echo $last_name?>" name="last_name">
		</p>
		<p align="left">
			Gender:
			<input name="gender" type="radio" value="M"  <?php if ($gender=='M') echo "checked=\"checked\""?> >Male
			<input name="gender" type="radio" value="F" <?php if ($gender=='F') echo "checked=\"checked\""?> />Female
		</p>
		<?php
			if ($dob <> '0000-00-00')
			{
				echo "Your birthday is $dob<br>You can update your birthday below";
			} 
		?>
		<p align="left">
			Birthday: <select name="year1" id="year1"
				onchange="SelDate('day1','month1','year1');">
				<option>-Year-</option>
				<option value="2012">2012</option>
				<option value="2011">2011</option>
				<option value="2010">2010</option>
				<option value="2009">2009</option>
				<option value="2008">2008</option>
				<option value="2007">2007</option>
				<option value="2006">2006</option>
				<option value="2005">2005</option>
				<option value="2004">2004</option>
				<option value="2003">2003</option>
				<option value="2002">2002</option>
				<option value="2001">2001</option>
				<option value="2000">2000</option>
				<option value="1999">1999</option>
				<option value="1998">1998</option>
				<option value="1997">1997</option>
				<option value="1996">1996</option>
				<option value="1995">1995</option>
				<option value="1994">1994</option>
				<option value="1993">1993</option>
				<option value="1992">1992</option>
				<option value="1991">1991</option>
				<option value="1990">1990</option>
				<option value="1989">1989</option>
				<option value="1988">1988</option>
				<option value="1987">1987</option>
				<option value="1986">1986</option>
				<option value="1985">1985</option>
				<option value="1984">1984</option>
				<option value="1983">1983</option>
				<option value="1982">1982</option>
				<option value="1981">1981</option>
				<option value="1980">1980</option>
				<option value="1979">1979</option>
				<option value="1978">1978</option>
				<option value="1977">1977</option>
				<option value="1976">1976</option>
				<option value="1975">1975</option>
				<option value="1974">1974</option>
				<option value="1973">1973</option>
				<option value="1972">1972</option>
				<option value="1971">1971</option>
				<option value="1970">1970</option>
				<option value="1969">1969</option>
				<option value="1968">1968</option>
				<option value="1967">1967</option>
				<option value="1966">1966</option>
				<option value="1965">1965</option>
				<option value="1964">1964</option>
				<option value="1963">1963</option>
				<option value="1962">1962</option>
				<option value="1961">1961</option>
				<option value="1960">1960</option>
				<option value="1959">1959</option>
				<option value="1958">1958</option>
				<option value="1957">1957</option>
				<option value="1956">1956</option>
				<option value="1955">1955</option>
				<option value="1954">1954</option>
				<option value="1953">1953</option>
				<option value="1952">1952</option>
				<option value="1951">1951</option>
				<option value="1950">1950</option>
				<option value="1949">1949</option>
				<option value="1948">1948</option>
				<option value="1947">1947</option>
				<option value="1946">1946</option>
				<option value="1945">1945</option>
				<option value="1944">1944</option>
				<option value="1943">1943</option>
				<option value="1942">1942</option>
				<option value="1941">1941</option>
				<option value="1940">1940</option>
				<option value="1939">1939</option>
				<option value="1938">1938</option>
				<option value="1937">1937</option>
				<option value="1936">1936</option>
				<option value="1935">1935</option>
				<option value="1934">1934</option>
				<option value="1933">1933</option>
				<option value="1932">1932</option>
				<option value="1931">1931</option>
				<option value="1930">1930</option>
				<option value="1929">1929</option>
				<option value="1928">1928</option>
				<option value="1927">1927</option>
				<option value="1926">1926</option>
				<option value="1925">1925</option>
				<option value="1924">1924</option>
				<option value="1923">1923</option>
				<option value="1922">1922</option>
				<option value="1921">1921</option>
				<option value="1920">1920</option>
				<option value="1919">1919</option>
				<option value="1918">1918</option>
				<option value="1917">1917</option>
				<option value="1916">1916</option>
				<option value="1915">1915</option>
				<option value="1914">1914</option>
				<option value="1913">1913</option>
				<option value="1912">1912</option>
				<option value="1911">1911</option>
				<option value="1910">1910</option>
				<option value="1909">1909</option>
				<option value="1908">1908</option>
				<option value="1907">1907</option>
				<option value="1906">1906</option>
				<option value="1905">1905</option>
				<option value="1904">1904</option>
				<option value="1903">1903</option>
				<option value="1902">1902</option>
				<option value="1901">1901</option>
				<option value="1900">1900</option>
			</select> <select name="month1" id="month1"
				onchange="SelDate('day1','month1','year1');">
				<option>-Month-</option>
				<option value="1">Jan</option>
				<option value="2">Feb</option>
				<option value="3">Mar</option>
				<option value="4">Apr</option>
				<option value="5">May</option>
				<option value="6">Jun</option>
				<option value="7">Jul</option>
				<option value="8">Aug</option>
				<option value="9">Sep</option>
				<option value="10">Oct</option>
				<option value="11">Nov</option>
				<option value="12">Dec</option>
			</select> <select name="day1" id="day1">
				<option>-Day-</option>
			</select>
		</p>

		<p align="left">
			Occupation:<input type="text" value = "<?php echo $occupation?>" name="occupation">
		</p>
		<p align="left">
			Facebook:<input type="text" value = "<?php echo $facebook?>" name="facebook">
		</p>
		<p align="left">
			Twitter:<input type="text" value = "<?php echo $twitter?>" name="twitter">
		</p>

		<input name="Submit" type="submit" value="Submit" />
	</form>
</body>