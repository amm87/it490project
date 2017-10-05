#!/usr/bin/php
<?php
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');
require_once('login.php.inc');


function doLogin($username,$password)
{
    $database = new logindb();
    $response = $database->validateLogin($username, $password); 
    if($response ==true){
    
        //return header("Location: index.html");
        return true;
    }
    else{
        // return "<script language='JavaScript'>
	  //  alert('Username or Password was entered incorrectly')
	    //location='signin.html'
	    //</script>"
	    return false;
    }

}

function requestProcessor($request)
{
  echo "received request".PHP_EOL;
  var_dump($request);
  if(!isset($request['type']))
  {
    return "ERROR: unsupported message type";
  }
  switch ($request['type'])
  {
    case "login":
      return doLogin($request['username'],$request['password']);
    case "validate_session":
      return doValidate($request['sessionId']);
  }
  return array("returnCode" => '0', 'message'=>"Server received request and processed");
}

$server = new rabbitMQServer("testRabbitMQ.ini","testServer");

$server->process_requests('requestProcessor');
exit();
?>