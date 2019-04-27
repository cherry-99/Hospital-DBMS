<?php
$host = "host = localhost";
$port = "port = 5432";
$dbname = "dbname = test";
$credentials = "user = postgres password=15739";

$db = pg_connect("$host $port $dbname $credentials");
$errors1 = array();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Hospital Database</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="main.css">
    <script src="myScript.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>

<body>

    <div class="page-header">
        <h1>Hospital Database</h1>
    </div>

    <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <ul class="nav navbar-nav">
                <li><a href="rec_insert.php">Add</a></li>
                <li><a href="rec_update.php">Change</a></li>
                <li><a href="rec_delete.php">Remove</a></li>
                <li class="active"><a href="view_database.php">View DataBase</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#"><span
                            class="glyphicon glyphicon-user"></span> Account <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li onclick="doctor_forms(2)"><a href="doctor.php">Update Information</a></li>
                        <li onclick="doctor_forms(3)"><a href="doctor.php">Change Password</a></li>
                        <li><a href="login.html">Log Out</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container">
        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#emp">Employee</a></li>
            <li><a data-toggle="tab" href="#pat">Patient</a></li>
            <li><a data-toggle="tab" href="#place2">Records</a></li>
            <li><a data-toggle="tab" href="#place3">Bills</a></li>
            <li><a data-toggle="tab" href="#place4">Employee Stats</a></li>
        </ul>
        <div class="tab-content">
            <div id="emp" class="tab-pane fade in active">
                <h3>Employee</h3>
                <?php 
                    $host = "host = localhost";
                    $port = "port = 5432";
                    $dbname = "dbname = test";
                    $credentials = "user = postgres password=15739";
                    $db = pg_connect("$host $port $dbname $credentials");
                    $query="SELECT * FROM HOSPITAL_EMPLOYEE";
                    $result = pg_query($db,$query);
                    echo '<table id="table1" class="table table-bordered table-striped" border="1" cellpadding="5" align="center">';
                    echo "<thead><tr><th>EMPLOYEE_ID</th><th>EMPLOYEE_NAME</th><th>GENDER</th><th>AGE</th><th>EMP_TYPE</th><th>SALARY</th><th>CONTACT_NO</th></tr></thead><tbody>";
                    // loop through results of database query, displaying them in the table
                    while($row = pg_fetch_array( $result )) 
                    {
                            // echo out the contents of each row into a table
                            echo "<tr>";
                            echo '<td>' . $row['emp_id'] . '</td>';
                            echo '<td>' . $row['employee_name'] . '</td>';
                            echo '<td>' . $row['gender'] . '</td>';
                            echo '<td>' . $row['age'] . '</td>';
                            echo '<td>' . $row['emp_type'] . '</td>';
                            echo '<td>' . $row['salary'] . '</td>';
                            echo '<td>' . $row['contact_no'] . '</td>'.'</tr>';
                    }
                    echo "</tbody></table>";
                ?>
            </div>
            <div id="pat" class="tab-pane fade">
                <h3>Patient</h3>
                <?php 
                    $host = "host = localhost";
                    $port = "port = 5432";
                    $dbname = "dbname = test";
                    $credentials = "user = postgres password=15739";
                    $db = pg_connect("$host $port $dbname $credentials");
                    $query="SELECT * FROM PATIENT";
                    $result = pg_query($db,$query);
                    echo '<table id="table1" class="table table-bordered table-striped" border="1" cellpadding="5" align="center">';
                    echo "<thead><tr><th>PATIENT_ID</th><th>PATIENT_NAME</th><th>GENDER</th><th>DATE_OF_BIRTH</th><th>CONTACT NO</th><th>ADMIT DATE</th><th>DIAGNOSIS</th></tr></thead><tbody>";
                    // loop through results of database query, displaying them in the table
                    while($row = pg_fetch_array( $result )) 
                    {
                            // echo out the contents of each row into a table
                            echo "<tr>";
                            echo '<td>' . $row['pat_id'] . '</td>';
                            echo '<td>' . $row['pat_name'] . '</td>';
                            echo '<td>' . $row['gender'] . '</td>';
                            echo '<td>' . $row['date_of_birth'] . '</td>';
                            echo '<td>' . $row['contact_no'] . '</td>';
                            echo '<td>' . $row['admit_date'] . '</td>';
                            echo '<td>' . $row['diagnosis'] . '</td>'.'</tr>';
                    }
                    echo "</tbody></table>";
                ?>
            </div>
            <div id="place2" class="tab-pane fade">
                <h3>Records</h3>
                <?php 
                    $host = "host = localhost";
                    $port = "port = 5432";
                    $dbname = "dbname = test";
                    $credentials = "user = postgres password=15739";
                    $db = pg_connect("$host $port $dbname $credentials");
                    $query="SELECT * FROM RECORDS";
                    $result = pg_query($db,$query);
                    echo '<table id="table1" class="table table-bordered table-striped" border="1" cellpadding="5" align="center">';
                    echo "<thead><tr><th>PATIENT_ID</th><th>PATIENT_NAME</th><th>DOCTOR NAME</th><th>DIAGNOSO</th><th>CONTACT NO</th><th>ADMIT DATE</th><th>DISCHARGE DATE</th><th>BILL ID</th></tr></thead><tbody>";
                    // loop through results of database query, displaying them in the table
                    while($row = pg_fetch_array( $result )) 
                    {
                            // echo out the contents of each row into a table
                            echo "<tr>";
                            echo '<td>' . $row['pat_id'] . '</td>';
                            echo '<td>' . $row['patient_name'] . '</td>';
                            echo '<td>' . $row['doc_name'] . '</td>';
                            echo '<td>' . $row['diagnosis'] . '</td>';
                            echo '<td>' . $row['admit_date'] . '</td>';
                            echo '<td>' . $row['discharge_date'] . '</td>';
                            echo '<td>' . $row['bill_id'] . '</td>'.'</tr>';
                    }
                    echo "</tbody></table>";
                ?>
            </div>
            <div id="place3" class="tab-pane fade">
                <h3>Bills</h3>
                <?php 
                    $host = "host = localhost";
                    $port = "port = 5432";
                    $dbname = "dbname = test";
                    $credentials = "user = postgres password=15739";
                    $db = pg_connect("$host $port $dbname $credentials");
                    $query="SELECT * FROM BILL";
                    $result = pg_query($db,$query);
                    echo '<table id="table1" class="table table-bordered table-striped" border="1" cellpadding="5" align="center">';
                    echo "<thead><tr><th>BILL_ID</th><th>PATIENT_ID</th><th>BILL DATE</th><th>MEDICINE FEES</th><th>ROOM FEES</th><th>HOSPITAL CHARGES</th><th>TAX</th><th>TOTAL</th></tr></thead><tbody>";
                    // loop through results of database query, displaying them in the table
                    while($row = pg_fetch_array( $result )) 
                    {
                            // echo out the contents of each row into a table
                            echo "<tr>";
                            echo '<td>' . $row['bill_id'] . '</td>';
                            echo '<td>' . $row['pat_id'] . '</td>';
                            echo '<td>' . $row['bill_date'] . '</td>';
                            echo '<td>' . $row['med_fee'] . '</td>';
                            echo '<td>' . $row['room_fee'] . '</td>';
                            echo '<td>' . $row['hosp_charges'] . '</td>';
                            echo '<td>' . $row['tax'] . '</td>';
                            echo '<td>' . $row['total'] . '</td>'.'</tr>';
                    }
                    echo "</tbody></table>";
                ?>
            </div>
            <div id="place4" class="tab-pane fade">
                <h3>Employee Stats</h3>
                <?php 
                    $host = "host = localhost";
                    $port = "port = 5432";
                    $dbname = "dbname = test";
                    $credentials = "user = postgres password=15739";
                    $db = pg_connect("$host $port $dbname $credentials");
                    $query="SELECT emp_type,COUNT(*),avg(salary),min(salary),max(salary),sum(salary) FROM hospital_employee GROUP BY emp_type;";
                    $result = pg_query($db,$query);
                    echo '<table id="table1" class="table table-bordered table-striped" border="1" cellpadding="5" align="center">';
                    echo "<thead><tr><th>EMPLOYMENT TYPE</th><th>NO OF EMPLOYEES</th><th>AVERAGE SALARY</th><th>MINIMUM SALARY</th><th>MAXIMUM SALARY</th><th>TOTAL AMOUNT PAID TO DEPARTMENT</th></tr></thead><tbody>";
                    // loop through results of database query, displaying them in the table
                    while($row = pg_fetch_array( $result )) 
                    {
                            // echo out the contents of each row into a table
                            echo "<tr>";
                            echo '<td>' . $row['emp_type'] . '</td>';
                            echo '<td>' . $row['count'] . '</td>';
                            echo '<td>' . $row['avg'] . '</td>';
                            echo '<td>' . $row['min'] . '</td>';
                            echo '<td>' . $row['max'] . '</td>';
                            echo '<td>' . $row['sum'] . '</td>'.'</tr>';
                    }
                    echo "</tbody></table>";
                    echo "</br> EMPLOYEES EARNING MORE THAN 50000";
                    $query="SELECT emp_id,employee_name,emp_type,salary FROM hospital_employee GROUP BY emp_id HAVING salary >= 50000;";
                    $result = pg_query($db,$query);
                    echo '<table id="table1" class="table table-bordered table-striped" border="1" cellpadding="5" align="center">';
                    echo "<thead><tr><th>EMPLOYEE ID</th><th>EMPLOYEE NAME</th><th>EMPLOYMENT TYPE</th><th>SALARY</th></tr></thead><tbody>";
                    // loop through results of database query, displaying them in the table
                    while($row = pg_fetch_array( $result )) 
                    {
                            // echo out the contents of each row into a table
                            echo "<tr>";
                            echo '<td>' . $row['emp_id'] . '</td>';
                            echo '<td>' . $row['employee_name'] . '</td>';
                            echo '<td>' . $row['emp_type'] . '</td>';
                            echo '<td>' . $row['salary'] . '</td>'.'</tr>';
                    }
                    echo "</tbody></table>";
                ?>

            </div>
        </div>
    </div>
</body>

</html>