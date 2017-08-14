<!-- Search User Logger Database V1.0
Part of the User Logger app

AlexeyP 2017




-->
<!DOCTYPE html>
<html>
    <head>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="style.css" rel="stylesheet" type="text/css" />
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<title>Search Logs</title>
	
	<script>
	//check if using firefox
	window.onload = function() {
		if(navigator.userAgent.toLowerCase().indexOf('firefox') > -1){
	  document.getElementById("notice").innerHTML = "FireFox detected: Use Chrome or Edge for the datepicker to work, otherwise you need to manually enter the date in the format yyyy-mm-dd e.g 2017-05-30" }
	};
		</script>
		
		
	


		
    </style>
    </head>
    <body>

<div id="output"  align="center">
<P id="notice"> </P>
<span class="company-title" >User Logger Search Logs </span>
<h3><a href="index.html">Home</a>    <a href="admin.php">Admin</a></h3>
<div id = "php">

    
	<table>
	<form name="SearchLogs" id="SearchForm" action="SearchLogs.php" method="post" >
        <tr><th> Username : </th><th> <input type="text" name="username" id="username" maxlength="25" /></th>
	    <th> Computername : </th><th> <input type="text" name="computername" id="computername" maxlength="20" /></th>
	    <th>Date : <input type="date" name="date" id="date"/> </th>
		
		<th> Logon/Logoff</th>
		<th> 
		
		<table>
  <tr>
    <td align="right">Sort By :<select name="order" id="order">
         <option value="DESC" selected="selected">Latest</option>
         <option value="ASC">Oldest</option>
        </select></td>
  </tr>
  <tr>
    <td align="right">Show :<select name="howmany" id="howmany">
         <option value="LIMIT 100" selected="selected">Top 100</option>
		 <option value="LIMIT 500">Top 500</option>
		 <option value="LIMIT 1000">Top 1000</option>
         <option value="">All!</option>
        </select></td>
  </tr>


		<tr>
    <td align="right">
		<input type="submit" name="submit" class="dropbtn" value="Search" /> 
	</td>
  </tr>	
		
		</table>
		</th>
		</tr>
    </form>
</div>	

<script type="text/javascript"> //keep info filled after search
  document.getElementById('username').value = "<?php echo $_POST['username'];?>";
  document.getElementById('computername').value = "<?php echo $_POST['computername'];?>";
  document.getElementById('date').value = "<?php echo $_POST['date'];?>";
  //document.getElementById('order').value = "<?php echo $_POST['order'];?>"; - Uncommenting doesn't set default value
  //document.getElementById('howmany').value = "<?php echo $_POST['howmany'];?>";
  
</script>


    <?php    

//if submit was pressed
if((isset($_POST["submit"])))
{
	
$username = $_POST["username"];
$computername = $_POST["computername"];
$datepicker = $_POST["date"];
$orderby = $_POST["order"];
$howmany = $_POST["howmany"];

$htmlresult = array();

//Databse Path	
$db = new SQLite3('Logger.sqlite');

//Query Build and execute
$results = $db->query("SELECT * FROM LOGS WHERE Username like \"%$username%\" COLLATE NOCASE AND Computername like \"%$computername%\" AND Time like \"%$datepicker%\" ORDER BY Time DESC $howmany;" );



 
while($row = $results->fetchArray()){   //Creates a loop to loop through results

	//convert from UTC format to nice format
	$date = $row['Time'];
	$date = date_create($date);
	//date_timezone_set($date, timezone_open('Pacific/Auckland')); -- Not needed keeping for testting
	$when = date_format($date, 'D d-m-Y h:i:s a');
	
	$fontcol = "green";
	
	if (strpos(strtolower($row['Type']), 'off') !== false) {
		$fontcol = "red";
	}

	//build log table
array_push($htmlresult,"<tr><td></td><td>" . $row['Username'] . "</td><td></td><td>" . $row['Computername'] ."</td><td >" . $when ."</td><td align=\"right\"> <font color=\"$fontcol\">" . $row['Type'] . "</font> </td></tr>"); 

}

$db->close();  


if($orderby == "ASC"){
	$htmlresult = array_reverse($htmlresult);
}

//print_r($htmlresult);
foreach($htmlresult as $key=>$value) {
    echo $value;


}

}


?>
	</div>
	</table>
    </body>
</html>
