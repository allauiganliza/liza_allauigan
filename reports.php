<?php
session_start();
if (!isset($_SESSION['userid'])) {
    header('Location: auth.php');
    exit();
}

require_once 'db.php'; // Ensure this path is correctly pointing to your database connection script.

$students = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['generateReport'])) {
    $studentId = $_POST['studentId'];

    // Get student information
    $stmt = $conn->prepare("SELECT * FROM tblstudents WHERE studentno = ?");
    $stmt->bind_param("i", $studentId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $student = $result->fetch_assoc();
        $students[] = $student;
    }
}

// Function to fetch enrolled students
function fetchEnrolledStudents($conn) {
    $students = [];
    $sql = "SELECT * FROM tblstudents";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $students[] = $row;
        }
    }

    return $students;
}

$enrolledStudents = fetchEnrolledStudents($conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generate Assessment Report</title>
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

        /* Form styles */
        .form-container {
            margin-top: 20px;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .form-container h1 {
            margin-bottom: 20px;
        }

        .form-container .form-group {
            margin-bottom: 20px;
        }

        .form-container .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .form-container .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
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

    <div class="container">
        <h1>Assessment Form</h1>
        <form method="post">
            <div class="form-group">
                <label for="studentId">Select Student:</label>
                <select class="form-control" id="studentId" name="studentId" required>
                    <option value="">Select Student</option>
                    <?php foreach ($enrolledStudents as $student): ?>
                        <option value="<?php echo $student['studentno']; ?>"><?php echo $student['first'] . ' ' . $student['last']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary" name="generateReport">Generate Report</button>
        </form>

        <?php if (!empty($students)): ?>
            <h2>Student Information</h2>
            <table class="table">
                <thead>
                    <tr>
                        <th>Student No</th>
                        <th>Last Name</th>
                        <th>First Name</th>
                        <th>Middle Name</th>
                        <th>Gender</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($students as $student): ?>
                        <tr>
                            <td><?php echo $student['studentno']; ?></td>
                            <td><?php echo $student['last']; ?></td>
                            <td><?php echo $student['first']; ?></td>
                            <td><?php echo $student['middle']; ?></td>
                            <td><?php echo $student['gender']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
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
