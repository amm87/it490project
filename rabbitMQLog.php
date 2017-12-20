#!/usr/bin/php
<?php
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');
include_once('logging.php.inc');
function requestProcessor($request)
{

  $fp = new errorLogger(getcwd()."/error.log");
  echo "received request".PHP_EOL;
  var_dump($request);
  $fp->log($request['error']);
  //servers
  
  echo exec('scp error.log shannon@192.168.1.130:/home/shannon/Documents/IT490/it490project');
   
   echo exec('scp error.log anthony@192.168.1.151:/home/anthony/git/it490project');
  
    echo exec('scp error.log brian@192.168.1.140:/home/brian/git/it490project');
    
    echo exec('scp error.log yaghsha@192.168.1.120:/home/yaghsha/git/project490/it490project');
  
    echo exec('scp error.log manish@192.168.1.110:/home/manish/git/it490project');
  
  
  
  return array("returnCode" => '0', 'message'=>"Server received request and processed");
}
$server = new rabbitMQServer("rabbitMQLog.ini","testServer");
$server->process_requests('requestProcessor');
exit();
?>