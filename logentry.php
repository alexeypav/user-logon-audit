<?php
//API to insert user log into database
//Needs error handling etc. added.
//AlexeyP 2017

//Database path
$dbPath = "logger.sqlite";




$json = file_get_contents('php://input');

$data = json_decode($json, true);

echo $data["Username"] . " " . $data["Time"] . " " . $data["Computername"] . " " . $data["Type"];

$username = $data["Username"];
$time = $data["Time"];
$computername = $data["Computername"];
$type = $data["Type"];

//exit if invalid data, stops database from being messy/currupting
if($username == "" or $time == "" or $computername == "" or $type == ""){
	echo "Bad/Incomplete Data Sent";
	exit;

}

//Open database and run query
$db = new SQLite3($dbPath);
$db->query("INSERT INTO LOGS (Username, Computername, Type, Time)
                          VALUES ('$username', '$computername', '$type', '$time')");
						  
    
$db->close();   						  

?>