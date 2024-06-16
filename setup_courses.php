<?php
session_start();
if (!isset($_SESSION['userid']) || $_SESSION['role'] != 'admin') {
    header('Location: auth.php');
    exit();
}

require_once 'db.php';

$message = '';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $course_code = $_POST['course_code'];
    $course_description = $_POST['course_description'];
    $units = $_POST['units'];
    $prerequisite = $_POST['prerequisite'];

    $stmt = $conn->prepare("INSERT INTO courses (course_code, course_description, units, prerequisite) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssis", $course_code, $course_description, $units, $prerequisite);

    if ($stmt->execute()) {
        $message = "Course added successfully!";
        // Redirect to prevent duplicate submissions
        header('Location: setup_courses.php');
        exit();
    } else {
        $message = "Error: " . $stmt->error;
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Course</title>
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

        /* Table styles */
        .table-container {
            margin-top: 20px;
        }

        .table-container table {
            width: 100%;
            border-collapse: collapse;
        }

        .table-container th, .table-container td {
            padding: 10px;
            border: 1px solid #ddd;
        }

        .table-container th {
            background-color: #007bff;
            color: #fff;
        }

        .table-container td {
            background-color: #f9f9f9;
        }

        .table-container tr:hover td {
            background-color: #f0f0f0;
        }
        
        /* Team member styles */
        .team-member {
            margin-bottom: 20px;
        }
        
        .team-member h3 {
            margin-top: 0;
        }
        
        .team-member p {
            margin-bottom: 5px;
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
                <li><a href="about.php">About</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="#"><span class="glyphicon glyphicon-time"></span> Today is: <span id="currentDate"></span></a></li>
                <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
            </ul>
        </div>
    </nav>
    <script>
        function showAlert(message) {
            alert(message);
        }
    </script>
</head>
<body>
    <h1>Add Course</h1>
    <p><?php echo $message; ?></p>
    <form method="post" action="">
        <label for="course_code">Course Code:</label>
        <input type="text" id="course_code" name="course_code" required>
        <br>
        <label for="course_description">Course Description:</label>
        <input type="text" id="course_description" name="course_description" required>
        <br>
        <label for="units">Units:</label>
        <input type="number" id="units" name="units" required>
        <br>
        <label for="prerequisite">Prerequisite:</label>
        <input type="text" id="prerequisite" name="prerequisite">
        <br>
        <input type="submit" value="Add Course" onclick="showAlert('Course added successfully!')">
    </form>
     <!-- Table for displaying courses -->
     <h2>Current Courses</h2>
    <table border="1">
        <thead>
            <tr>
                <th>Course Code</th>
                <th>Course Description</th>
                <th>Units</th>
                <th>Prerequisite</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Query to retrieve courses from the database
            $sql = "SELECT course_code, course_description, units, prerequisite FROM courses";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['course_code'] . "</td>";
                    echo "<td>" . $row['course_description'] . "</td>";
                    echo "<td>" . $row['units'] . "</td>";
                    echo "<td>" . $row['prerequisite'] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='4'>No courses found</td></tr>";
            }
            ?>
        </tbody>
    </table>
    <footer class="footer">
        <div class="container">
            <p>&copy; <?php echo date("Y"); ?> SARIAS. All rights reserved.</p>
        </div>
    </footer>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
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
