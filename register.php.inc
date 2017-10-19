<?php
include('functions.php');
class registerDB
{
private $registerdb;

public function __construct()
{
	$this->registerdb = new mysqli("192.168.1.5","root","123456","it490project");

	if ($this->registerdb->connect_errno != 0)
	{
		echo "Error connecting to database: ".$this->registerdb->connect_error.PHP_EOL;
		exit(1);
	}
	//echo "correctly connected to database".PHP_EOL;
}

    public function getClientId($name)
    {
	$query = "select id from users where username = '$name';";
	$results = $this->registerdb->query($query);
	if (!$results)
	{
	    //$this->logger->log("error with results: ".$this->db->error);
	    return 0;
	}
        $client = $results->fetch_assoc();
	if (isset($client['id']))
	{
	    return $client['id'];
	}
	return 0;
    }

public function registerUser($username,$password,$fname,$lname,$email)
{
    	if ($this->getClientId($username) != 0)
        {
            echo "exist".PHP_EOL;
            $response=false;
	    return $response;
        }

	$un = $this->registerdb->real_escape_string($username);
	$pw = $this->registerdb->real_escape_string($password);
	//$hpw = $this->hashPassword($pw); 
	$fn = $this->registerdb->real_escape_string($fname);
	$ln = $this->registerdb->real_escape_string($lname);
	$em = $this->registerdb->real_escape_string($email);
        $addquery = "insert into users(fname,lname,email,username,password) values ('$fn','$ln','$em','$un','$pw');";
	$this->registerdb->query($addquery);
	//echo "success".PHP_EOL;
	$response = true;
	return $response;
	
}
}
?>
