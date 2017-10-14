<?php
  
  class moviedb
  {
    private $database;
    public function __construct()
    {
      $this->database = new mysqli('127.0.0.1', 'root', 'abc123', 'it490');
      
      if ($this->database->connect_errno > 0)
      {
        echo "Could not connect to database".PHP_EOL;
      }
    }    

    private function displayMovie($movie)
    {
      $path = "http://image.tmdb.org/t/p/w185/".$movie["imagePath"];
      echo "<img src='$path'/><br>";
      echo $movie['title']."<br>";
      echo $movie['releaseDate']."<br>";
      echo "<br>";
    }
 
    public function moviesByGenre($genre)
    {
      $query = "select * from movies where genre = '$genre';";
      $result = $this->database->query($query);
     
      while ($movie = $result->fetch_assoc())
      {
        $this->displayMovie($movie);
      }
    }
    
    public function addMovie($query)
    {
      $results = $this->database->query($query);
    }
     
    public function releasedMovies()
    {
        $query = "select * from movies;";
        $result = $this->database->query($query);
       
        while ($movie = $result->fetch_assoc())
        {
          $release = strtotime( $movie["releaseDate"]);
          if ($release < strtotime("now"))
          {
            $this->displayMovie($movie);
          }
        }
    }

    public function upcomingMovies($range)
    {
      $query = "select * from movies;";
      $result = $this->database->query($query);
      $startTime;
      $endTime;
      while ($movie = $result->fetch_assoc())
      {
        $time = strtotime($movie['releaseDate']);
        
        if ($range === "week")
        { 
          $startTime = strtotime("monday this week");
          $endTime  =  strtotime("sunday this week");
        }
        else if ($range === "month")
        {
          $startTime = strtotime("first day of this month");
          $endTime  =  strtotime("last day of this month");
        }
        else if ($range === "year")
        {
          $startTime = strtotime("first day of January this year");
          $endTime  =  strtotime("last day of December this year");
        }

        if (($time >= $startTime) && ($time <= $endTime))
        {
	  $this->displayMovie($movie);
        }
      }
    }

    public function moviesByRating($type)
    {
      
    }
  }
?>
