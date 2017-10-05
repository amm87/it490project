<!DOCTYPE html5>
<?php

session_start();

//include ("account.php");
include ("login.php.inc");

$database = new logindb();

$name = $_POST["user"]; 
$pass = $_POST["password"]; 

validateLogin($name, $password); 

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