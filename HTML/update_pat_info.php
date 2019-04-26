<?php
$host = "host = localhost";
$port = "port = 5432";
$dbname = "dbname = test";
$credentials = "user = postgres password=15739";

$db = pg_connect("$host $port $dbname $credentials");
$errors1 = array();
$emp_id = $_COOKIE["empid"];
$doc_id = $_COOKIE["doc_id"];

//The following is for the doctor to update the patient diagnosis details
if(isset($_POST["update_info"]))
{
    $pat_id = $_POST["pat_id"];
    $diagnosis=$_POST["diag"];
    $med_id = $_POST["med_id"];
    $query = "UPDATE patient SET diagnosis = '".$diagnosis."' WHERE pat_id = $pat_id";
    $query2 = "UPDATE medication SET med_id = '".$med_id."' WHERE pat_id = $pat_id";
    $result = pg_query($db,$query);
    $result2 = pg_query($db,$query2);
    header("location: doctor.php");
}

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
                <li onclick="doctor_forms(1)"><a href="doctor.php">Personal Information</a></li>
                <li class="active"><a href="update_pat_info.php">Update Patient Info</a></li>
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

    <?php  if (count($errors1) > 0) : ?>
    <div class="error">
        <?php foreach ($errors1 as $error) : ?>
        <p><?php echo $error ?></p>
        <?php endforeach ?>
    </div>
    <?php  endif ?>
    <div class="container">
        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#pat_diag">Diagnosis</a></li>
            <li><a data-toggle="tab" href="#pat_dis">Discharge</a></li>
        </ul>
<!-- the below form for updating the patient diagnosis -->  
        <div class="tab-content">
            <div id="pat_diag" class="tab-pane fade in active">
                <h3>Diagnosis</h3>
                <?php 
                    $host = "host = localhost";
                    $port = "port = 5432";
                    $dbname = "dbname = test";
                    $credentials = "user = postgres password=15739";

                    $db = pg_connect("$host $port $dbname $credentials");

                    $query="CREATE VIEW docs_pat AS SELECT patient.pat_id,pat_name,diagnosis,room_no FROM patient INNER JOIN treats ON patient.pat_id=treats.pat_id left outer JOIN room_assigned ON treats.pat_id=room_assigned.pat_id WHERE treats.doc_id=$doc_id";
                    $result = pg_query($db,$query);
                    $query = "SELECT * FROM docs_pat";
                    $result = pg_query($db,$query);

                    echo '<table id="table1" class="table table-bordered table-striped" border="1" cellpadding="5" align="center">';
                    echo "<thead><tr><th>Patient ID</th><th>Patient Name</th> <th> Diagnosis </th> <th> Room_no </th> </tr></thead><tbody>";
                    // loop through results of database query, displaying them in the table
                    while($row = pg_fetch_array( $result )) 
                    {
                            // echo out the contents of each row into a table
                            echo "<tr>";
                            echo '<td>' . $row['pat_id'] . '</td>';
                            echo '<td>' . $row['pat_name'] . '</td>';
                            echo '<td>' . $row['diagnosis'] . '</td>';
                            echo '<td>' . $row['room_no'] . '</td>'.'</tr>';
                    }
                    echo "</tbody></table>";
                    $query="DROP VIEW docs_pat";
                    $result = pg_query($db,$query);
                ?>
                <form class="form" action="/Hospital-DBMS/HTML/update_pat_info.php" method="POST">
                    <div class="form-group-sm">
                        <label for="pat_id">Patient ID:</label>
                        <input type="number" class="form-control" id="pat_id" name="pat_id" required>
                    </div>
                    <div class="form-group-sm">
                        <label for="diag">Diagnosis:</label>
                        <input type="text" class="form-control" id="diag" name="diag" required>
                    </div>
                    <div class="form-group-sm">
                        <label for="med_id">Medicine ID:</label>
                        <input type="number" class="form-control" id="med_id" name="med_id" required>
                    </div>
                    <button type="submit" name="update_info" class="btn btn-default" value="submit">Submit</button>
                </form>
            </div>
<!-- discharging patient -->
            <div id="pat_dis" class="tab-pane fade">
                <h3>Discharge</h3>
                <?php 
                    $host = "host = localhost";
                    $port = "port = 5432";
                    $dbname = "dbname = test";
                    $credentials = "user = postgres password=15739";

                    $db = pg_connect("$host $port $dbname $credentials");

                    $query="CREATE VIEW docs_pat AS SELECT patient.pat_id,pat_name,diagnosis,room_no FROM patient INNER JOIN treats ON patient.pat_id=treats.pat_id left outer JOIN room_assigned ON treats.pat_id=room_assigned.pat_id WHERE treats.doc_id=$doc_id";
                    $result = pg_query($db,$query);
                    $query = "SELECT * FROM docs_pat";
                    $result = pg_query($db,$query);

                    echo '<table id="table1" class="table table-bordered table-striped" border="1" cellpadding="5" align="center">';
                    echo "<thead><tr><th>Patient ID</th><th>Patient Name</th> <th> Diagnosis </th> <th> Room_no </th> </tr></thead><tbody>";
                    // loop through results of database query, displaying them in the table
                    while($row = pg_fetch_array( $result )) 
                    {
                            // echo out the contents of each row into a table
                            echo "<tr>";
                            echo '<td>' . $row['pat_id'] . '</td>';
                            echo '<td>' . $row['pat_name'] . '</td>';
                            echo '<td>' . $row['diagnosis'] . '</td>';
                            echo '<td>' . $row['room_no'] . '</td>'.'</tr>';
                    }
                    echo "</tbody></table>";
                    $query="DROP VIEW docs_pat";
                    $result = pg_query($db,$query);
                ?>
                <form class="form" action="/Hospital-DBMS/HTML/update_pat_info.php" method="POST">
                    <div class="form-group-sm">
                        <label for="pat_id">Patient ID:</label>
                        <input type="number" class="form-control" id="pat_id" name="pat_id" required>
                    </div>
                    <div class="form-group-sm">
                        <label for="discharge">Discharge Date:</label>
                        <input type="datetime-local" class="form-control" id="discharge" name="discharge" required>
                    </div>
                    <button type="submit" name="update_info" class="btn btn-default" value="submit">Submit</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>