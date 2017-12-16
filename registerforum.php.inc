<?php
include('functions.php');

//session_start();
class forumsdb
{

private $registerdb;

    /**
    * Verify and connect to database via credentials provided below
    * If connection was not established, echo a statement saying so
    */
public function __construct()
{
	$this->registerdb = new mysqli("192.168.1.150","root","123456","it490");

	if ($this->registerdb->connect_errno != 0)
	{
		echo "Error connecting to database: ".$this->registerdb->connect_error.PHP_EOL;
		exit(1);
	}
	//echo "correctly connected to database".PHP_EOL;
}

    /**
    * Grab the comments made and saved from the database using @param
    * @param value is the ID of the movie
    */
public function getComments($movieId)
    {
      $query = "select * from moviecomments where movieid = '$movieId'";
      $result = $this->registerdb->query($query);
      while ($row = $result->fetch_assoc())
      {
        echo $row['comment'];
        echo "<br>";
        echo "<br>";
      }
    }

    /**
    * Write the comments saved to the page for viewing using @param
    * @param comment is the comment we have saved in the database
    * @param moveID is the ID of the movie we were given to begin with
    */
public function writeComment($comment, $movieId)
{
    //	if ($this->getClientId($comment) != 0)
       // {
           // echo "exist".PHP_EOL;
          //  $response=false;
	 //   return $response;
       // }

        //$username = $_SESSION["user"];
        //$id = $_SESSION["id"]
	$comment = $this->registerdb->real_escape_string($comment);
        $addquery = "insert into moviecomments(userid, comment, movieId) values (5,'$comment', $movieId);";
	$this->registerdb->query($addquery);
	//echo "success".PHP_EOL;
	return $comment;
	
}
}
?>
