<?php
    session_start();
    if(!isset($_SESSION['username'])){
        header('location:loginpage.php');
    }
?>





<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intro.js/3.4.0/introjs.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intro.js/3.4.0/intro.min.js"></script>
    <link rel="stylesheet" href="intro-tour-styles.css">


    <title>Inventory Manager</title>
    

    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            height: 100vh;
            overflow: hidden;
            perspective: 1px;
        }

        .dashboard {
            background-color: #2C3E50;
            color: white;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 2rem;
            margin-top: 6rem;
            font-size: medium;
        }

        .dashboard h1 {
            font-size: 25px;
            margin-bottom: 5px;
        }


        .sidenav {
            height: 100%;
            width: 0;
            position: fixed;
            z-index: 1;
            top: 0;
            left: 0;
            background-color: #50a8a1;
            overflow-x: hidden;
            transition: 0.5s;
            padding-top: 60px;
        }

        .sidenav a {
            padding: 8px 8px 8px 32px;
            text-decoration: none;
            font-size: 25px;
            color: #818181;
            display: block;
            transition: 0.3s;
        }

        .sidenav a:hover {
            color: #f1f1f1;
        }

        .sidenav .closebtn {
            position: absolute;
            top: 0;
            right: 25px;
            font-size: 36px;
            margin-left: 50px;
        }


        .topnav {
            overflow: hidden;
            background-color: #2C3E50;
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1000;
            font-size: large;
            margin-top: 5px;
            padding-bottom: 1px;
        }

        .topnav a {
            float: left;
            display: block;
            color: white;
            text-align: center;
            padding: 13px 15px;
            text-decoration: none;
            font-size: large;
            
        }

        .topnav .icon {
            display: none;
            float: right;
            padding: 16px 20px;
            font-size: 10rem;
        }

        .topnav a:hover {
            background-color: #ddd;
            color: black;
        }

        /* New style for the tour button */
        #startTour {
            background-color: #4CAF50;
            /* Green */
            border: none;
            color: white;
            padding: 15px 32px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
            border-radius: 4px;
        }

        /* Positioning for the tour button */
        #startTourContainer {
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 1000;
            /* Ensure it's above other elements */
        }


        @media screen and (max-width: 600px) {
            .topnav a:not(:first-child) {
                display: none;
            }

            .topnav a.icon {
                float: right;
                display: block;
                font-size: 2rem;
                
            }
        }

        @media screen and (max-height: 450px) {
            .sidenav {
                padding-top: 15px;
            }

            .sidenav a {
                font-size: 18px;
            }
        }

        @media screen and (max-width: 600px) {
            .topnav.responsive {
                position: relative;
            }

            .topnav.responsive .icon {
                position: absolute;
                right: 0;
                top: 0;
            }

            .topnav.responsive a {
                float: none;
                display: block;
                text-align: left;
            }

            .topnav {
                font-size: 2rem;
            }
        }

        footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            text-align: left;
            padding-left: 20px;
            background-color: #2C3E50;
            color: white;
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
        }
    </style>
</head>

<body>



     <!-- Update your top navigation links with IDs -->
     <div class="topnav" id="myTopnav">
        <a href="homepage.php" id="homeBtn"><img src="logo.png" style="width:2rem; height:2rem;"></a>
        <a href="generateform.php" style="background:#233140;" id="inventoryBtn">Inventory</a>
        <a href="generatelist.php" id="viewBtn">View</a>
        <a href="generatereport.php" id="reportBtn">Report</a>
        <a href="logoutpage.php" style="background:#233140" id="logoutBtn">Logout <span class="fa fa-sign-out"></span></a>
        <a href="javascript:void(0);" class="icon" onclick="toggleNav()">
            <i class="fa fa-bars"></i>
        </a>
    </div>

    <script>
        function toggleNav() {
            var x = document.getElementById("myTopnav");
            if (x.className === "topnav") {
                x.className += " responsive";
            } else {
                x.className = "topnav";
            }
        }
    </script>


    <div id="startTourContainer">
        <button id="startTour" onclick="startTour()">Start System Guide</button>
    </div>
    <!-- Rest of your content -->
    <div style="margin-top: 30px;">
        <div class="dashboard">
            <img src="logo.png" alt="Logo" style="float:left;width:80px;height:auto;">
            <h1> Philippine Atmospheric, Geophysical and Astronomical Services Administration</h1>
            <h2> Inventory Manager System</h2>
            <p id="clock">Date and Time: Loading...</p>

        </div>

    </div>


    <!-- Announcement Section with Animated Steve Enjoying the Weather -->
    <div style="margin-top: 20px; padding: 20px; background-color: #ffffff; border-radius: 8px; position: relative; overflow: hidden;" id="announce">
        <h2>Announcements</h2>

        <?php
        
        require '../backend/db.php';

        // Fetch only 2 announcements from the database
        $announcementQuery = "SELECT * FROM announcement ORDER BY id DESC LIMIT 2";
        $announcementResult = mysqli_query($conn, $announcementQuery);

        if ($announcementResult && mysqli_num_rows($announcementResult) > 0) {
            while ($row = mysqli_fetch_assoc($announcementResult)) {
                echo '<div>';
                echo '<h3>' . $row['announcementTitle'] . '</h3>';
                echo '<p>' . $row['announcementDescription'] . '</p>';
                echo '</div>';
            }
        } else {
            echo '<p>No announcements available.</p>';
        }

        ?>

        <?php
        if ($_SESSION['auth'] == 1) {
            echo '<p>You are using an admin account.</p>';
        }
        ?>
    </div>


    <footer>
        <p>Copyright © Zyril Evangelista. 2024. All rights Reserved.</p>
    </footer>

    <script>
        function openNav() {
            document.getElementById("mySidenav").style.width = "250px";
        }

        function closeNav() {
            document.getElementById("mySidenav").style.width = "0";
        }

        function toggleNav() {
            var sideNavWidth = document.getElementById("mySidenav").style.width;
            if (sideNavWidth === "250px") {
                closeNav();
            } else {
                openNav();
            }
        }
    </script>
    <script src="time.js"></script>
    <script src="tour.js"></script>
</body>

</html>