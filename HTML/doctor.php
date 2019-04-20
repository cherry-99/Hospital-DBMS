<?php
$host = "host = localhost";
$port = "port = 5432";
$dbname = "dbname = test";
$credentials = "user = postgres password=15739";

$db = pg_connect("$host $port $dbname $credentials");
$errors1 = array();
$pat_id = $_COOKIE['patid'];

if(isset($_POST["update_info"]))
{
    $name=$_POST["name"];
    $contact_no=$_POST["contact_no"];
    $dob=$_POST["dob"];
    $address=$_POST["address"];
    $query = "UPDATE patient SET pat_name='".$name."',address='".$address."',date_of_birth='".$dob."',contact_no='".$contact_no."' WHERE pat_id = $pat_id";
    $result = pg_query($db,$query);
    header("location: doctor.php");
}

if(isset($_POST["update_password"]))
{
    $curr_psw=$_POST["curr_psw"];
    $new_psw=$_POST["new_psw"];
    $rep_psw=$_POST["rep_new_psw"];
    if($rep_psw!=$new_psw)
    {
        array_push($errors1,"REPEAT NEW PASSWORD MUST MATCH NEW PASSWORD");
    }
    $query="SELECT * FROM PATIENT_LOGIN WHERE PAT_ID=$pat_id";
    $result=pg_query($db,$query);
    $pword=pg_fetch_result($result,0,1);
    if($curr_psw!=$pword)
    {
        array_push($errors1,"Current Password Does Not Match");
    }
    if(count($errors1)>0)
    {
        echo '<script type="text/javascript">','patient_forms(3);','</script>';
    }
    else
    {
        $query = "UPDATE patient_login SET pasword='".$new_psw."' WHERE pat_id=$pat_id";
        $result = pg_query($db,$query);
        header("location: login.html");
    }
}

$query = "SELECT * FROM patient WHERE pat_id = $pat_id";
$result = pg_query($db,$query);
$answer = pg_fetch_array($result);
$name = $answer[1];
$gender = $answer[2];
$dob = $answer[3];
$ph_no = $answer[4];
$admit_date = $answer[5];
$diagnosis = $answer[6];
$discharge_date = $answer[7];
$address = $answer[8];

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
                <input type="text" class="form-control" id="name" name="name" disabled value="<?php echo $gender; ?>">
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
                <input type="text" class="form-control" id="job_type" name="job_type" disabled value="<?php echo $job_type; ?>">
            </div>
            <div class="form-group-sm">
                <label for="address">Address:</label>
                <input type="text" class="form-control" id="address" name="address" disabled value="<?php echo $address; ?>">
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
                <label for="address">Address:</label>
                <input type="text" class="form-control" id="address" name="address" value="<?php echo $address; ?>" required>
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