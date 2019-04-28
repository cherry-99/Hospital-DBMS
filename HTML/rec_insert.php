<?php
$host = "host = localhost";
$port = "port = 5432";
$dbname = "dbname = test";
$credentials = "user = postgres password=15739";

$db = pg_connect("$host $port $dbname $credentials");
$errors1 = array();
$emp_id = $_COOKIE["empid"];
$r_id = $_COOKIE["r_id"];

if(isset($_POST["insert_emp"]))
{
    $name=$_POST["name"];
    $gender=$_POST["gender"];
    $age = $_POST["age"];
    $contact_no=$_POST["contact_no"];
    $job_type=$_POST["job_type"];
    $house_no = $_POST["house_no"];
    $street = $_POST["street"];
    $area =$_POST["area"];
    $city =$_POST["city"];
    $salary = $_POST["salary"];
    $q="SELECT * FROM hospital_employee WHERE contact_no='".$contact_no."'";
    $res=pg_query($db,$q);
    $a=pg_fetch_assoc($res);
    if($a)
    {
        echo '<script language="javascript">';
        echo 'alert("Phone Number Already Registered with User")';
        echo '</script>';
    }
    else
    {
        $insert_employee = "INSERT INTO hospital_employee(employee_name,gender,age,emp_type,salary,contact_no) 
              VALUES ('".$name."','".$gender."','".$age."','".$job_type."','".$salary."','".$contact_no."')";
        $result=pg_query($db,$insert_employee);
        $job_type = pg_fetch_result(pg_query("SELECT emp_type FROM hospital_employee WHERE contact_no='".$contact_no."'"),0,0);
        $query = "SELECT emp_id FROM hospital_employee WHERE contact_no='".$contact_no."'";
        $result=pg_query($db,$query);
        $emp_id=pg_fetch_result($result,0,0);
        $query = "INSERT INTO emp_address VALUES ('".$house_no."','".$street."','".$area."','".$city."','".$emp_id."')";
        $result = pg_query($db,$query);
        if($job_type=="DOCTOR")
        {
            $query3 = "INSERT INTO employee_login VALUES ('".$emp_id."','".$emp_id."')";
            $result3 = pg_query($db,$query3);
            $query4 = "INSERT INTO doctor(emp_id) VALUES ('".$emp_id."')";
            $result4 = pg_query($db,$query4);
        }
        if($job_type=="NURSE")
        {
            $query3 = "INSERT INTO employee_login VALUES ('".$emp_id."','".$emp_id."')";
            $result3 = pg_query($db,$query3);
            $query4 = "INSERT INTO nurse(emp_id) VALUES ('".$emp_id."')";
            $result4 = pg_query($db,$query4);
        }
        if($job_type=="RECEPTIONIST")
        {
            $query3 = "INSERT INTO employee_login VALUES ('".$emp_id."','".$emp_id."')";
            $result3 = pg_query($db,$query3);
            $query4 = "INSERT INTO receptionist(emp_id) VALUES ('".$emp_id."')";
            $result4 = pg_query($db,$query4);
        }
        if($job_type=="HOUSEKEEPING")
        {
            $query4 = "INSERT INTO hosekeeping(emp_id) VALUES ('".$emp_id."')";
            $result4 = pg_query($db,$query4);
        }
        echo '<script language="javascript">';
        echo 'alert(" '.$emp_id.' is the employee id and default password.")';
        echo '</script>';
    }
}

if(isset($_POST["insert_pat"]))
{
    $name=$_POST["name"];
    $gender=$_POST["gender"];
    $dob = $_POST["dob"];
    $contact_no=$_POST["contact_no"];
    $house_no = $_POST["house_no"];
    $street = $_POST["street"];
    $area =$_POST["area"];
    $city =$_POST["city"];
    $admit_date = $_POST["admit_date"];
    $doc=$_POST["doc_id"];
    $room=$_POST["room_id"];
    $q="SELECT * FROM patient WHERE contact_no='".$contact_no."'";
    $res=pg_query($db,$q);
    $a=pg_fetch_assoc($res);
    if($a)
    {
        echo '<script language="javascript">';
        echo 'alert("Phone Number Already Registered with Patient")';
        echo '</script>';
    }
    else
    {
        $insert_patient = "INSERT INTO patient(pat_name,gender,date_of_birth,contact_no,admit_date) VALUES ('".$name."','".$gender."','".$dob."','".$contact_no."','".$admit_date."')";
        $result=pg_query($db,$insert_patient);
        $query = "SELECT pat_id FROM patient WHERE contact_no='".$contact_no."'";
        $result=pg_query($db,$query);
        $pat_id=pg_fetch_result($result,0,0);
        $query = "INSERT INTO emp_address VALUES ('".$house_no."','".$street."','".$area."','".$city."','".$pat_id."')";
        $result = pg_query($db,$query);
        $query3 = "INSERT INTO patient_login VALUES ('".$pat_id."','".$pat_id."')";
        $result3 = pg_query($db,$query3);
        $query3 = "INSERT INTO treats(doc_id,pat_id) VALUES ('".$doc."','".$pat_id."')";
        $result3 = pg_query($db,$query3);
        $query3 = "INSERT INTO room_assigned(room_no,pat_id) VALUES ('".$room."','".$pat_id."')";
        $result3 = pg_query($db,$query3);
        $query3 = "UPDATE rooms SET status='occ' WHERE room_no = $room";
        $result3 = pg_query($db,$query3);
        echo '<script language="javascript">';
        echo 'alert(" '.$pat_id.' is the employee id and default password.")';
        echo '</script>';
    }
}

if(isset($_POST["insert_med_inv"]))
{
    $name=$_POST["name"];
    $cost=$_POST["cost"];
    $quantity = $_POST["quantity"];
    $query = "SELECT * FROM medicine_inventory WHERE med_name='".$name."'";
    $result=pg_query($db,$query);
    $a=pg_fetch_assoc($result);
    if($a)
    {
        echo '<script language="javascript">';
        echo 'alert("Medicine already exists in inventory")';
        echo '</script>';
    }
    else
    {
        $query = "INSERT INTO medicine_inventory(med_name,cost,quantity) VALUES ('".$name."','".$cost."','".$quantity."')";
        $result=pg_query($db,$query);
    }
}

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
                        <label for="doc_id">Doctor Assigned(Doc ID):</label>
                        <input type="number" class="form-control" id="doc_id" name="doc_id" required>
                    </div><div class="form-group-sm">
                        <label for="room_id">Room Assigned(Room ID):</label>
                        <input type="number" class="form-control" id="room_id" name="room_id" required>
                    </div>
                    <button type="submit" name="insert_pat" class="btn btn-default" value="submit">Submit</button>
                </form>
                <?php
                        echo "ALL DOCTORS";
                        $query="SELECT doctor.doc_id,hospital_employee.employee_name FROM doctor inner join hospital_employee on doctor.emp_id=hospital_employee.emp_id ORDER BY doctor.doc_id;";
                        $result = pg_query($db,$query);
                        echo '<table id="table1" class="table table-bordered table-striped" border="1" cellpadding="5" align="center">';
                        echo "<thead><tr><th>doctor ID</th><th>Doctor Name</th> </tr></thead><tbody>";
                        while($row = pg_fetch_array( $result )) 
                        {
                            // echo out the contents of each row into a table
                            echo "<tr>";
                            echo '<td>' . $row['doc_id'] . '</td>';
                            echo '<td>' . $row['employee_name'] . '</td>'.'</tr>';
                        }
                        echo "</tbody></table>";
                ?>
                <?php
                        echo "Number of patients treated by doctors";
                        $query="SELECT doctor.doc_id , count(*) FROM doctor inner join treats on treats.doc_id=doctor.doc_id GROUP BY doctor.doc_id ORDER BY doctor.doc_id;";
                        $result = pg_query($db,$query);
                        echo '<table id="table1" class="table table-bordered table-striped" border="1" cellpadding="5" align="center">';
                        echo "<thead><tr><th>doctor ID</th><th>Number of patients handeled</th> </tr></thead><tbody>";
                        while($row = pg_fetch_array( $result )) 
                        {
                            // echo out the contents of each row into a table
                            echo "<tr>";
                            echo '<td>' . $row['doc_id'] . '</td>';
                            echo '<td>' . $row['count'] . '</td>'.'</tr>';
                        }
                        echo "</tbody></table>";
                ?>
                <?php
                        $query="SELECT room_no,room_type FROM rooms where status='unocc';";
                        $result = pg_query($db,$query);
                        echo "AVALABLE ROOMS/UNOCCUPIED ROOMS";
                        echo '<table id="table1" class="table table-bordered table-striped" border="1" cellpadding="5" align="center">';
                        echo "<thead><tr><th>Room Number</th><th>Room Type</th> </tr></thead><tbody>";
                        while($row = pg_fetch_array( $result )) 
                        {
                            // echo out the contents of each row into a table
                            echo "<tr>";
                            echo '<td>' . $row['room_no'] . '</td>';
                            echo '<td>' . $row['room_type'] . '</td>'.'</tr>';
                        }
                        echo "</tbody></table>";
                ?>
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