<?php
class registerDB
{
private $registerdb;

public function __construct()
{
	$this->registerdb = new mysqli("127.0.0.1","root","123456","login");

	if ($this->registerdb->connect_errno != 0)
	{
		echo "Error connecting to database: ".$this->registerdb->connect_error.PHP_EOL;
		exit(1);
	}
	echo "correctly connected to database".PHP_EOL;
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
            //echo "exist".PHP_EOL;
	    return "exist";
	}

	$un = $this->registerdb->real_escape_string($username);
	$pw = $this->registerdb->real_escape_string($password);
	$fn = $this->registerdb->real_escape_string($fname);
	$ln = $this->registerdb->real_escape_string($lname);
	$em = $this->registerdb->real_escape_string($email);
        $addquery = "insert into users(fname,lname,email,username,password) values ('$fn','$ln','$em','$un','$pw');";
	$this->registerdb->query($addquery);
	//echo "success".PHP_EOL;
	return "success";
	
}
}
?>