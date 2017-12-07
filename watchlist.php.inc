<?php
class watchdb
{


private $db;
private $salt;

    /**
    * Verify and connect to database via credentials provided below
    * If connection was not established, echo a statement saying so
    */
public function __construct()
{
	$this->db = new mysqli("127.0.0.1","root","123456","it490");

	if ($this->db->connect_errno != 0)
	{
		echo "Error connecting to database: ".$this->watchdb>connect_error.PHP_EOL;
		exit(1);
	}
	//echo "correctly connected to database".PHP_EOL;
}

    /**
    * search a movie in the Database using the @param and display info
    * @param is the name of the movie the user has provided
    */
public function searchMovieWatch($moviename)
    {
	$query = "select id from movies where title = '$moviename';";
	$results = $this->db->query($query);
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
    
    /**
    * add a movie to a list based off of @param
    * @param is the id of the movie requested
    */   
public function addWatchList($movieid){
        $userid= $_SESSION['uid'];
        $addquery = "insert into watchlist(movieid,userid) values ('$movieid','$userid');";
	$this->registerdb->query($addquery);
	

}

    /**
    * verify and get the watch list
    * @param is the name of the movie the user has provided
    */
public function getWatch()
    {
        $userid = $_SESSION['uid'];
	$query = "select movieid from watchlist where userid = '$userid';";
	$results = $this->db->query($query);
	if (!$results)
	{
	    //$this->logger->log("error with results: ".$this->db->error);
	    return 0;
	}
        $client = $results->fetch_assoc();
	if (isset($client['userid']))
	{
	    return $client['userid'];
	}
	return 5;
    }

//381288



}
?>
