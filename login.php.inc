<?php
class loginDB
{


private $logindb;
private $salt;

/**
* Verify and connect to database via credentials provided below
* If connection was not established, echo a statement saying so
*/
public function __construct()
{
	$this->logindb = new mysqli("192.168.1.150","root","123456","login");

	if ($this->logindb->connect_errno != 0)
	{
		echo "Error connecting to database: ".$this->logindb->connect_error.PHP_EOL;
		exit(1);
	}
	echo "correctly connected to database".PHP_EOL;
}

/**
* Validate the username and password entered by checking the provided
* info in the database that only has users in it using the @param
* @param username is the username the user is trying to gain access with
* @param password is the passowrd to the username the user is using
*/
public function validateLogin($username,$password)
{
	$un = $this->logindb->real_escape_string($username);
	$pw = $this->logindb->real_escape_string($password);
	$statement = "select * from users where username = '$un';";
	$response = $this->logindb->query($statement);
	
	while ($row = $response->fetch_assoc())
	{
		//echo "checking password for $username".PHP_EOL;
		if ($row["password"] == $pw)
		{
                    $temp = $row['id'];
                
			//header("Location: index.html");
			echo "<script language='JavaScript'>
                        alert('$temp')
                        </script>";
			return true;
		}
	}
	
      echo "wrong pass";
      return false; 
}m
}
?>
