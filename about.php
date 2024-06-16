<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About</title>
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

    <div class="container">
        <h1>About SARIAS</h1>
        <p>SARIAS (Student Academic Records Information Accounting System) is designed to help manage student records, transactions, and generate reports efficiently. Our system provides an easy-to-use interface for students and administrators to handle academic information seamlessly.</p>
        <h2>Features:</h2>
        <ul>
            <li>Student Enrollment</li>
            <li>Transaction Management</li>
            <li>Report Generation</li>
            <li>Assessment Tracking</li>
        </ul>
        <h2>Contact Us:</h2>
        <p>If you have any questions or need further assistance, please contact our support team at support@sarias.com.</p>
        
        <h2>Our Team</h2>
        <div class="row">
            <div class="col-md-4 team-member">
                <h3>Liza P. Allauigan</h3>
                <p>Course: Bachelor of Science Information Technology (BSIT-2B). </p>
                
                <button class="btn btn-primary" data-toggle="modal" data-target="#profileModal1">View Profile</button>
            </div>
            <div class="col-md-4 team-member">
                <h3>Bryan Quilang</h3>
                <p>Course: Bachelor of Science Information Technology (BSIT-2B). </p>
                <button class="btn btn-primary" data-toggle="modal" data-target="#profileModal2">View Profile</button>
            </div>
            <div class="col-md-4 team-member">
                <h3>Liza Marie U. Bautista</h3>
                <p>Course: Bachelor of Science Information Technology (BSIT-2B). </p>
                <button class="btn btn-primary" data-toggle="modal" data-target="#profileModal3">View Profile</button>
            </div>
        </div>

      <!-- Profile Modal 1 -->
<div class="modal fade" id="profileModal1" tabindex="-1" role="dialog" aria-labelledby="profileModalLabel1">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="profileModalLabel1">Liza P. Allauigan</h4>
            </div>
            <div class="modal-body">
                <p><strong>Age:</strong> 21</p>
                <p><strong>Gender:</strong> Female</p>
                <p><strong>Status:</strong> Single</p>
                <p><strong>Birthday:</strong> 10/27/2002</p>
                <p><strong>Address:</strong> Santa Maria, Isabela</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Profile Modal 2 -->
<div class="modal fade" id="profileModal2" tabindex="-1" role="dialog" aria-labelledby="profileModalLabel2">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="profileModalLabel2">Bryan Quilang</h4>
            </div>
            <div class="modal-body">
                <p><strong>Age:</strong> 21</p>
                <p><strong>Gender:</strong> Male</p>
                <p><strong>Status:</strong> Married</p>
                <p><strong>Birthday:</strong> 10/24/2002</p>
                <p><strong>Address:</strong> Balelleng Santo Tomas, Isabela</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Profile Modal 3 -->
<div class="modal fade" id="profileModal3" tabindex="-1" role="dialog" aria-labelledby="profileModalLabel3">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="profileModalLabel3">Liza Marie U. Bautista</h4>
            </div>
            <div class="modal-body">
                <p><strong>Age:</strong> 20</p>
                <p><strong>Gender:</strong> Female</p>
                <p><strong>Status:</strong> Single</p>
                <p><strong>Birthday:</strong> 04/24/2004</p>
                <p><strong>Address:</strong> Cubag Cabagan, Isabela</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
    </div>
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

