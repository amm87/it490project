#!/usr/bin/php
<?php
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');
//include_once('logging.php.inc');

function requestProcessor($request)
{
var_dump($request);
  
  switch ($request['type'])
  {
    case 'package':
        //echo exec('/home/anthony/git/it490project/package.sh');
        
         //echo exec('tar -czvf'.' '.$request['pack'].' '.'/tmp/'.$request['pack']);
         
         echo exec('scp /tmp/'.$request['pack'].' '.'anthony@192.168.1.151:/home/anthony/bundles');

         
        
        break;
    case "install":
      echo exec('/home/anthony/git/it490project/install.sh');
        break;
      case "rollback":
      echo shell_exec('/home/anthony/git/it490project/rollback.sh');
        break;
      }
  return array("returnCode" => '0', 'message'=>"Server received request and processed");
        
}
$server = new rabbitMQServer("rabbitMQLog.ini","testServer");
$server->process_requests('requestProcessor');
exit();



?>