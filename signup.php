
<?php

include ("register.php.inc");
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');


$name = $_POST['newUser'];
$email= $_POST['email'];
$pass = $_POST['newPass'];
$fname = $_POST['firstName'];
$lname = $_POST['lastName'];



$client = new rabbitMQClient("testRabbitMQ.ini","testServer");

if (isset($argv[1]))
{
  $msg = $argv[1];
}
else
{
  $msg = "test message";
}

$request = array();
$request['type'] = "register";
$request['username'] = $name;
$request['password'] = hashPassword($pass);
$request['fname'] = $fname;
$request['lname'] = $lname;
$request['email']= $email;
$response = $client->send_request($request);
//$response = $client->publish($request);

//payload = json_encode($response);
if($response == true ){
   echo "<script language='JavaScript'>
	    alert('Your account was created.')
	    location='index.php'
	    </script>";
}

else{
    
    echo "<script language='JavaScript'>
	    alert('Username taken')
	    location='signup.html'
	    </script>";
}

?>
