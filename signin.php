<?php
session_start();
include ("login.php.inc");
include('functions.php');
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');
$name = $_POST["user"]; 
$pass = $_POST["password"];

$db = new logindb();
$client = new rabbitMQClient("testRabbitMQ.ini","testServer");
$client_2 = new rabbitMQClient("rabbitMQMail.ini", "testServer");

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
//$request_2 = array();
$request['type'] = "login";
$request['username'] = $name;
$request['password'] = hashPassword($pass);
$request['message'] = $msg;
$response = $client->send_request($request);

$request_2["type"] = "email";
$request_2["name"] = $name;
$client_2->publish($request_2);

//$payload = $response;
//echo $payload;
if($response == true ){
    $_SESSION['id'] = $db->get_id($name);
    echo header("Location: MainPage.php");
}

else{
    
    echo "<script language='JavaScript'>
	    alert('Username or Password was entered incorrectly')
	    location='index.php'
	    </script>";
}

?>


