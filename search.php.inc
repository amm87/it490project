<?php

class searchdb
{


private $db;
private $salt;

public function __construct()
{
	$this->db = new mysqli("127.0.0.1","root","123456","it490");

	if ($this->db->connect_errno != 0)
	{
		echo "Error connecting to database: ".$this->searchdb>connect_error.PHP_EOL;
		exit(1);
	}
	echo "correctly connected to database".PHP_EOL;
}

public function searchMovie($moviename)
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

}
?>
