<?php
session_start();
include ("login.php.inc");
include('functions.php');
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');
$name = $_POST["user"]; 
$pass = $_POST["password"];


$client = new rabbitMQClient("testRabbitMQ.ini","testServer");

if (isset($argv[1]))
{
  $msg = $argv[1];
}
else
{
  $msg = "test message";
}
$_SESSION["user"] = $name;
$request = array();
$request['type'] = "login";
$request['username'] = $name;
$request['password'] = hashPassword($pass);
$request['message'] = $msg;
$response = $client->send_request($request);
//$response = $client->publish($request);

$payload = json_encode($response);
//echo $payload;
if($payload =="true" ){
    
    echo header("Location: AllTime.php");
}

else{
    
    echo "<script language='JavaScript'>
	    alert('Username or Password was entered incorrectly')
	    location='index.php'
	    </script>";
}

?>


