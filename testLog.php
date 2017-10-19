#!/usr/bin/php
<?php
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');
$client = new rabbitMQClient("rabbitMQLog.ini","testServer");
$file = __FILE__." ";
$logger = new errorLogger("/home/anthony/git/it490project/error.log");
$request = $logger ->logArray( date('m/d/Y h:i:s a', time())." ".gethostname()." "."Error occured in ".__FILE__." LINE ".__LINE__." TEST".PHP_EOL);
$response = $client->publish($request);
/**require_once("logging.php.inc");
$logger = new errorLogger("/home/anthony/git/it490project/error.log");
$logger->log("Error occured in"." ".__FILE__." "."Line"."  ".__LINE__." "."test".PHP_EOL);
**/
?>