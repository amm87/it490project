<?php

include ("account.php");

function user ( $user, $password) 
{ 
	
 
	$fetch = ("SELECT * FROM Prototype1Table1 WHERE user = '$name' AND pass = '$password'"); 
	$t = mysql_query($fetch); $numrows = mysql_num_rows($t); 
	
	if($numrows !=0)
	{
		$_SESSION["logged"] = true;
		$_SESSION["user"] = $user;
		$_SESSION["state"] = 'user';
		$sql= "SELECT * FROM Prototype1Table1 WHERE user = '$user' AND pass = '$password'"; 
		$table = mysql_query($sql) or die( mysql_error () ); 
		$fetch = mysql_fetch_array($table); 
	 
		$message = "<br><br>Good credentials";
		$url = "TheMovieDatabase.html";
		redirect($message, $url);
	} 
	
	else
	{ 
		$message = "<br>Incorrect username or password.";
		$url = "signin.html";
		redirect($message, $url);
	}
}

function update ($user, $password)
{

//change a row in A - use an update SQL
	
	$s = "insert into Prototype1Table2 values ( '$user', '$password', NOW())";
	echo "<br>SQL insert to Prototype1Table2: $s.";
	mysql_query ($s) or die (mysql_error());
	



}
	
?>