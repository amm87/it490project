<html>
<head>
<link rel="stylesheet" href="bootstrap.css">
    <style>
        footer {
            background-color: skyblue;
        }
        .button {
            background-color: #4CAF50;
            border: none;
            color: white;
            padding: 15px 32px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
        }
        .dropbtn {
            background-color: skyblue;
            color: red;
            padding: 16px;
            font-size: 16px;
            border: none;
            cursor: pointer;
        }
        .dropdown {
            position: relative;
            display: inline-block;
        }
        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 120px;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 1;
        }
            .dropdown-content a {
                color: black;
                padding: 12px 16px;
                text-decoration: none;
                display: block;
            }
                .dropdown-content a:hover {
                    background-color: #f1f1f1
                }
        .dropdown:hover .dropdown-content {
            display: block;
        }
        .dropdown:hover .dropbtn {
            background-color: #3e8e41;
        }
        a {
            text-decoration:none;
            }
    </style>
    <meta charset="utf-8" />
    <a href="MainPage.php" style="text-decoration:none;"><font color='red' size='5'>The Movie Database</font></a>
   
</head>


<body onload="document.getElementById('demo1').innerHTML = ('<?php naming() ?>');">

    <p align="right" id="demo1">
    </p>
    <table bgcolor="skyblue">

        <tr>
            <td style="padding:0 15px 0 20px;">
                <div class="dropdown">
                    <button class="dropbtn"><b>Upcoming</b></button>
                    <div class="dropdown-content">
                       
                        <a href="ThisMonth.php"><font size="2">In the Month</font></a>
                        <a href="YearLineups.php"><font size="2">Year Linups</font></a>
                    </div>
            </td>
            <td style="padding:0 15px 0 20px;">
                <div class="dropdown">
                    <button class="dropbtn"><b>Released</b></button>
                    <div class="dropdown-content">
                        <a href="TheatreList.php"><font size="2">Theatre List</font></a>
                        <a href="Mapview.php"><font size="2">Map View</font></a>
                    </div>
            </td>
            <td style="padding:0 15px 0 20px;">
                <div class="dropdown">
                    <button class="dropbtn"><b>Communities</b></button>
                    <div class="dropdown-content">
                        <a href="Forums.php"><font size="2">Forums</font></a>
                    </div>
            </td>
            <td style="padding:0 15px 0 20px;">
                <div class="dropdown">
                    <button class="dropbtn"><b>Genre</b></button>
                    <div class="dropdown-content">
                        <a onclick="document.getElementById('demo').innerHTML = ('<?php display('Action') ?>');"><font size="2"></font></a>
                        <a onclick="document.getElementById('demo').innerHTML = ('<?php display('Action') ?>');"><font size="2">Action</font></a>
                        <a onclick="document.getElementById('demo').innerHTML = ('<?php display('Adventure') ?>');"><font size="2">Adventure</font></a>
                        <a onclick="document.getElementById('demo').innerHTML = ('<?php display('Animated') ?>');"><font size="2">Animated</font></a>
                        <a onclick="document.getElementById('demo').innerHTML = ('<?php display('Comedy') ?>');"><font size="2">Comedy</font></a>
                        <a onclick="document.getElementById('demo').innerHTML = ('<?php display('Drama') ?>');"><font size="2">Drama</font></a>
                        <a onclick="document.getElementById('demo').innerHTML = ('<?php display('Documentary') ?>');"><font size="2">Documentary</font></a>
                        <a onclick="document.getElementById('demo').innerHTML = ('<?php display('Fantasy') ?>');"><font size="2">Fantasy</font></a>
                        <a onclick="document.getElementById('demo').innerHTML = ('<?php display('Foreign') ?>');"><font size="2">Foreign</font></a>
                        <a onclick="document.getElementById('demo').innerHTML = ('<?php display('Horror') ?>');"><font size="2">Horror</font></a>
                        <a onclick="document.getElementById('demo').innerHTML = ('<?php display('Romance') ?>');"><font size="2">Romance</font></a>
                        <a onclick="document.getElementById('demo').innerHTML = ('<?php display('ScienceFiction') ?>');"><font size="2">Science Fiction</font></a>
                        <a onclick="document.getElementById('demo').innerHTML = ('<?php display('Supernatural') ?>');"><font size="2">Supernatural</font></a>
                        <a onclick="document.getElementById('demo').innerHTML = ('<?php display('Suspense') ?>');"><font size="2">Suspense</font></a>
                    </div>
            </td>
            <td style="padding:0 15px 0 20px;">
                <div class="dropdown">
                    <button class="dropbtn"><b>My Account</b></button>
                    <div class="dropdown-content">
                        <a href="Watchlist.php?movie_id=-1"><font size="2">Watchlist</font></a>
                    </div>
            </td>
            <td style="padding:10px 40px 0px 20px;">
		<form action="search.php" method="post">
                <form>
                <input type="text" name="search" placeholder="Search..">
                </form>
		
	</td>
        </tr>
    </table>
    <br /><br />
    <p id="demo"><font size="5" color="red">Theatre List</font>
    <br><br><br>
     <?php
            require_once("TheList.php");
        ?>
    </p>
        
    <?php
    /**
    * Get the name of the signed in user
    */
    function naming()
    {
    session_start();
    echo $_SESSION['user'];
    
    echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
    echo "<a href=index.php class=button>Sign Out</a>";
    }
    /**
    * Returns all the movies in the Database based off of @param value
    * Images are linked so that when you click on an image, you are 
    * taken to Forums.php to comment and view comments on that specific movie. 
    * 
    * @param value is the name of the Genre the user click on for viewing.
    */
    function display($value)
    {
    echo $value;
    echo "<br><br><br><br>";
    require_once('get_host_info.inc');
    require_once('rabbitMQLib.inc');
    $request = array();
    $request['type'] = "genre";
    $request['genre'] = $value;
    $client = new rabbitMQClient("testRabbitMQ.ini", "testServer");
    $response = $client->send_request($request);
    $r = json_decode($response, true);
    echo "<table>";
    $counter = 0;
    foreach ($r as $movie)
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
    $value = $movie["id"];
    $link = "Forums.php?type=2&movieid=$value";
    echo "<a href=$link><img src=$path></a><br>";
    $link_2 = "Watchlist.php?movie_id=".$value;
    echo "<a href=$link_2>".$movie['title']."</a><br>";
    echo $movie['releaseDate'];
    echo "</td>";
    
    $counter++;
    }
    echo "</table>";
    $payload = json_encode($response);
    }
    ?>
    <footer>
        <center>
            <table>
                <tr>
                    <td style="padding:0 15px 0 40px;">Home</td>
                    <td style="padding:0 15px 0 40px;">About</td>
                    <td style="padding:0 15px 0 40px;">Support</td>
                    <td style="padding:0 15px 0 40px;">Terms</td>
                    <td style="padding:0 15px 0 40px;">Privacy</td>
                    <td style="padding:0 15px 0 40px;">Login</td>
                    <td style="padding:0 15px 0 40px;">Signup</td>
                </tr>
            </table>
        </center>
        <br /><br />
        <center>By: Manish Singh, Anthony Morales, Shanon Hargrave, Brian Omoni, Yaghsha Shah</center>
        <br />
        <center>Contact information: <a href="mailto:GFY@njit.edu">GFY@njit.edu</a>.</center>
        <br />
        <center>Copyright Because I Said So! All Rights SUYA</center>
    </footer>
</body>
</html>
