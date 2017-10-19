<?php
include('functions.php');

//session_start();
class forumsdb
{

private $registerdb;

public function __construct()
{
	$this->registerdb = new mysqli("127.0.0.1","root","Singh4646","it490");

	if ($this->registerdb->connect_errno != 0)
	{
		echo "Error connecting to database: ".$this->registerdb->connect_error.PHP_EOL;
		exit(1);
	}
	//echo "correctly connected to database".PHP_EOL;
}

public function writeComment($comment)
{
    	if ($this->getClientId($comment) != 0)
        {
            echo "exist".PHP_EOL;
            $response=false;
	    return $response;
        }

        //$username = $_SESSION["user"];
        //$id = $_SESSION["id"]
	$comment = $this->registerdb->real_escape_string($comment);
        $addquery = "insert into moviecomments(userid, comment) values (5,'$comment');";
	$this->registerdb->query($addquery);
	//echo "success".PHP_EOL;
	return $comment;
	
}
}
?>