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
    
    private function displayMovies($resultArray, $exclude)
    {
      $counter = 0;
      $otherCounter = 0;
      echo "<table>";
      foreach ($resultArray as $movie)
      {
        if (!in_array($movie, $exclude))
        {
      
        if ($counter === 0)
        {
          echo "<tr>";
        }
        else if ($counter === 4)
        {
          echo "</tr>";
          $counter = 0;
        }

        echo "<td>";
        $path = "http://image.tmdb.org/t/p/w185/".$movie["imagePath"];
        echo "<a href='http://www.njit.edu'><img src='$path'/></a><br>";
        echo $movie['title']."<br>";
        echo $movie['releaseDate'];
        echo "</td>";
        
        $counter++;
      }
      }
      echo "</table>";
    }
 
    public function moviesByGenre($genre)
    {
      $query = "select * from movies where genre = '$genre';";
      $result = $this->database->query($query);
      $counter = 0;
      $resultArray = array();
      while ($movie = $result->fetch_assoc())
      {
        $resultArray[$counter] = $movie;
        $counter++;
      }
      $this-> displayMovies($resultArray, array());
    }
    
    public function addMovie($query)
    {
      $results = $this->database->query($query);
    }
     
    public function releasedMovies()
    {
        $query = "select * from movies;";
        $result = $this->database->query($query);
        $exclude = array();
        $resultArray = array();
        $counter = 0;       
        
        while ($movie = $result->fetch_assoc())
        {
          $resultArray[$counter] = $movie;
          $release = strtotime( $movie["releaseDate"]);
          if ($release > strtotime("now"))
          {
            $exclude[$counter] = $movie;
          }
          $counter++;
        }
        $this->displayMovies($resultArray, $exclude);
    }

    public function upcomingMovies($range)
    {
      $query = "select * from movies;";
      $result = $this->database->query($query);
      $startTime;
      $endTime;
      $resultArray = array();
      $exclude = array();
      $counter = 0;
      while ($movie = $result->fetch_assoc())
      {
        $resultArray[$counter] = $movie;
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

        if (($time <= $startTime) || ($time >= $endTime))
        {
          $exclude[$counter] = $movie;
        }
        $counter++;
      }
      $this->displayMovies($resultArray, $exclude);
    }

    public function moviesByRating($type)
    {
      
    }
  }
?>
