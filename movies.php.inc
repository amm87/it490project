<?php

  class moviedb
  {
    private $database;
    private $client;

    /**
    * Verify and connect to database via credentials provided below
    * If connection was not established, echo a statement saying so
    */
    public function __construct()
    {
      $this->database = new mysqli('192.168.1.150', 'root', '123456', 'it490');
      
      if ($this->database->connect_errno > 0)
      {
        echo "Could not connect to database".PHP_EOL;
      }
    }    
    
    
    /**
    * Grab the movie name, picture, release date, etc. andd display it
    * based off of the @param
    * @param value is the ID of the movie
    */
    public function showMovieInfo($movieId)
    {
      $query = "select * from movies where id = '$movieId'";
      $result = $this->database->query($query);
      $movie = $result->fetch_assoc();
      $path = "http://image.tmdb.org/t/p/w185/".$movie["imagePath"];
      echo "<a href='Forums.php?type=2&movieid=".$movie["id"]."'><img src='$path'/></a><br>";
      echo $movie['title']."<br>";
      echo $movie['releaseDate']."<br><br>";

    }

    /**
    * Add moved to an Array which can be used to pull data from later
    * If the movie is already in the Array, do not add it again
    * @param value resultArray is the Array we are constantly using
    * @param value exclude is the movie we are checking if it is in the Array
    */
    private function displayMovies($resultArray, $exclude)
    {
      $counter = 0;
      $otherCounter = 0;
      $result = array();
      foreach ($resultArray as $movie)
      {
        
        if (!in_array($movie, $exclude))
        {
            $result[$otherCounter] = $movie;
            $otherCounter++;    
        }
      }
      $response = json_encode($result);
      return $response;
    }

    /**
    * Get the comments for a specific movie and display it
    * Get the movie based off of the @param
    * @param value the movie ID we use to pull the comments for it
    */
    public function getComments($movieId)
    {
      $query = "select * from moviecomments where id = '$movieId'";
      $result = $this->database->query($query);
      while ($row = $result->fetch_assoc())
      {
 	echo $row['comment'];
      }
    }
 
    /**
    * Grab the movie name based off of the genre and display it
    * based off of the @param
    * @param value is the genre the user is requesting to see
    */
    public function moviesByGenre($genre)
    {
      $query = "select * from movies where genre = '$genre';";
      $result = $this->database->query($query);
      $counter = 0;
      $resultArray = array();
      $request = array();

        while ($movie = $result->fetch_assoc())
        {
          $resultArray[$counter] = $movie;
          $counter++;
        }
        return  $this->displayMovies($resultArray, array());
    }
    
    /**
    * Add a movie to the current database 
    * @param value is the query we use to connect 
    */
    public function addMovie($query)
    {
      $results = $this->database->query($query);
    }
    
    /**
    * Grab the movies based off the newest release and
    * send to the displayMovies function to add to the 
    * array
    */
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

    /**
    * Grab the movies based off the @param 
    * and send to the Array and display to the page
    * @param value is the year, month, or week you want to see
    */
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
     return $this->displayMovies($resultArray, $exclude);
    }

    public function moviesByRating($type)
    {
      
    }
  }
?>
