<?php
session_start();
if (!isset($_SESSION['userid'])) {
    header('Location: auth.php');
    exit();
}

require_once 'db.php'; // Include your database connection file

$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the form fields are set
    if (isset($_POST['student_id']) && isset($_POST['subjcode']) && isset($_POST['semester'])) {
        $student_id = $_POST['student_id'];
        $subjcode = $_POST['subjcode'];
        $semester = $_POST['semester'];

        // Check if the student is already enrolled in the subject and semester
        $check_stmt = $conn->prepare("SELECT COUNT(*) FROM transactions1 WHERE student_id = ? AND subjcode = ? AND semester = ?");
        $check_stmt->bind_param("iss", $student_id, $subjcode, $semester);
        $check_stmt->execute();
        $check_stmt->bind_result($count);
        $check_stmt->fetch();
        $check_stmt->close();

        if ($count > 0) {
            $message = "The student is already enrolled in this subject and semester.";
        } else {
            // Prepare and execute the SQL statement to insert the transaction
            $stmt = $conn->prepare("INSERT INTO transactions1 (student_id, subjcode, semester) VALUES (?, ?, ?)");
            $stmt->bind_param("iss", $student_id, $subjcode, $semester);

            if ($stmt->execute()) {
                $message = "Transaction added successfully!";
            } else {
                $message = "Error: " . $stmt->error;
            }

            $stmt->close();
        }
    } else {
        $message = "Please select a student, a subject, and a semester to enroll.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Transactions</title>
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

    <div class="container">
        <h1>Transactions</h1>
        <p><?php echo $message; ?></p>
        <form method="post" action="">
            <div class="form-group">
                <label for="student_id">Student ID:</label>
                <input type="text" id="student_id" name="student_id" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="subjcode">Subject Code:</label>
                <input type="text" id="subjcode" name="subjcode" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="semester">Semester:</label>
                <select id="semester" name="semester" class="form-control">
                    <option value="1st">1st Semester</option>
                    <option value="2nd">2nd Semester</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Enroll Student</button>
        </form>

        <div class="table-container">
            <h2>Transaction Details</h2>
            <button onclick="printDetails()" class="btn btn-secondary">Print Details</button>
            <table id="transactionTable" class="table table-bordered">
                <thead>
                    <tr>
                        <th>Student ID</th>
                        <th>Subject Code</th>
                        <th>Semester</th>
                        <th>Created At</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $result = $conn->query("SELECT student_id, subjcode, semester, created_at FROM transactions1");
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr><td>{$row['student_id']}</td><td>{$row['subjcode']}</td><td>{$row['semester']}</td><td>{$row['created_at']}</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
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

        // JavaScript to print transaction details
        function printDetails() {
            var printContents = document.getElementById('transactionTable').outerHTML;
            var originalContents = document.body.innerHTML;

            document.body.innerHTML = '<h1>Transaction Details</h1>' + printContents;

            window.print();

            document.body.innerHTML = originalContents;
            window.location.reload();
        }
    </script>
</body>
</html>
