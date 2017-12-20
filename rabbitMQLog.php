#!/usr/bin/php
<?php
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');
include_once('logging.php.inc');
function requestProcessor($request)
{
     echo getcwd()."/error.log".PHP_EOL;
  $fp = new errorLogger(getcwd()."/error.log");
  echo "received request".PHP_EOL;
  var_dump($request);
  $fp->log($request['error']);
  return array("returnCode" => '0', 'message'=>"Server received request and processed");
}
$server = new rabbitMQServer("rabbitMQLog.ini","testServer");
$server->process_requests('requestProcessor');
exit();
?>