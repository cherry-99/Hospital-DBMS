<?php
$host = "host = localhost";
$port = "port = 5432";
$dbname = "dbname = test";
$credentials = "user = postgres password=15739";

$db = pg_connect("$host $port $dbname $credentials");
$errors1 = array();

if(isset($_POST["remove_emp"]))
{
    $emp_id = $_POST["emp_id"];
    $query = "SELECT * FROM HOSPITAL_EMPLOYEE WHERE emp_id='".$emp_id."';";
    $result = pg_query($db,$query);
    $ans = pg_fetch_assoc($result);
    if($ans)
    {
        $emp_type=pg_fetch_result(pg_query("SELECT emp_type FROM HOSPITAL_EMPLOYEE WHERE emp_id='".$emp_id."';"),0,0);
        $query = "DELETE FROM HOSPITAL_EMPLOYEE WHERE emp_id='".$emp_id."';";
        $result = pg_query($db,$query);
        if($emp_type=="DOCTOR")
        {
            echo '<script language="javascript">';
            echo 'alert("PLEASE UPDATE THE PATIENT DOCTOR DATA UNDER CHANGE PAT_DOC TABS")';
            echo '</script>';
        }
        if($emp_type=="NURSE")
        {
            echo '<script language="javascript">';
            echo 'alert("PLEASE UPDATE THE ROOM INCHARGE IN NURSE TAB UNDER THE CHANGE TAB")';
            echo '</script>';
        }
    }
    else
    {
        echo '<script language="javascript">';
        echo 'alert("EMPLOYEE NOT FOUND IN DATABASE")';
        echo '</script>';
    } 
}

if(isset($_POST["remove_med_inv"]))
{
    $med_id = $_POST["med_id"];
    $query = "SELECT * FROM MEDICINE_INVENTORY WHERE med_id='".$med_id."';";
    $result = pg_query($db,$query);
    $ans = pg_fetch_assoc($result);
    if($ans)
    {
        $query = "DELETE FROM MEDICINE_INVENTORY WHERE med_id='".$med_id."';";
        $result = pg_query($db,$query);
    }
    else
    {
        echo '<script language="javascript">';
        echo 'alert("MEDICINE NOT FOUND IN DATABASE")';
        echo '</script>'
    }
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
                <li onclick="rec_forms(1)"><a href="#">Add</a></li>
                <li><a href="rec_update.php">Change</a></li>
                <li class="active"><a href="rec_delete.php">Remove</a></li>
                <li><a href="view_database.php">View DB</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#"><span
                            class="glyphicon glyphicon-user"></span> Account <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li onclick="rec_forms(2)"><a href="#">Update Information</a></li>
                        <li onclick="rec_forms(3)"><a href="#">Change Password</a></li>
                        <li><a href="login.html">Log Out</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container">
        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#emp">Employee</a></li>
            <li><a data-toggle="tab" href="#med_inv">Medicine Inventory</a></li>
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
                <form class="form" action="/Hospital-DBMS/HTML/rec_insert.php" method="POST">
                <form class="form" action="/Hospital-DBMS/HTML/rec_delete.php" method="POST" onsubmit="return confirm('Do you really want to remove this employee?');">
                    <div class="form-group-sm">
                        <label for="emp_id">Employee ID:</label>
                        <input type="number" class="form-control" id="emp_id" name="emp_id" required>
                    </div>
                    <button type="submit" name="remove_emp" class="btn btn-default" value="submit">Submit</button>
                </form>
            </div>
            <div id="med_inv" class="tab-pane fade">
                <h3>Medicine Inventory</h3>
                <?php 
                $host = "host = localhost";
                $port = "port = 5432";
                $dbname = "dbname = test";
                $credentials = "user = postgres password=15739";
                $db = pg_connect("$host $port $dbname $credentials");
                $query = "SELECT * FROM medicine_inventory";
                $result = pg_query($db,$query);
                echo '<table id="table1" class="table table-bordered table-striped" border="1" cellpadding="5" align="center">';
                echo "<thead><tr><th>Medicine ID</th><th>Medicine Name</th> <th> Quantity </th> <th> Cost </th> </tr></thead><tbody>";
                // loop through results of database query, displaying them in the table
                while($row = pg_fetch_array( $result )) 
                {
                        // echo out the contents of each row into a table
                        echo "<tr>";
                        echo '<td>' . $row['med_id'] . '</td>';
                        echo '<td>' . $row['med_name'] . '</td>';
                        echo '<td>' . $row['quantity'] . '</td>';
                        echo '<td>' . $row['cost'] . '</td>'.'</tr>';
                }
                echo "</tbody></table>";
                ?>
                <form class="form" action="/Hospital-DBMS/HTML/rec_delete.php" method="POST" onsubmit="return confirm('Do you really want to remove this medicine?');">
                    <div class="form-group-sm">
                        <label for="med_id">Medicine ID:</label>
                        <input type="number" class="form-control" id="med_id" name="med_id" required>
                    </div>
                    <button type="submit" name="remove_med_inv" class="btn btn-default" value="submit">Submit</button>
                </form>
                <form class="form" action="/Hospital-DBMS/HTML/rec_insert.php" method="POST">
                    <div class="form-group-sm">
                        <label for="med_id">Medicine ID:</label>
                        <input type="number" class="form-control" id="med_id" name="med_id" required>
                    </div>
                    <button type="submit" name="remove_med_inv" class="btn btn-default" value="submit">Submit</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>