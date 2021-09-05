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

<body style="background-image:linear-gradient(to right,red,white,red); background:url('img/bg12.jpg');  background-size:cover;">
    <?php
    include "header.php";
    ?>
    <div class="container l1" style="height:410px">
        <div class="login_f col m-auto w-75" style="background-color:aliceblue">
            <form action="" method="post" id="fileForm" role="form" class="m-auto w-75">
                <legend class="title text-center fs-30 mb-10">Admin Login</legend>
                <div class="form-group">
                <label for="Name"><span class="req">* </span> Name : </label> 
                    <input class="form-control border-primary" required type="text" name="aname" id = "name"  onchange="text(this.value);" placeholder="Name"/>   
                        
                </div>

                <div class="form-group">
                    <label for="password"><span class="req">* </span> Password: </label>
                    <input required name="password" type="password" class="form-control border-primary inputpass" minlength="4" maxlength="16" placeholder="Password" id="pass1" /> </p>
                </div>

                <div class="form-group">
                    <div class="d-inline mr-5">
                        <input class="btn btn-success px-4 py-2" type="submit" name="admin_login" value="Submit">
                    </div>
                    <div class="d-inline mr-5">
                        <input class="btn btn-danger px-4 py-2" type="reset" name="reset_login" value="Reset">

                    </div>
                </div>
            </form>
        </div>
        
    </div>

    <?php
    include "footer.php"
    ?>
    <script src="js/reg_js.js"></script>
</body>
</html>
<?php
if (isset($_POST['admin_login'])) {
    $admin = $_POST['aname'];
    $pwd = $_POST['password'];
    if($admin == "admin" && $pwd = "1234")
	{
        $_SESSION['admin']=$admin;
	    header("Location: session.php");
	}
	else
	{
		echo "<script>alert('Invalid Name OR Password !!!')</script>";
	}
}
?>
