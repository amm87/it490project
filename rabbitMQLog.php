#!/usr/bin/php
<?php
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');
function requestProcessor($request)
{
    $fp = new errorLogger('/home/anthony/git/it490project/error.log');
  echo "received request".PHP_EOL;
  var_dump($request);
  $fp->log($request['error']);
  return array("returnCode" => '0', 'message'=>"Server received request and processed");
}
$server = new rabbitMQServer("rabbitMQLog.ini","testServer");
$server->process_requests('requestProcessor');
exit();
?>