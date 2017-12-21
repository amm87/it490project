<?php

class searchdb
{


private $db;
private $salt;

    /**
    * Verify and connect to database via credentials provided below
    * If connection was not established, echo a statement saying so
    */
public function __construct()
{
	$this->db = new mysqli("192.168.1.150","root","123456","it490");

	if ($this->db->connect_errno != 0)
	{
		echo "Error connecting to database: ".$this->searchdb>connect_error.PHP_EOL;
		exit(1);
	}
	echo "correctly connected to database".PHP_EOL;
}

    /**
    * search a movie in the Database using the @param and display info
    * @param is the name of the movie the user has provided
    */
public function searchMovie($moviename)
    {
	$query = "select * from movies where title = '$moviename';";
	$results = $this->db->query($query);
	if (!$results)
	{
	    //$this->logger->log("error with results: ".$this->db->error);
	    return 0;
	}
        $client = $results->fetch_assoc();
	
	return json_encode($client);
    }

}
?>
