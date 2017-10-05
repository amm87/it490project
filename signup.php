<!DOCTYPE html5>
<?php

session_start();

include ("register.php.inc");
//include ("account.php");

$register = $_POST['register'];
switch($register){
   case "register":
   
        $register = new registerdb();
	$username = $_POST['newUser'];
        $email= $_POST['email'];
	$password = $_POST['newPass'];
	$fname = $_POST['firstName'];
	$lname = $_POST['lastName'];
	$response = $register->registerUser($username,$password,$fname,$lname,$email);
	if($response === true)
	{
	    $response="Account Created"."<p>";
	    echo $response;
	}
	else
	{
	$response ="Failed: User exist"."<p>";
	echo $response;
	}
	break;
}




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
