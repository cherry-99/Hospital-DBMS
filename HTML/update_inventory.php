<?php
$host = "host = localhost";
$port = "port = 5432";
$dbname = "dbname = test";
$credentials = "user = postgres password=15739";

$db = pg_connect("$host $port $dbname $credentials");
$errors1 = array();
// $pat_id = $_COOKIE['patid'];

//We dont need the below part. It is for the patient to update his details. But the form is for the nurse to update the patient details
// if(isset($_POST["update_info"]))
// {
//     $name=$_POST["name"];
//     $contact_no=$_POST["contact_no"];
//     $dob=$_POST["dob"];
//     $address=$_POST["address"];
//     $query = "UPDATE patient SET pat_name='".$name."',address='".$address."',date_of_birth='".$dob."',contact_no='".$contact_no."' WHERE pat_id = $pat_id";
//     $result = pg_query($db,$query);
//     header("location: nurse.php");
// }

//The below part is for patient login verification. Not needed here.
// if(isset($_POST["update_password"]))
// {
//     $curr_psw=$_POST["curr_psw"];
//     $new_psw=$_POST["new_psw"];
//     $rep_psw=$_POST["rep_new_psw"];
//     if($rep_psw!=$new_psw)
//     {
//         array_push($errors1,"REPEAT NEW PASSWORD MUST MATCH NEW PASSWORD");
//     }
//     $query="SELECT * FROM PATIENT_LOGIN WHERE PAT_ID=$pat_id";
//     $result=pg_query($db,$query);
//     $pword=pg_fetch_result($result,0,1);
//     if($curr_psw!=$pword)
//     {
//         array_push($errors1,"Current Password Does Not Match");
//     }
//     if(count($errors1)>0)
//     {
//         echo '<script type="text/javascript">','patient_forms(3); ','</script>';
//     }
//     else
//     {
//         $query = "UPDATE patient_login SET pasword='".$new_psw."' WHERE pat_id=$pat_id";
//         $result = pg_query($db,$query);
//         header("location: login.html");
//     }
// }

//The following is for the nurse to update the patient diagnosis details
if(isset($_POST["update_info"]))
{
    $pat_id = $_POST["pat_id"];
    $diagnosis=$_POST["diag"];
    $med_id = $_POST["med_id"];
    $query = "UPDATE patient SET diagnosis = '".$diagnosis."' WHERE pat_id = $pat_id";
    $query2 = "UPDATE medication SET med_id = '".$med_id."' WHERE pat_id = $pat_id";
    $result = pg_query($db,$query);
    $result2 = pg_query($db,$query2);
    header("location: nurse.php");
}

//Below code is not necessary. We are not displaying the patient details anywhere in the form
// $query = "SELECT * FROM patient WHERE pat_id = $pat_id";
// $result = pg_query($db,$query);
// $answer = pg_fetch_array($result);
// $name = $answer[1];
// $gender = $answer[2];
// $dob = $answer[3];
// $ph_no = $answer[4];
// $admit_date = $answer[5];
// $diagnosis = $answer[6];
// $discharge_date = $answer[7];
// $address = $answer[8];

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
    <div class="container">
        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#inventory">Inventory</a></li>
            <li><a data-toggle="tab" href="#placeholder">Placeholder</a></li>
        </ul>
<!-- the below form for updating the invetory -->
        <div class="tab-content">
            <div id="inventory" class="tab-pane fade in active">
                <h3>Inventory</h3>
                <form class="form" action="/Hospital-DBMS/HTML/update_inventory.php" method="POST">
                    <div class="form-group-sm">
                        <label for="med_id">Medicine ID:</label>
                        <input type="number" class="form-control" id="med_id" name="med_id" value="<?php echo $med_id; ?>"
                            required>
                    </div>
                    <div class="form-group-sm">
                        <label for="med_name">Medicine Name:</label>
                        <input type="text" class="form-control" id="med_name" name="med_name" value="<?php echo $med_name; ?>"
                            required>
                    </div>
                    <div class="form-group-sm">
                        <label for="quantity">Quantity:</label>
                        <input type="number" class="form-control" id="quantity" name="quantity" value="<?php echo $quantity; ?>"
                            required>
                    </div>
                    <button type="submit" name="update_info" class="btn btn-default" value="submit">Submit</button>
                </form>
            </div>
            <div id="placeholder" class="tab-pane fade">
                <h3>Placeholder</h3>
                <form class="form" action="/Hospital-DBMS/HTML/update_inventory.php" method="POST">
                    <div class="form-group-sm">
                        <label for="placeholder1">Placeholder1:</label>
                        <input type="number" class="form-control" id="placeholder1" name="placeholder1" value=""
                            required>
                    </div>
                    <div class="form-group-sm">
                        <label for="placeholder2">Placeholder2:</label>
                        <input type="datetime-local" class="form-control" id="placeholder2" name="placeholder2"
                            value="" required>
                    </div>
                    <button type="submit" name="update_info" class="btn btn-default" value="submit">Submit</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>