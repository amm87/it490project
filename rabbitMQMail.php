#!/usr/bin/php
<?php
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');
require_once('login.php.inc');
require_once('register.php.inc');
require_once('movies.php.inc');
require_once('search.php.inc');

function showMovies($type, $value="")
{
    $response=false;
  $db = new moviedb();
  if ($type === "genre")
  {
  $response = $db->moviesByGenre($value);
  }
  else if ($type === "upcoming")
  {
  $response = $db->upcomingMovies($value);
  }
  return $response;
}

function doLogin($username,$password)
{
    $database = new logindb();
    $response = $database->validateLogin($username, $password); 
    if($response ==true){
        //$_SESSION['user'] = $username;
        //$_SESSION['id'] = $database->getClientId($username);
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

function doEmail($name, $email_address)
{
    $database = new moviedb();
    $database->sendEmail($name, $email_address);
}

function doSearch($moviename){
    $database = new searchdb();
    $response = $database->searchMovie($moviename);
    return $response;
}

function requestProcessor($request)
{
  echo "received request".PHP_EOL;
  var_dump($request);
  if(!isset($request['type']))
  {
    return "ERROR: unsupported message type";
  }
  if ($request['type'] == "email")
  {
    doEmail($request["name"], $request["email_address"]);
  }
  return array("returnCode" => '0', 'message'=>"Server received request and processed");
}

$server = new rabbitMQServer("rabbitMQMail.ini","testServer");

$server->process_requests('requestProcessor');
exit();
?>
