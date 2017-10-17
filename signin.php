<!DOCTYPE html5>
<?php
include ("login.php.inc");
include('functions.php');
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');
$name = $_POST["user"]; 
$pass = $_POST["password"]; 
$client = new rabbitMQClient("testRabbitMQ.ini","testServer");
$clientLog = new rabbitMQClient("rabbitMQLog.ini","testServer");
if (isset($argv[1]))
{
  $msg = $argv[1];
}
else
{
  $msg = "test message";
}

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
    
    
    
   /** $logger = new errorLogger("/home/anthony/git/it490project/error.log");
                $requestLog = $logger ->logArray( date('m/d/Y h:i:s a', time())." ".gethostname()." "."Error occured in ".__FILE__." LINE ".__LINE__." not an error lul ".PHP_EOL);
                
    $response = $clientLog->publish($requestLog); **/
    echo header("Location: index.html");
}

else{
    
    echo "<script language='JavaScript'>
	    alert('Username or Password was entered incorrectly')
	    location='signin.html'
	    </script>";
}

?>


