 <?php
      require_once("movies.php.inc");
      $db = new moviedb();
      $client = new rabbitMQClient("testRabbitMQ.ini", "testServer");
      $db->moviesByGenre("Action");
?>

