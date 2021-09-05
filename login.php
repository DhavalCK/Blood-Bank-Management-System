<?php
    include("config.php");
    ob_start();
    session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">

  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="" name="keywords">
  <meta content="" name="description">
  <link href="img/icon1.png" rel="icon">
  <link href="img/icon1.png" rel="apple-touch-icon">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Poppins:300,400,500,700" rel="stylesheet">
  <link href="lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="lib/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <link href="lib/animate/animate.min.css" rel="stylesheet">
  <link href="css/style.css" rel="stylesheet">
  <link href="css/login_style.css" rel="stylesheet">
</head>

<body style="background-image:linear-gradient(to right,red,white,red);">
    <?php
    include "header.php";
    if($_GET["msg"]=="sent")
    {
        echo "<div class='alert alert-success' role='alert'>
  Password Send Via SMS On Check it Out.
</div>";
    }
    else if($_GET["msg"]=="nothing")
    {

    }
    ?>
    
    <div class="container l1" style="height:500px">
        <div class="login_f col m-auto w-75" style="background-color:aliceblue ; box-shadow:black 3px 3px 5px">
            <form action="login.php" method="post" id="fileForm" role="form" class="m-auto w-75">
                <legend class="title text-center fs-30 mb-10">Login</legend>
                <div class="form-group">
                <label for="email"><span class="req">* </span> Email : </label> 
                    <input class="form-control border-primary" required type="text" name="email" id = "email"  onchange="email_validate(this.value);" placeholder="Email"/>   
                    <div class="status" id="status"></div>
                </div>

                <div class="form-group">
                    <label for="password"><span class="req">* </span> Password: </label>
                    <input required name="password" type="password" class="form-control border-primary inputpass" minlength="4" maxlength="16" placeholder="Password" id="pass1" /> </p>
                </div>

                <div class="form-group">
                    <div class="d-inline mr-5">
                        <input class="btn btn-success px-4 py-2" type="submit" name="submit_login" value="Submit">
                    </div>
                    <div class="d-inline mr-5">
                        <input class="btn btn-danger px-4 py-2" type="reset" name="reset_login" value="Reset">

                    </div>
                </div>
            </form>
            <div class="card-footer">
				<div class="d-flex justify-content-center links">
					Don't have an account ?&nbsp;<a href="reg.php" class="text-primary"> Sign Up</a>
				</div>
				<div class="d-flex justify-content-center">
					<a href="forgot_password.php" class="text-danger">Forgot your password?</a>
				</div>
            </div>
        </div>
        
    </div>

    <?php
    include "footer.php"
    ?>
    <script src="js/login_js.js"></script>
</body>
</html>
<?php
if (isset($_POST['submit_login'])) {
    $email = $_POST['email'];
    $pwd = $_POST['password'];
    $result = mysqli_query($db,"SELECT * FROM user WHERE userid = '$email' and password = '$pwd' ");
    $num=mysqli_num_rows($result);
	$res=mysqli_fetch_array($result);
	if($num==1)
	{
        $_SESSION['userid']=$res['userid'];
        $_SESSION['utype']=$res['utype'];
	    header("Location: session.php");
	}
	else
	{
		echo "<script>alert('Invalid Email or Password')</script>";
     
        // header("Location: login.php");   
	}
}
?>
