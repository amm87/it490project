<?php
require_once('movies.php.inc');
class watchdb
{

private $db;
private $salt;
private $movie_db;

    /**
    * Verify and connect to database via credentials provided below
    * If connection was not established, echo a statement saying so
    */
public function __construct()
{
	$this->db = new mysqli('192.168.1.150', 'root', '123456', 'it490');
	$this->movie_db = new moviedb();

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
public function addWatchList($movieid) {
        $userid= $_SESSION['id'];
        $addquery = "insert into watchlist(movieid,userid) values ('$movieid','$userid');";
	$this->db->query($addquery);
}

    /**
    * verify and get the watch list
    * @param is the name of the movie the user has provided
    */
public function getWatch()
    {
        $final_array = array();
        $userid = $_SESSION['id'];
	$query = "select * from watchlist where userid = '$userid';";
	$results = $this->db->query($query);
	$count = 0;
	if (!$results)
	{
            return 0;
	}
	while ($id_array = $results->fetch_assoc())
	{
            $movie_id = $id_array['movieid'];
            $movie_query = "select * from movies where id = '$movie_id';";  
            $movie_results = $this->db->query($movie_query);
            if (!$results)
            {
                return 0;
            }
            while ($movie_array = $movie_results->fetch_assoc())
            {
                if (in_array($movie_array, $final_array)) 
                    continue;
                    
                $final_array[$count] = $movie_array;
                $count++;
            }
	}
	
	return $final_array;
    }

//381288



}
?>
