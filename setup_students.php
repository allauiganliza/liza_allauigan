<?php
session_start();
if (!isset($_SESSION['userid']) || $_SESSION['role'] != 'admin') {
    header('Location: auth.php');
    exit();
}

require_once 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $last = $_POST['last'];
    $first = $_POST['first'];
    $middle = $_POST['middle'];
    $gender = $_POST['gender'];

    $stmt = $conn->prepare("INSERT INTO tblstudents (last, first, middle, gender) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $last, $first, $middle, $gender);

    if ($stmt->execute()) {
        $_SESSION['success_message'] = "Student added successfully!";
        header('Location: ' . $_SERVER['PHP_SELF']);
        exit();
    } else {
        $message = "Error: " . $stmt->error;
    }

    $stmt->close();
}

// Check if success message exists in session
$message = '';
if (isset($_SESSION['success_message'])) {
    $message = $_SESSION['success_message'];
    unset($_SESSION['success_message']); // Clear session variable
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Student</title>
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
        <h1>Add Student</h1>
        <!-- Display success message if exists -->
        <?php if (!empty($message)): ?>
            <div class="alert alert-success" role="alert">
                <?php echo $message; ?>
            </div>
        <?php endif; ?>
        <!-- Show form if not submitted -->
        <?php if ($_SERVER["REQUEST_METHOD"] != "POST"): ?>
            <form method="post" action="">
                <label for="last">Last Name:</label>
                <input type="text" id="last" name="last" required>
                <br>
                <label for="first">First Name:</label>
                <input type="text" id="first" name="first" required>
                <br>
                <label for="middle">Middle Name:</label>
                <input type="text" id="middle" name="middle">
                <br>
                <label for="gender">Gender:</label>
                <select id="gender" name="gender" required>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>
                <br>
                <input type="submit" value="Add Student">
            </form>
        <?php endif; ?>
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
