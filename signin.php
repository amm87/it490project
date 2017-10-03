<!DOCTYPE html5>
<?php

session_start();

include ("account.php");
include ("functions.php");
gateKeeper($_SESSION["logged"]);


($dbh = mysql_connect ( $hostname, $username, $password ) ) or die ( "Unable to connect to MySQL database" ); 
mysql_select_db( $project );	

$name = $_GET["user"]; 
$pass = $_GET["pass"]; 


user ( $name, $password); 

?>


<style>

fieldset
{
	border-radius: 25px;
    border: 1px solid #1E90FF;
    padding: margin; 
    width: 25%;
    height: margin;
	background: purple;
}

</style>

<form action = "TheMovieDatabase.html" >

</form>
