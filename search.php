<?php
include ("search.php.inc");
include('functions.php');
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');
$name = $_POST["search"]; 
 
$client = new rabbitMQClient("testRabbitMQ.ini","testServer");

if (isset($argv[1]))
{
  $msg = $argv[1];
}
else
{
  $msg = "Movie not found.";
}

$request = array();
$request['type'] = "search";
$request['title'] = $name;
$response = $client->send_request($request);

$payload = json_decode($response, true);

    echo "<td>";
    $path = "http://image.tmdb.org/t/p/w185/".$payload["imagePath"];
    $link = "Forums.php?type=2&movieid=$value";
    echo "<a href=$link><img src=$path></a><br>";
    echo $payload['title']."<br>";
    echo $payload['releaseDate'];
    echo "</td>";

//$path = "http://image.tmdb.org/t/p/w185/".$name["image"];
//$value = $name["id"];
//$link = "Forums.php?type=2&movieid=$value";
//echo "<a href=$link><img src=$path></a><br>";

?>