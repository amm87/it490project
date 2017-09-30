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

public function registerUser($username,$password)
{
	$un = $this->registerdb->real_escape_string($username);
	$pw = $this->registerdb->real_escape_string($password);
        $addquery = "insert into users(screenname,password) values ('$un','$pw');";
	$this->registerdb->query($addquery);
}
}
?>