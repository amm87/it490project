#!/usr/bin/php
<?php

include("search.php.inc");
 $db = new searchdb();
    $response = $db ->searchMovie("platoon");
   echo $response;


?>
