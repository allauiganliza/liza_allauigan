<?php
session_start();
if (!isset($_SESSION['userid']) || $_SESSION['role'] != 'admin') {
    header('Location: auth.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SARIAS</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            color: #333;
        }

        .navbar {
            background-color: #333;
            color: #fff;
        }

        .navbar-brand {
            font-weight: bold;
        }

        .navbar-nav > li > a {
            color: #fff;
        }

        .navbar-nav > li > a:hover {
            color: #ff6666;
        }

        .footer {
            background-color: #333;
            color: #fff;
            padding: 20px 0;
            text-align: center;
            position: fixed;
            bottom: 0;
            width: 100%;
        }

        .footer p {
            margin: 0;
            font-size: 14px;
        }

        /* Add styles for setup links */
        .setup-links {
            list-style: none;
            padding-left: 0;
        }

        .setup-links li {
            margin-bottom: 10px;
        }

        .setup-links a {
            display: block;
            padding: 10px 15px;
            background-color: #007bff;
            color: #fff;
            border-radius: 5px;
            text-decoration: none;
            transition: background-color 0.3s;
        }

        .setup-links a:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand active" href="index.php">SARIAS</a>
            </div>
            <ul class="nav navbar-nav">
                <li><a href="setup.php">Set Up</a></li>
                <li><a href="transactions.php">Transactions</a></li>
                <li><a href="reports.php">Reports</a></li>
                <li><a href="about.php">Abouts</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="#"><span class="glyphicon glyphicon-time"></span> Today is: <span id="currentDate"></span></a></li>
                <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
            </ul>
        </div>
    </nav>

    <div class="container">
        <h1>Welcome to SARIAS</h1>

     <!-- Content Area -->
     <div id="contentArea">
            <!-- Set Up Links -->
            <h1>Set Up</h1>
            <ul class="setup-links">
                <li><a href="setup_courses.php">Courses</a></li>
                <li><a href="setup_subjects.php">Subjects</a></li>
                <li><a href="setup_students.php">Students</a></li>
            </ul>
        </div>
    </div>

  <!-- Footer -->
  <footer class="footer">
        <div class="container">
            <p>&copy; <?php echo date("Y"); ?> SARIAS. All rights reserved.</p>
        </div>
    </footer>
    
    <script>
        // JavaScript for time display
        function updateTime() {
            var today = new Date();
            var day = today.getDate();
            var month = today.getMonth() + 1;
            var year = today.getFullYear();
            var hours = today.getHours();
            var minutes = today.getMinutes();
            var seconds = today.getSeconds();
            var ampm = hours >= 12 ? 'PM' : 'AM';
            hours = hours % 12;
            hours = hours ? hours : 12; // the hour '0' should be '12'
            minutes = minutes < 10 ? '0' + minutes : minutes;
            seconds = seconds < 10 ? '0' + seconds : seconds;
            var timeString = month + '/' + day + '/' + year + ' ' + hours + ':' + minutes + ':' + seconds + ' ' + ampm;
            document.getElementById('currentDate').innerHTML = timeString;
        }
        
        // Call updateTime function every second
        setInterval(updateTime, 1000);
    </script>
</body>
</html>
