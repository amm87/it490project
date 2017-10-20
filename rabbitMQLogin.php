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
  $response = $db->moviesByGenre("Action");
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
  switch ($request['type'])
  {
    case "search";
        return doSearch($request["title"]);  
    case "genre":
      return showMovies("genre", $request['genre']);
    case "upcoming":
      return showMovies("upcoming", $request["range"]);
    case "login":
      return doLogin($request['username'],$request['password']);
    case "validate_session":
      return doValidate($request['sessionId']);
    case "register";
        return doRegister($request['username'],$request['password'],$request['fname'],$request['lname'],$request['email']);
  }
  return array("returnCode" => '0', 'message'=>"Server received request and processed");
}

$server = new rabbitMQServer("testRabbitMQ.ini","testServer");

$server->process_requests('requestProcessor');
exit();
?>
