<?php
$host = "host = localhost";
$port = "port = 5432";
$dbname = "dbname = test";
$credentials = "user = postgres password=15739";
$db = pg_connect("$host $port $dbname $credentials");
$errors1 = array();
$emp_id = $_COOKIE["empid"];
$nurse_id = $_COOKIE["nurse_id"];
//The following is for the nurse to update the patient diagnosis details
if(isset($_POST["update_info"]))
{
    $quantity = $_POST["quantity"];
    $med_id = $_POST["med_id"];
    $query2 = "UPDATE medicine_inventory SET quantity = '".$quantity."' WHERE med_id = $med_id";
    $result = pg_query($db,$query);
    $result2 = pg_query($db,$query2);
    header("location: update_inventory.php");
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
                <li onclick="nurse_forms(1)"><a href="nurse.php">Personal Information</a></li>
                <li class="active"><a href="update_inventory.php">Update Inventory</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#"><span
                            class="glyphicon glyphicon-user"></span> Account <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li onclick="doctor_forms(2)"><a href="nurse.php">Update Information</a></li>
                        <li onclick="doctor_forms(3)"><a href="nurse.php">Change Password</a></li>
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
<!-- the below form for updating the invetory -->
            <div id="inventory">
                <form class="form" action="/Hospital-DBMS/HTML/update_inventory.php" method="POST">
                    <div class="form-group-sm">
                        <label for="med_id">Medicine ID:</label>
                        <input type="number" class="form-control" id="med_id" name="med_id" value="<?php echo $med_id; ?>"
                            required>
                    </div>
                    <div class="form-group-sm">
                        <label for="quantity">Quantity:</label>
                        <input type="number" class="form-control" id="quantity" name="quantity" value="<?php echo $quantity; ?>"
                            required>
                    </div>
                    <button type="submit" name="update_info" class="btn btn-default" value="submit">Submit</button>
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
</body>

</html>