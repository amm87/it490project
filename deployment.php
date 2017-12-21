#!/usr/bin/php


<?php
require_once('logging.php.inc');
require_once('rabbitMQLib.inc');
$client = new rabbitMQClient("rabbitMQLog.ini","testServer");
echo "Install, Rollback or package".PHP_EOL;
$input = readline();

$comp = "package";

if( $input === 'package')
{
$packageName = readline("package name: ");
$deploymentIP ='192.168.1.151';

$request = array();
$request['type'] = $input;
$request['pack']= $packageName;
$request['path']= getcwd();

echo exec('tar -czvf'.' /tmp/'.$request['pack'].' '.'.');
         

$request['deployment']= $deploymentIP;
$response = $client->send_request($request);


}
elseif($input =='install'){

shell_exec('/home/anthony/git/it490project/install.sh');

}
elseif($input == 'rollback'){
shell_exec('/home/anthony/git/it490project/rollback.sh');

}

else{
$client = new rabbitMQClient("rabbitMQLog.ini","testServer");
$file = __FILE__." ";
$logger = new errorLogger(getcwd()."/error.log");
$request = $logger ->logArray( date('m/d/Y h:i:s a', time())." ".gethostname()." "."Error occured in ".__FILE__." LINE ".__LINE__." FAILED TO CHOOSE OPTION".PHP_EOL);
$response = $client->publish($request);


}

//$request = array();
//$request['type'] = $input;
//$response = $client->send_request($request);



?>
