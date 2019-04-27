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
    $result = pg_query($db,$query);
    $query = "SELECT * FROM medication where pat_id=$pat_id";
    $result = pg_query($db,$query);
    $a=pg_fetch_assoc($result);
    if($a)
    {
        $query = "UPDATE medication SET med_id = '".$med_id."' WHERE pat_id = $pat_id";
        $result = pg_query($db,$query);
    }
    else
    {
        $query2 = "INSERT INTO medication(med_id,pat_id) VALUES ('".$med_id."','".$pat_id."')";
        $result2 = pg_query($db,$query2);
    }
    header("location: update_pat_info.php");
}
//this is for updating the discharge date of the patient and creating records and bills
if(isset($_POST["discharge_pat"]))
{
    $pat_id = $_POST["pat_id"];
    $disch_date = $_POST["discharge"];
    $query = "UPDATE patient SET discharge_date = '".$disch_date."' WHERE pat_id = $pat_id";
    $result = pg_query($db,$query);
    // create a bill
    $admit_date = pg_fetch_result(pg_query("SELECT admit_date from patient where pat_id=$pat_id"),0,0);
    $med_fee=pg_fetch_result(pg_query("SELECT cost FROM medicine_inventory WHERE med_id=(SELECT med_id FROM medication WHERE pat_id=$pat_id)"),0,0);
    $room_fee=pg_fetch_result(pg_query("SELECT cost FROM rooms WHERE room_no=(SELECT room_no from room_assigned where pat_id=$pat_id)"),0,0);
    $query="INSERT INTO bill (pat_id,bill_date,med_fee,room_fee,hosp_charges,tax,total)
            SELECT patient.pat_id, patient.discharge_date, $med_fee, $room_fee, ($med_fee+$room_fee)*0.25, ($med_fee+$room_fee)*0.18, ($med_fee+$room_fee)*1.25*1.18
            FROM patient WHERE patient.pat_id=$pat_id;";
    $result = pg_query($db,$query);
    $bill_id = pg_fetch_result(pg_query("SELECT bill_id FROM bill WHERE pat_id=$pat_id" ),0,0);
    $query="INSERT INTO records (patient_name,pat_id,diagnosis,admit_date,discharge_date,bill_id)
            SELECT patient.pat_name,patient.pat_id,patient.diagnosis, patient.admit_date,patient.discharge_date,$bill_id
            FROM patient
            WHERE patient.pat_id=$pat_id;";
    $result = pg_query($db,$query);
    $query3 = "delete from patient where pat_id=$pat_id";
    $result = pg_query($db,$query3);
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
                        <input type="date" class="form-control" id="discharge" name="discharge" required>
                    </div>
                    <button type="submit" name="discharge_pat" class="btn btn-default" value="submit">Submit</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>