<?php
class loginDB
{


private $logindb;
private $salt;

public function __construct()
{
	$this->logindb = new mysqli("127.0.0.1","root","123456","login");

	if ($this->logindb->connect_errno != 0)
	{
		echo "Error connecting to database: ".$this->logindb->connect_error.PHP_EOL;
		exit(1);
	}
	echo "correctly connected to database".PHP_EOL;
}

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
			//header("Location: index.html");
			return true;
		}
	}
	//echo "<script language='JavaScript'>
	 //   alert('Username or Password was entered incorrectly')
	  //  location='signin.html'
	  //  </script>";
	  echo "wrong pass";
      return false; 
}
}
?>
