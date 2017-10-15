#!/usr/bin/php
<?php
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');
require_once('login.php.inc');
require_once('register.php.inc');
function doLogin($username,$password)
{
    $database = new logindb();
    $response = $database->validateLogin($username, $password); 
    if($response ==true){
        return true;
    }
    else{
        return false;
    }

}

function doRegister($username,$password,$fname,$lname,$email){
    $database = new registerdb();
    $response = $database->registerUser($username,$password,$fname,$lname,$email); 
    if($response ==true){
            return true;
    }
    else{
            return false;
    }


}

function requestProcessor($request)
{
  echo "received request".PHP_EOL;
  var_dump($request);
  if(!isset($request['type']))
  {
  
  $clientLog = new rabbitMQClient("rabbitMQLog.ini","testServer");
  $logger = new errorLogger("/home/anthony/git/it490project/error.log");
  $requestLog = $logger ->logArray( date('m/d/Y h:i:s a', time())." ".gethostname()." "." Error occured in ".__FILE__." LINE ".__LINE__."ERROR: unsupported message type ".PHP_EOL);
  $response = $clientLog->publish($requestLog);
  
  
    
    return "ERROR: unsupported message type";
  }
  switch ($request['type'])
  {
    case "login":
      return doLogin($request['username'],$request['password']);
    case "validate_session":
      return doValidate($request['sessionId']);
    case "register";
        return doRegister($request['username'],$request['password'],$request['fname'],$request['lname'],$request['email']);
  }
  return array("returnCode" => '0', 'message'=>"Server received request and processed");
}

$server = new rabbitMQServer("rabbitMQLogin.ini","testServer");

$server->process_requests('requestProcessor');
exit();
?>