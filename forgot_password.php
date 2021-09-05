<?php
include("config.php");
ob_start();
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Home Page</title>
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
</head>

<body style="background:url('img/.jpg'); background-size:cover;">
    <?php
    include "header.php"
    ?>

    <div class="container my-5">
        <div class="col m-auto w-50 py-2" style="background-color:aliceblue; box-shadow:black 3px 3px 5px">
            <div class="col bg-color-primary">
                <form action="forgot_password.php" method="post" class="m-auto w-75">
                    <legend class="title text-center fs-30 mt-3">Recover Your Account</legend>
                    <hr>
                    <p>Please fill your email id properly</p>
                    <div class="form-group mb-4">
                        <label for="email" class="py-1">Email : </label>
                        <input class="form-control border-primary" required type="text" name="email" id="email" onchange="email_validate(this.value);" placeholder="Email" />
                    </div>
                    <div class="form-group mb-4">
                        <label for="number" class="py-1">Phone Number </label>
                        <input class="form-control border-primary" required type="number" name="phone" id="phone" placeholder="Phone Number" />
                    </div>
                    <div class="form-group mb-5">
                        <div class="d-inline mr-5">
                            <input class="btn btn-success px-4 py-2" type="submit" name="check_email" value="Submit">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div style="height:5vh">
    </div>
    <?php
    include "footer.php"
    ?>
    <script src="lib/jquery/jquery.min.js"></script>
    <script src="lib/jquery/jquery-migrate.min.js"></script>
    <script src="lib/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD8HeI8o-c1NppZA-92oYlXakhDPYR7XMY"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/counterup/counterup.min.js"></script>
    <script src="lib/superfish/hoverIntent.js"></script>
    <script src="lib/superfish/superfish.min.js"></script>
    <script src="contactform/contactform.js"></script>
</body>

</html>
<?php
if (isset($_POST['check_email'])) {
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    echo $email;
    $result = mysqli_query($db, "SELECT * FROM user WHERE userid = '$email'");
    $num = mysqli_num_rows($result);
    $res = mysqli_fetch_array($result);
    $pwd = $res[2];
    if ($num == 1) {
        if ($res[0] == "BloodBank") {
            $res2 = mysqli_query($db, "SELECT * FROM blood_bank WHERE bb_userid = '$email'");
            $res22 = mysqli_fetch_array($res2);
            $contact = $res22[2];
        } else if ($res[0] == "Donor") {
            $res3 = mysqli_query($db, "SELECT * FROM donor WHERE d_userid = '$email'");
            $res33 = mysqli_fetch_array($res3);
            $contact = $res33[2];
        } else if ($res[0] == "Patient") {
            $res4 = mysqli_query($db, "SELECT * FROM patient WHERE p_userid = '$email'");
            $res44 = mysqli_fetch_array($res4);
            $contact = $res44[2];
        }
        echo $contact;
        if ($contact == $phone) {
            // Authorisation details.
            $username = "dhavalkamariya30@gmail.com";
            $hash = "4d31d8e22691073194abfe230fa79061fce111ffb079e3bd29f40fb7cc749f81";
            $message = "Your Password is " . $pwd . ".";
            // Config variables. Consult http://api.textlocal.in/docs for more info.
            $test = "0";

            // Data for text message. This is the text message data.
            $sender = "BBMS"; // This is who the message appears to be from.
            $numbers = $contact;
            $numbers = "8758628731"; // A single number or a comma-seperated list of numbers
            // 612 chars or less
            // A single number or a comma-seperated list of numbers
            $message = urlencode($message);
            $data = "username=" . $username . "&hash=" . $hash . "&message=" . $message . "&sender=" . $sender . "&numbers=" . $numbers . "&test=" . $test;
            $ch = curl_init('http://api.textlocal.in/send/?');
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $result = curl_exec($ch); // This is the result from the API
            curl_close($ch);
             // header("Location: login.php?msg=");
         echo "Successfully".$contact;
         echo "Error".$result;
        } else {
            // echo $contact;
            // echo $phone;
?>


            <script>
                alert("Enter Valid EMail And Phonee Number");
            </script>
<?php
        }
        // $subject = "Emai Activation";
        // $body = " Hi ".$res[1]." Clicke here too active your account http://localhost/Project_bbms/forgot_password.php"; 
        // $sender_email = "From: dhavalkamariya32@gmail.com";
        // ini_set('SMTP','myserver');
        // ini_set('smtp_port',25);
        // ini_set('sendemail_from','dhavalkamariya32@gmail,com');
        // echo "<br>We found Email Try to send it<br>";
        // $check = mail('dhavalkamariya50@gmail.com','Test','Hello There','From: dhavalkamariya30@gmail.com');
        // if($check)
        // {
        //     echo "Successed";
        // }
        // else{
        //     echo "Failed";
        // }
        // if(mail($email,$subject,$body,$sender_email)){
        //     $_SESSION['msg'] = "Check Your mail to activate your account $email";
        //     echo "We Send it";
        // }
        // else 
        // {
        //     echo "Email sending failed";
        // }
        //echo "This Id Exists.";
    } else {
        echo "<script>
            alert('This Email has not Account In Out System.');
            </script>";
    }
}

?>