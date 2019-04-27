<?php
$host = "host = localhost";
$port = "port = 5432";
$dbname = "dbname = test";
$credentials = "user = postgres password=15739";

$db = pg_connect("$host $port $dbname $credentials");
$errors1 = array();

if(isset($_POST["remove_med_inv"]))
{
    $med_id = $_POST["med_id"];
    // $diagnosis=$_POST["diag"];
    // $med_id = $_POST["med_id"];
    // $query = "UPDATE medicine_inventory SET diagnosis = '".$diagnosis."' WHERE med_id = $med_id";
    // $query2 = "UPDATE medication SET med_id = '".$med_id."' WHERE med_id = $med_id";
    // $result = pg_query($db,$query);
    // $result2 = pg_query($db,$query2);
    echo '<script language="javascript">';
    echo 'alert("Medicine deleted")';
    echo '</script>';
    header("location: rec_delete.php");
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
                <form class="form" action="/Hospital-DBMS/HTML/rec_delete.php" method="POST" onsubmit="return confirm('Do you really want to remove this medicine?');">
                    <div class="form-group-sm">
                        <label for="med_id">Medicine ID:</label>
                        <input type="number" class="form-control" id="med_id" name="med_id" required>
                    </div>
                    <button type="submit" name="remove_med_inv" class="btn btn-default" value="submit">Submit</button>
                </form>
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
            </div>
        </div>
    </div>
</body>

</html>