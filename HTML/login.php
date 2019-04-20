<?php
unset($_COOKIE['patid']);
unset($_COOKIE['empid']);
$host = "host = localhost";
$port = "port = 5432";
$dbname = "dbname = test";
$credentials = "user = postgres password=15739";

$db = pg_connect("$host $port $dbname $credentials");
$errors = array();

if(isset($_POST["submit_emp"]))
{
    $uname=$_POST["uname"];
    $pword=$_POST["psw"];
    $query1="SELECT * FROM EMPLOYEE_LOGIN WHERE EMP_ID='".$uname."'";
    $result=pg_query($db,$query1);
    $user=pg_fetch_assoc($result);
    if($user)
    {
        $answer=pg_fetch_result($result,0,1);
        if($answer==$pword)
        {
            header("location: employee.html");
        }
        else
        {
            $cookiename = "empid";
            $cookievalue = $uname;
            setcookie($cookiename, $cookievalue, time() + (86400), "/");
            array_push($errors,"Password does not match Username");
        }
    }
    else
    {
        array_push($errors,"Username not found");
    }
}

if(isset($_POST["submit_pat"]))
{
    $uname=$_POST["uname"];
    $pword=$_POST["psw"];
    $query1="SELECT * FROM PATIENT_LOGIN WHERE PAT_ID='".$uname."'";
    $result=pg_query($db,$query1);
    $user=pg_fetch_assoc($result);
    if($user)
    {
        $answer=pg_fetch_result($result,0,1);
        if($answer==$pword)
        {
            $cookiename = "patid";
            $cookievalue = $uname;
            setcookie($cookiename, $cookievalue, time() + (86400), "/");
            header("location: patient.php");
        }
        else
        {
            array_push($errors,"Password does not match Username");
        }
    }
    else
    {
        array_push($errors,"Username not found");
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>

    <?php  if (count($errors) > 0) : ?>
        <div class="error">
  	        <?php foreach ($errors as $error) : ?>
  	            <p><?php echo $error ?></p>
  	        <?php endforeach ?>
        </div>
    <?php  endif ?>

    <title>Hospital Database</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="main.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

</head>

<body>
    <div class="page-header">
        <h1>Hospital Database</h1>
    </div>

    <div class="container login-container">
        <div class="row">
            <div class="col-md-6 login-form-1">
                <h3>Employee Login</h3>
                <form action="/abc/login.php" method="POST">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Employee ID *" name="uname" value="" required />
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" placeholder="Your Password *" name="psw" value="" required/>
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btnSubmit" name="submit_emp" value="Login" />
                    </div>
                    <!-- <div class="form-group">
                        <a href="#" class="ForgetPwd">Forget Password?</a>
                    </div> -->
                </form>
            </div>
            <div class="col-md-6 login-form-2">
                <h3>Patient Login</h3>
                <form action="login.php" method="POST">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Patient ID *" name="uname" value="" required/>
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" placeholder="Your Password *" name="psw" value="" required/>
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btnSubmit" name="submit_pat" value="Login" />
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>