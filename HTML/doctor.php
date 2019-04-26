<?php
$host = "host = localhost";
$port = "port = 5432";
$dbname = "dbname = test";
$credentials = "user = postgres password=15739";

$db = pg_connect("$host $port $dbname $credentials");
$errors1 = array();
$emp_id = $_COOKIE["empid"];

//This is for the doctor to update his details
//Corrected the SQL query
if(isset($_POST["update_info"]))
{
    $age = $_POST["age"];
    $name=$_POST["name"];
    $contact_no=$_POST["contact_no"];
    // $address=$_POST["address"]; add more fields to address or remove address
    $query = "UPDATE hospital_employee SET employee_name='".$name."',contact_no='".$contact_no."', age = '".$age."' WHERE emp_id = $emp_id";
    $result = pg_query($db,$query);
    header("location: doctor.php");
}

//This is for the doctor to update his password
if(isset($_POST["update_password"]))
{
    $curr_psw=$_POST["curr_psw"];
    $new_psw=$_POST["new_psw"];
    $rep_psw=$_POST["rep_new_psw"];
    //Added new condition. The current password which the doctor enters should also be correct.
    $query = "SELECT password FROM EMPLOYEE_LOGIN WHERE emp_id = $emp_id";
    $result = pg_query($query,$db);
    $result_array = pg_fetch_assoc($result);
    $check_psw = $result_array[password];
    if($rep_psw!=$new_psw || $curr_psw != $check_psw)
    {
        array_push($errors1,"NEW PASSWORDS DO NOT MATCH");
    }
    $query="UPDATE employee_login SET password = '".$new_psw."' WHERE emp_id = $emp_id";
    $result=pg_query($db,$query);
    header("location: doctor.php");
    // $pword=pg_fetch_result($result,0,1);
    // if($curr_psw!=$pword)
    // {
    //     array_push($errors1,"Current Password Does Not Match");
    // }
    // if(count($errors1)>0)
    // {
    //     echo '<script type="text/javascript">','patient_forms(3);','</script>';
    // }
    // else
    // {
    //     $query = "UPDATE patient_login SET pasword='".$new_psw."' WHERE pat_id=$pat_id";
    //     $result = pg_query($db,$query);
    //     header("location: login.html");
    // }
}

//The following code is for retrieving the doctor details and displaying it in the form
//Remove the address field or add multiple fields so that we can retrieve the same in order from the address cross reference table
$query = "SELECT employee_name , gender, age, emp_type, salary ,contact_no FROM hospital_employee WHERE emp_id = $emp_id";
$result = pg_query($db,$query);
$answer = pg_fetch_array($result);
$name = $answer[1];
$gender = $answer[2];
$age = $answer[3];
$emp_type = $answer[4];
$salary = $answer[5];
$ph_no = $answer[6];

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
                <li class="active" onclick="doctor_forms(1)"><a href="#">Personal Information</a></li>
                <li><a href="update_pat_info.php">Update Patient Info</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#"><span
                            class="glyphicon glyphicon-user"></span> Account <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li onclick="doctor_forms(2)"><a href="#">Update Information</a></li>
                        <li onclick="doctor_forms(3)"><a href="#">Change Password</a></li>
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
    <div id="doc_details">
        <form class="form">
            <div class="form-group-sm">
                <label for="name">Name:</label>
                <input type="text" class="form-control" id="name" name="name" disabled value="<?php echo $name; ?>">
            </div>
            <div class="form-group-sm">
                <h5><b>Gender:</b></h5>
                <input type="text" class="form-control" id="gender" name="gender" disabled value="<?php echo $gender; ?>">
            </div>
            <div class="form-group-sm">
                <label for="age">Age:</label>
                <input type="number" class="form-control" id="age" name="age" disabled value="<?php echo $age; ?>">
            </div>
            <div class="form-group-sm">
                <label for="contact_no">Contact Number:</label>
                <input type="tel" class="form-control" id="contact_no" name="contact_no" disabled value="<?php echo $ph_no; ?>">
            </div>
            <div class="form-group-sm">
                <label for="job_type">Job Type:</label>
                <input type="text" class="form-control" id="job_type" name="job_type" disabled value="<?php echo $emp_type; ?>">
            </div>
            <div class="form-group-sm">
                <label for="house_no">House No:</label>
                <input type="number" class="form-control" id="house_no" name="house_no" disabled value="<?php echo $house_no; ?>">
            </div>
            <div class="form-group-sm">
                <label for="street">Street:</label>
                <input type="text" class="form-control" id="street" name="street" disabled value="<?php echo $street; ?>">
            </div>
            <div class="form-group-sm">
                <label for="area">Area:</label>
                <input type="text" class="form-control" id="area" name="area" disabled value="<?php echo $area; ?>">
            </div>
            <div class="form-group-sm">
                <label for="city">City:</label>
                <input type="text" class="form-control" id="city" name="city" disabled value="<?php echo $city; ?>">
            </div>
            <div class="form-group-sm">
                <label for="salary">Salary:</label>
                <input type="text" class="form-control" id="salary" name="salary" disabled value="<?php echo $salary; ?>">
            </div>
        </form>
    </div>

    <div id="info_form">
        <form class="form" action="/Hospital-DBMS/HTML/doctor.php" method="POST" >
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
        <form class="form" action="/Hospital-DBMS/HTML/doctor.php" method="POST">
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