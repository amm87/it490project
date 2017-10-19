<!DOCTYPE html>
<html>
<head>
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
    </style>
    <meta charset="utf-8" />
    <title>The Movie Database</title>
</head>
<body>
    <font color="Red" size="5">The Movie Database</font>
    <p align="right">
        <a href="signin.html" class="button">Login</a>
        <a href="signup.html" class="button">Sign Up</a>
    </p>
    <table bgcolor="skyblue">

        <tr>
            <td style="padding:0 15px 0 40px;">
                <div class="dropdown">
                    <button class="dropbtn"><b>Upcoming</b></button>
                    <div class="dropdown-content">
                        <a href="ThisMonth.php"><font size="2">In the Month</font></a>
                        <a href="YearLineups.php"><font size="2">Year Linups</font></a>
                    </div>
            </td>
            <td style="padding:0 15px 0 40px;">
                <div class="dropdown">
                    <button class="dropbtn"><b>Released</b></button>
                    <div class="dropdown-content">
                        <a href="InTheatres.php"><font size="2">In Theatres</font></a>
                        <a href="LatestTrailers.php"><font size="2">Latest Trailers</font></a>
                    </div>
            </td>
            <td style="padding:0 15px 0 40px;">
                <div class="dropdown">
                    <button class="dropbtn"><b>Communities</b></button>
                    <div class="dropdown-content">
                        <a href="Forums.html"><font size="2">Forums</font></a>
                        <a href="Blogs.html"><font size="2">Blogs</font></a>
                        <a href="Articles.html"><font size="2">Articles</font></a>
                    </div>
            </td>
            <td style="padding:0 15px 0 40px;">
                <div class="dropdown">
                    <button class="dropbtn"><b>Genre</b></button>
                    <div class="dropdown-content">
                        <a href="Action.html"><font size="2">Action</font></a>
                        <a href="Adventure.html"><font size="2">Adventure</font></a>
                        <a href="Animated.html"><font size="2">Animated</font></a>
                        <a href="Comedy.html"><font size="2">Comedy</font></a>
                        <a href="Drama.html"><font size="2">Drama</font></a>
                        <a href="Documentary.html"><font size="2">Documentary</font></a>
                        <a href="Fantasy.html"><font size="2">Fantasy</font></a>
                        <a href="Foreign.html"><font size="2">Foreign</font></a>
                        <a href="Horror.html"><font size="2">Horror</font></a>
                        <a href="Romance.html"><font size="2">Romance</font></a>
                        <a href="ScienceFiction.html"><font size="2">Science Fiction</font></a>
                        <a href="Supernatural.html"><font size="2">Supernatural</font></a>
                        <a href="Suspense.html"><font size="2">Suspense</font></a>
                    </div>
            </td>
            <td style="padding:0 15px 0 40px;">
                <div class="dropdown">
                    <button class="dropbtn"><b>Ratings</b></button>
                    <div class="dropdown-content">
                        <a href="Top.html"><font size="2">Top Rated This Year</font></a>
                        <a href="AllTime.html"><font size="2">All Time Bests</font></a>
                        <a href="MostPopular.html"><font size="2">Most Popular</font></a>
                    </div>
            </td>

		<td style="padding:0 15px 0 40px;">
                <div class="dropdown">
                    <button class="dropbtn"><b>My Account</b></button>
                    <div class="dropdown-content">
                        <a href="Watchlist.php"><font size="2">Watchlist</font></a>
                        <a href="Notification.php"><font size="2">Notifications</font></a>
                    </div>
            </td>

            <td style="padding:0 15px 0 250px;">
		<form action="search.php" method="post">
                <form>
                <input type="text" name="search" placeholder="Search..">
                </form>

</td>
        </tr>
    </table>
    <br /><br />

 

        <font size="5" color="red"><b>Watchlist</b></font> 
        <br /><br />
            <br /><br /><br /><br />

        <?php

        //require_once("movies.php.inc");
       // require_once("watchlist.php.inc");
        
        //$db = new watchdb();
        //$db = new moviedb();
        //$db->watchlist();
        //echo $db-> getWatch($_SESSION['id']);
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
