<?php
$host = "host = localhost";
$port = "port = 5432";
$dbname = "dbname = test";
$credentials = "user = postgres password=15739";

$db = pg_connect("$host $port $dbname $credentials");
$errors1 = array();
$emp_id = $_COOKIE["empid"];
$r_id = $_COOKIE["r_id"];

if(isset($_POST["update_info"]))
{
    $age = $_POST["age"];
    $name=$_POST["name"];
    $contact_no=$_POST["contact_no"];
    $house_no = $_POST["house_no"];
    $street = $_POST["street"];
    $area =$_POST["area"];
    $city =$_POST["city"];
    $query = "UPDATE hospital_employee SET employee_name='".$name."',contact_no='".$contact_no."', age = '".$age."' WHERE emp_id = $emp_id";
    $result = pg_query($db,$query);
    $query = "UPDATE emp_address SET house_no='".$house_no."',street='".$street."', area = '".$area."',city = '".$city."' WHERE emp_id = $emp_id";
    $result = pg_query($db,$query);
    header("location: rec_insert.php");
}

if(isset($_POST["update_password"]))
{
    $curr_psw=$_POST["curr_psw"];
    $new_psw=$_POST["new_psw"];
    $rep_psw=$_POST["rep_new_psw"];
    $query = "SELECT password FROM EMPLOYEE_LOGIN WHERE emp_id = $emp_id";
    $result = pg_query($db,$query);
    $result_array = pg_fetch_assoc($result);
    $check_psw = $result_array["password"];
    if($rep_psw!=$new_psw)
    {
        echo '<script language="javascript">';
        echo 'alert("Repeat Password does not match New password")';
        echo '</script>';
        array_push($errors1,"1");
    }
    if($curr_psw != $check_psw)
    {
        echo '<script language="javascript">';
        echo 'alert("Current Password does not match")';
        echo '</script>';
        array_push($errors1,"0");
    }
    if(count($errors1)<=0)
    {
        $query="UPDATE employee_login SET password = '".$new_psw."' WHERE emp_id = $emp_id";
        $result=pg_query($db,$query);
        header("location: login.html");
    }
}

$query = "SELECT employee_name , gender, age, emp_type, salary ,contact_no FROM hospital_employee WHERE emp_id = $emp_id";
$result = pg_query($db,$query);
$answer = pg_fetch_array($result);
$name = $answer[0];
$gender = $answer[1];
$age = $answer[2];
$emp_type = $answer[3];
$salary = $answer[4];
$ph_no = $answer[5];
$query = "SELECT house_no , street, area, city FROM emp_address WHERE emp_id = $emp_id";
$result = pg_query($db,$query);
$answer = pg_fetch_array($result);
$house_no = $answer[0];
$street = $answer[1];
$area = $answer[2];
$city = $answer[3];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Hospital Database</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="main.css">
    <script src="myScript.js"></script>



</head>

<body>

    <div class="page-header">
        <h1>Hospital Database</h1>
    </div>

    <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <ul class="nav navbar-nav">
                <li class="active" onclick="rec_forms(1)"><a href="#">Add</a></li>
                <li><a href="rec_update.php">Change</a></li>
                <li><a href="rec_delete.php">Remove</a></li>
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

    <div id="insert_div" class="container">
        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#emp">Employee</a></li>
            <li><a data-toggle="tab" href="#pat">Patient</a></li>
            <li><a data-toggle="tab" href="#med_inv">Medicine Inventory</a></li>
        </ul>
        <div class="tab-content">
            <div id="emp" class="tab-pane fade in active">
                <h3>Employee</h3>
                <form class="form" action="/Hospital-DBMS/HTML/rec_insert.php" method="POST">
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
                        <label for="job_type">Job Type:</label>
                        <input type="text" class="form-control" id="job_type" name="job_type" required>
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
                    <button type="submit" name="insert_emp" class="btn btn-default" value="submit">Submit</button>
                </form>
            </div>
            <div id="pat" class="tab-pane fade">
                <h3>Patient</h3>
                <form class="form" action="/Hospital-DBMS/HTML/rec_insert.php" method="POST">
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
                    <div class="form-group-sm">
                        <label for="diag">Diagnosis:</label>
                        <input type="text" class="form-control" id="diag" name="diag" required>
                    </div>
                    <div class="form-group-sm">
                        <label for="doc_id">Doctor Assigned(Doc ID):</label>
                        <input type="number" class="form-control" id="doc_id" name="doc_id" required>
                    </div><div class="form-group-sm">
                        <label for="room_id">Room Assigned(Room ID):</label>
                        <input type="number" class="form-control" id="room_id" name="room_id" required>
                    </div>
                    <button type="submit" name="insert_pat" class="btn btn-default" value="submit">Submit</button>
                </form>
            </div>
            <div id="med_inv" class="tab-pane fade">
                <h3>Medicine Inventory</h3>
                <form class="form" action="/Hospital-DBMS/HTML/rec_insert.php" method="POST">
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
                    <button type="submit" name="insert_med_inv" class="btn btn-default" value="submit">Submit</button>
                </form>
            </div>
        </div>
    </div>

    <div id="info_form">
        <form class="form" action="/Hospital-DBMS/HTML/rec_insert.php" method="POST" >
            <div class="form-group-sm">
                <label for="name">Name:</label>
                <input type="text" class="form-control" id="name" name="name" value="<?php echo $name; ?>" required>
            </div>
            <div class="form-group-sm">
                <label for="age">Age:</label>
                <input type="number" class="form-control" id="age" name="age" value="<?php echo $age; ?>" required>
            </div>
            <div class="form-group-sm">
                <label for="contact_no">Contact Number:</label>
                <input type="number" class="form-control" id="contact_no" name="contact_no" value="<?php echo $ph_no; ?>" required>
            </div>
            <div class="form-group-sm">
                <label for="house_no">House No:</label>
                <input type="number" class="form-control" id="house_no" name="house_no" value="<?php echo $house_no; ?>" required>
            </div>
            <div class="form-group-sm">
                <label for="street">Street:</label>
                <input type="text" class="form-control" id="street" name="street" value="<?php echo $street; ?>" required>
            </div>
            <div class="form-group-sm">
                <label for="area">Area:</label>
                <input type="text" class="form-control" id="area" name="area" value="<?php echo $area; ?>" required>
            </div>
            <div class="form-group-sm">
                <label for="city">City:</label>
                <input type="text" class="form-control" id="city" name="city" value="<?php echo $city; ?>" required>
            </div>
            <button type="submit" name="update_info" class="btn btn-default" value="submit">Submit</button>
        </form>
    </div>

    <div id="pass_form">
        <form class="form" action="/Hospital-DBMS/HTML/rec_insert.php" method="POST">
            <div class="form-group">
                <input type="password" class="form-control" placeholder="Current Password" name="curr_psw" value="" required />
            </div>
            <div class="form-group">
                <input type="password" class="form-control" placeholder="New Password" name="new_psw" value="" required />
            </div>
            <div class="form-group">
                <input type="password" class="form-control" placeholder="Repeat New Password" name="rep_new_psw" value="" required />
            </div>
            <button type="submit" name="update_password" class="btn btn-default" value="submit">Submit</button>
        </form>
    </div>
</body>

</html>