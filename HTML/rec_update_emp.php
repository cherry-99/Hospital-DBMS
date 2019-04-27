<?php
$host = "host = localhost";
$port = "port = 5432";
$dbname = "dbname = test";
$credentials = "user = postgres password=15739";

$db = pg_connect("$host $port $dbname $credentials");
$errors1 = array();

if(isset($_POST["update_info"]))
{
    $pat_id = $_POST["pat_id"];
    $diagnosis=$_POST["diag"];
    $med_id = $_POST["med_id"];
    $query = "UPDATE patient SET diagnosis = '".$diagnosis."' WHERE pat_id = $pat_id";
    $query2 = "UPDATE medication SET med_id = '".$med_id."' WHERE pat_id = $pat_id";
    $result = pg_query($db,$query);
    $result2 = pg_query($db,$query2);
    header("location: rec_update.php");
}

if(isset($_POST["update_emp"]))
{
    $name=$_POST["name"];
    $gender=$_POST["gender"];
    $age=$_POST["age"];
    $contact_no=$_POST["contact_no"];
    $salary=$_POST["salary"];
    $house_no=$_POST["house_no"];
    $street=$_POST["street"];
    $area=$_POST["area"];
    $city=$_POST["city"];
    $u_eid=$_COOKIE["u_eid"];
    $query = "UPDATE hospital_employee SET employee_name='".$name."' gender='".$gender."' age='".$age."' contact_no='".$contact_no."' salary='".$salary."' WHERE emp_id=$u_eid";
    $result = pg_query($db,$query); 
    $query = "UPDATE emp_address SET house_no='".$house_no."' street='".$street."' area='".$area."' city='".$city."' WHERE emp_id=$u_eid";
    $result = pg_query($db,$query);
    unset($_COOKIE['u_eid']);
}

if(isset($_POST["update_pat"]))
{
    $name=$_POST["name"];
    $gender=$_POST["gender"];
    $dob=$_POST["dob"];
    $contact_no=$_POST["contact_no"];
    $admit_date=$_POST["admit_date"];
    $house_no=$_POST["house_no"];
    $street=$_POST["street"];
    $area=$_POST["area"];
    $city=$_POST["city"];
    $u_pid=$_COOKIE["u_pid"];
    $query = "UPDATE patient SET pat_name='".$name."' gender='".$gender."' date_of_birth='".$dob."' contact_no='".$contact_no."' admit_date='".$admit_date."' WHERE pat_id=$u_pid"; 
    $result = pg_query($db,$query);
    $query = "UPDATE pat_address SET house_no='".$house_no."' street='".$street."' area='".$area."' city='".$city."' WHERE pat_id=$u_pid";
    $result = pg_query($db,$query);
    unset($_COOKIE['u_pid']);
}

if(isset($_POST["update_med_inv"]))
{
    $name=$_POST["name"];
    $cost=$_POST["cost"];
    $quantity=$_POST["quantity"];
    $med_id=$_COOKIE["u_mid"];
    $query = "UPDATE medicine_inventory SET med_name='".$name."' cost='".$cost."' quantity='".$quantity."' WHERE med_id=$u_mid"; 
    $result = pg_query($db,$query);
    unset($_COOKIE['u_pid']);
}


if(isset($_POST["update_nur"]))
{
    $room=$_POST["room_id"];
    $nurse_id=$_POST["nurse_id"];
    $query = "SELECT * FROM room_incharge WHERE room_no='".$room."';";
    $result=pg_query($db,$query);
    $answer = $pg_fetch_assoc($result);
    $query = "SELECT * FROM nurse WHERE nurse_id='".$nurse_id."';";
    $result = pg_query($db,$query);
    $ans = pg_fetch_assoc($result);
    if($answer && $ans)
    {
        $query = "UPDATE room_incharge SET nurse_id='".$nurse_id."' WHERE room_no='".$room."'";

    }
    else if($ans)
    {
        echo '<script language="javascript">';
        echo 'alert("Room Not Found")';
        echo '</script>';
    }
    elseif($nswer)
    {
        echo '<script language="javascript">';
        echo 'alert("Nurse Not Found")';
        echo '</script>';
    }
    else
    {
        echo '<script language="javascript">';
        echo 'alert("Room Not Found and Nurse not found")';
        echo '</script>';
    }
}

if(isset($_POST["update_hk"]))
{
    $room=$_POST["room_id"];
    $hk_id=$_POST["hk_id"];
    $query = "SELECT * FROM room_incharge WHERE room_no='".$room."';";
    $result=pg_query($db,$query);
    $answer = $pg_fetch_assoc($result);
    $query = "SELECT * FROM housekeeping WHERE h_id='".$hk_id."';";
    $result = pg_query($db,$query);
    $ans = pg_fetch_assoc($result);
    if($answer && $ans)
    {
        $query = "UPDATE room_incharge SET h_id='".$hk_id."' WHERE room_no='".$room."'";

    }
    else if($ans)
    {
        echo '<script language="javascript">';
        echo 'alert("Room Not Found")';
        echo '</script>';
    }
    elseif($nswer)
    {
        echo '<script language="javascript">';
        echo 'alert("Housekeeper Not Found")';
        echo '</script>';
    }
    else
    {
        echo '<script language="javascript">';
        echo 'alert("Room Not Found and housekeeping employee not found")';
        echo '</script>';
    }
}

if(isset($_POST["update_pat_doc"]))
{
    $pat_id=$_POST["pat_id"];
    $doc_id=$_POST["doc_id"];
    $query = "SELECT * FROM treats WHERE pat_id='".$pat_id."';";
    $result=pg_query($db,$query);
    $answer = $pg_fetch_assoc($result);
    $query = "SELECT * FROM doctor WHERE doc_id='".$doc_id."';";
    $result = pg_query($db,$query);
    $ans = pg_fetch_assoc($result);
    if($answer && $ans)
    {
        $query = "UPDATE treats SET doc_id='".$doc_id."' WHERE pat_id='".$pat_id."'";

    }
    elseif($answer)
    {
        echo '<script language="javascript">';
        echo 'alert("Doctor Not Found")';
        echo '</script>';
    }
    elseif($ans)
    {
        echo '<script language="javascript">';
        echo 'alert("Patient Not Found")';
        echo '</script>';
    }
    else
    {
        echo '<script language="javascript">';
        echo 'alert("Patient Not Found and Doctor not Found")';
        echo '</script>';
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
                <li><a href="rec_insert.php">Add</a></li>
                <li class="active"><a href="rec_update.php">Change</a></li>
                <li><a href="rec_delete.php">Remove</a></li>
                <li><a href="view_database.php">View DB</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#"><span
                            class="glyphicon glyphicon-user"></span> Account <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="rec_insert.php">Update Information</a></li>
                        <li><a href="rec_insert.php">Change Password</a></li>
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
            <li class="active"><a data-toggle="tab" href="#emp">Employee</a></li>
            <li><a data-toggle="tab" href="#pat">Patient</a></li>
            <li><a data-toggle="tab" href="#med_inv">Medicine Inventory</a></li>
            <li><a data-toggle="tab" href="#nur">Nurse</a></li>
            <li><a data-toggle="tab" href="#house_keep">Housekeeping</a></li>
            <li><a data-toggle="tab" href="#patdoc">Pat-Doc</a></li>
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
                <form class="form" action="/Hospital-DBMS/HTML/rec_update_emp.php" method="POST">
                    <div class="form-group-sm">
                        <label for="name">Name:</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="form-group-sm">
                        <h5><b>Gender:</b></h5>
                        <input type="text" class="form-control" id="gender" name="gender" required>
                    </div>
                    <div class="form-group-sm">
                        <label for="age">Age:</label>
                        <input type="number" class="form-control" id="age" name="age" required>
                    </div>
                    <div class="form-group-sm">
                        <label for="contact_no">Contact Number:</label>
                        <input type="tel" class="form-control" id="contact_no" name="contact_no" required>
                    </div>
                    <div class="form-group-sm">
                        <label for="house_no">House No:</label>
                        <input type="number" class="form-control" id="house_no" name="house_no" required>
                    </div>
                    <div class="form-group-sm">
                        <label for="street">Street:</label>
                        <input type="text" class="form-control" id="street" name="street" required>
                    </div>
                    <div class="form-group-sm">
                        <label for="area">Area:</label>
                        <input type="text" class="form-control" id="area" name="area" required>
                    </div>
                    <div class="form-group-sm">
                        <label for="city">City:</label>
                        <input type="text" class="form-control" id="city" name="city" required>
                    </div>
                    <div class="form-group-sm">
                        <label for="salary">Salary:</label>
                        <input type="number" class="form-control" id="salary" name="salary" required>
                    </div>
                    <button type="submit" name="update_emp" class="btn btn-default" value="submit">Submit</button>
                </form>
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
                <form class="form" action="/Hospital-DBMS/HTML/rec_update.php" method="POST">
                    <div class="form-group-sm">
                        <label for="name">Name:</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="form-group-sm">
                        <h5><b>Gender:</b></h5>
                        <input type="text" class="form-control" id="gender" name="gender" required>
                    </div>
                    <div class="form-group-sm">
                        <label for="dob">Date of Birth:</label>
                        <input type="date" class="form-control" id="dob" name="dob" required>
                    </div>
                    <div class="form-group-sm">
                        <label for="contact_no">Contact Number:</label>
                        <input type="tel" class="form-control" id="contact_no" name="contact_no" required>
                    </div>
                    <div class="form-group-sm">
                        <label for="house_no">House No:</label>
                        <input type="number" class="form-control" id="house_no" name="house_no" required>
                    </div>
                    <div class="form-group-sm">
                        <label for="street">Street:</label>
                        <input type="text" class="form-control" id="street" name="street" required>
                    </div>
                    <div class="form-group-sm">
                        <label for="area">Area:</label>
                        <input type="text" class="form-control" id="area" name="area" required>
                    </div>
                    <div class="form-group-sm">
                        <label for="city">City:</label>
                        <input type="text" class="form-control" id="city" name="city" required>
                    </div>
                    <div class="form-group-sm">
                        <label for="admit_date">Admit Date:</label>
                        <input type="date" class="form-control" id="admit_date" name="admit_date" required>
                    </div>
                    <button type="submit" name="update_pat" class="btn btn-default" value="submit">Submit</button>
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
                <form class="form" action="/Hospital-DBMS/HTML/rec_update.php" method="POST">
                    <div class="form-group-sm">
                        <label for="name">Medicine Name:</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="form-group-sm">
                        <label for="cost">Cost:</label>
                        <input type="number" class="form-control" id="cost" name="cost" required>
                    </div>
                    <div class="form-group-sm">
                        <label for="quantity">Quantity:</label>
                        <input type="number" class="form-control" id="quantity" name="quantity" required>
                    </div>
                    <button type="submit" name="update_med_inv" class="btn btn-default" value="submit">Submit</button>
                </form>
            </div>
            <div id="nur" class="tab-pane fade">
                <h3>Nurse</h3>
                <form class="form" action="/Hospital-DBMS/HTML/rec_update.php" method="POST">
                    <div class="form-group-sm">
                        <label for="room_id">Room ID:</label>
                        <input type="number" class="form-control" id="room_id" name="room_id" required>
                    </div>
                    <div class="form-group-sm">
                        <label for="nurse_id">Nurse ID:</label>
                        <input type="number" class="form-control" id="nurse_id" name="nurse_id" required>
                    </div>
                    <button type="submit" name="update_nur" class="btn btn-default" value="submit">Submit</button>
                </form>
            </div>
            <div id="house_keep" class="tab-pane fade">
                <h3>Housekeeping</h3>
                <form class="form" action="/Hospital-DBMS/HTML/rec_update.php" method="POST">
                    <div class="form-group-sm">
                        <label for="room_id">Room ID:</label>
                        <input type="number" class="form-control" id="room_id" name="room_id" required>
                    </div>
                    <div class="form-group-sm">
                        <label for="hk_id">Housekeeping ID:</label>
                        <input type="number" class="form-control" id="hk_id" name="hk_id" required>
                    </div>
                    <button type="submit" name="update_hk" class="btn btn-default" value="submit">Submit</button>
                </form>
            </div>
            <div id="patdoc" class="tab-pane fade">
                <h3>Pat-Doc</h3>
                <form class="form" action="/Hospital-DBMS/HTML/rec_update.php" method="POST">
                    <div class="form-group-sm">
                        <label for="pat_id">Patient ID:</label>
                        <input type="number" class="form-control" id="pat_id" name="pat_id" required>
                    </div>
                    <div class="form-group-sm">
                        <label for="doc_id">Doctor ID:</label>
                        <input type="number" class="form-control" id="doc_id" name="doc_id" required>
                    </div>
                    <button type="submit" name="update_pat_doc" class="btn btn-default" value="submit">Submit</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>