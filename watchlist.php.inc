<?php
class watchdb
{


private $db;
private $salt;

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
    
public function addWatchList($movieid){
        $userid= $_SESSION['uid'];
        $addquery = "insert into watchlist(movieid,userid) values ('$movieid','$userid');";
	$this->registerdb->query($addquery);
	

}

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
