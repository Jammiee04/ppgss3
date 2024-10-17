<?php
session_start();
if (!isset($_SESSION['adminLogin'])) {
    header('location:loginpage.php');
    exit();
}

include('../backend/db.php');

// Fetch announcements
$allAnnouncementsQuery = "SELECT * FROM announcement ORDER BY id DESC";
$allAnnouncementsResult = mysqli_query($con, $allAnnouncementsQuery);
$announcements = mysqli_fetch_all($allAnnouncementsResult, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intro.js/5.1.0/introjs.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intro.js/5.1.0/intro.min.js"></script>
    <link rel="stylesheet" href="intro-tour-styles.css">
    <link rel="icon" href="../frontend/logo.png" type="image/x-icon">
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
            background-color: #365486;
            color: white;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 2rem;
            margin-top: 6rem;
            font-size: medium;
        }

        .dashboard h1 {
            font-size: 25px;
            margin-bottom: 6px;
            text-align: center;
        }

        .sidenav {
            height: 100%;
            width: 0;
            position: fixed;
            z-index: 1;
            top: 0;
            left: 0;
            background-color: #365486;
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
            color: #192655;
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
            background-color: #0F1035;
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1000;
            font-size: large;
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
            background-color: none;
           
        }

        /* New style for the tour button */
        #startTour {
            background-color: #180161;
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

        .announcements-container {
            background-color: #f8f9fa;
            border-radius: 8px;
            padding: 20px;
            margin-top: 20px;
            max-width: 800px;
            width: 90%;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .announcements-header {
            background-color: #365486;
            color: white;
            padding: 10px 15px;
            border-radius: 8px 8px 0 0;
            margin: -20px -20px 20px -20px;
        }
        .announcement-item {
            background-color: white;
            border: 1px solid #e0e0e0;
            border-radius: 4px;
            padding: 15px;
            margin-bottom: 15px;
        }
        .announcement-item:last-child {
            margin-bottom: 0;
        }
        .announcement-title {
            color: #365486;
            margin-top: 0;
            font-size: 1.2em;
        }
        .announcement-date {
            color: #666;
            font-size: 0.9em;
            margin-top: 5px;
        }
        .no-announcements {
            text-align: center;
            color: #666;
            font-style: italic;
        }

        @media screen and (max-width: 600px) {
            .topnav a:not(:first-child) {
                display: none;
            }

            .topnav a.icon {
                float: right;
                display: block;
                font-size: 5rem;
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
        }@media screen and (max-width: 600px) {
            .topnav a:not(:first-child) {
                display: none;
            }

            .topnav a.icon {
                float: right;
                display: block;
                font-size: 5rem;
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
            background-color: #0F1035;
            color: white;
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
        }
    </style>
</head>


<body>
    <div id="mySidenav" class="sidenav">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
        <a href="generateform.php">Inventory</a>
        <a href="generatelist.php">View</a>
        <a href="generatereport.php">Report</a>
        <a href="logout.php">Logout <span class="fa fa-sign-out"></span></a>
    </div>

    <div class="topnav" id="myTopnav">
        <a href="homepage.php" id="homeBtn"><img src="logo.png" style="width:2rem; height:2rem;"></a>
        <a href="generateform.php" id="inventoryBtn">Inventory</a>
        <a href="generatelist.php" id="viewBtn">View</a>
        <a href="generatereport.php" id="reportBtn">Report</a>
        <a href="adminpage.php" id="adminpageBtn">Announcement</a>
        <a href="logoutpage.php" id="logoutBtn">Logout <span class="fa fa-sign-out"></span></a>
        <a href="javascript:void(0);" class="icon" onclick="toggleNav()">
            <i class="fa fa-bars"></i>
        </a>
    </div>

    <div id="startTourContainer">
        <button id="startTour" onclick="startTour()">Start System Guide</button>
    </div>

    <div style="margin-top: 30px;">
        <div class="dashboard">
            <img src="logo.png" alt="Logo" style="float:left;width:80px;height:auto;">
            <h1>Philippine Atmospheric, Geophysical and Astronomical Services Administration</h1>
            <h2>Inventory Manager System</h2>
            <p id="clock">Date and Time:</p>
        </div>
    </div>

    <div class="announcements-container">
        <div class="announcements-header">
            <h2>Latest Announcements</h2>
        </div>
        <?php if (empty($announcements)): ?>
            <p class="no-announcements">No announcements at this time.</p>
        <?php else: ?>
            <?php foreach ($announcements as $announcement): ?>
                <div class="announcement-item">
                    <h3 class="announcement-title"><?php echo htmlspecialchars($announcement['announcementTitle']); ?></h3>
                    <p><?php echo htmlspecialchars($announcement['announcementDescription']); ?></p>
                    <?php if (isset($announcement['announcementDate'])): ?>
                        <p class="announcement-date">Posted on: <?php echo date('F j, Y', strtotime($announcement['announcementDate'])); ?></p>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>

    <?php
    if (isset($_SESSION['auth']) && $_SESSION['auth'] == 1) {
        echo '<p style="text-align: center; margin-top: 20px;">You are using an admin account.</p>';
    }
    ?>

    <footer>
        <p>Copyright © Zyril Evangelista. 2024. All rights Reserved.</p>
    </footer>

    <script>
        function toggleNav() {
            var x = document.getElementById("myTopnav");
            if (x.className === "topnav") {
                x.className += " responsive";
            } else {
                x.className = "topnav";
            }
        }

        function updateClock() {
            var now = new Date();
            var year = now.getFullYear();
            var month = ("0" + (now.getMonth() + 1)).slice(-2);
            var day = ("0" + now.getDate()).slice(-2);
            var hours = ("0" + now.getHours()).slice(-2);
            var minutes = ("0" + now.getMinutes()).slice(-2);
            var seconds = ("0" + now.getSeconds()).slice(-2);

            var formattedDate = year + "-" + month + "-" + day;
            var formattedTime = hours + ":" + minutes + ":" + seconds;

            document.getElementById('clock').innerHTML = "Date and Time: " + formattedDate + " " + formattedTime;
        }

        updateClock();
        setInterval(updateClock, 1000);

        function startTour() {
            introJs().setOptions({
                steps: [{
                    element: document.querySelector('.topnav'),
                    intro: "This is the main navigation bar. You can access different sections of the system from here."
                }, {
                    element: document.querySelector('#homeBtn'),
                    intro: "Click here to return to the home page."
                }, {
                    element: document.querySelector('#inventoryBtn'),
                    intro: "Access the inventory management section here."
                }, {
                    element: document.querySelector('#viewBtn'),
                    intro: "View your current inventory items here."
                }, {
                    element: document.querySelector('#reportBtn'),
                    intro: "Generate reports about your inventory here."
                }, {
                    element: document.querySelector('#adminpageBtn'),
                    intro: "Manage announcements and other admin tasks here."
                }, {
                    element: document.querySelector('#logoutBtn'),
                    intro: "Click here to log out of the system."
                }, {
                    element: document.querySelector('.dashboard'),
                    intro: "This dashboard provides an overview of the Inventory Manager System."
                }, {
                    element: document.querySelector('.announcements-container'),
                    intro: "Here you can see the latest announcements."
                }]
            }).start();
        }
    </script>
</body>
</html>