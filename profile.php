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

<body style="background:url('img/bg9.jpg'); background-size:cover;">
    <?php
    include "header.php"
    ?>
    <?php
    $id = $_SESSION['userid'];
    $utype = $_SESSION['utype'];
    if($utype=="Donor")
    {
        $ddetails = mysqli_query($db, "SELECT * FROM donor WHERE d_userid = '$id'");
        $num = mysqli_num_rows($ddetails);
        $res = mysqli_fetch_array($ddetails);
    }
    else if($utype=="Patient")
    {
        $pdetails = mysqli_query($db, "SELECT * FROM patient WHERE p_userid = '$id'");
        $num = mysqli_num_rows($pdetails);
        $res = mysqli_fetch_array($pdetails);
    }
    else{
        $bbdetails = mysqli_query($db, "SELECT * FROM blood_bank WHERE bb_userid = '$id'");
        $num = mysqli_num_rows($bbdetails);
        $res = mysqli_fetch_array($bbdetails);
    }
    $name = $res[1];
    $contact = $res[2];
    $address = $res[3];
    $city = $res[4];
    if ($utype!="BloodBank") {
        $age = $res[5];
        $gender = $res[6];
        $bld_grp = $res[7];
        $userid =  $res[8];
    }
    else
    {
        $userid=$res[5];
    }
    // <div class='row'>
            //     <div class='col-lg-6 m-auto'>
            //         <h1 class='text-center' style='color:white'>$utype</h1>
            //     </div>
            // </div>
    echo "<hr>
        <div class='container target'>
            
            <br>
            <div class='row'>
                <div class='col-lg-6 m-auto '>
                    <!--left col-->
                    
                    <ul class='list-group border border-dark rounded' style='background-image:linear-gradient(to right,#6af3e2,#91f378ba); box-shadow: black 5px 5px 10px;'>
                        <li class='list-group-item text-muted'><h1 class='text-center' style='color:black;'>$utype</h1></li>
                    
                        <li class='list-group-item text-muted lead font-weight-normal' contenteditable='false'>Profile</li>
                        <li class='list-group-item text-right'><span class='pull-left'><strong>Name:
                                </strong></span>$name</li>
                        <li class='list-group-item text-right'><span class='pull-left'><strong>Email / UserId:
                                </strong></span>$userid</li>";
                        if ($utype!="BloodBank") {
                            echo "<li class='list-group-item text-right'><span class='pull-left'><strong>Blood Group:
                                </strong></span>$bld_grp</li>
                        
                        <li class='list-group-item text-right'><span class='pull-left'><strong>Age:
                                </strong></span>$age</li>
                        <li class='list-group-item text-right'><span class='pull-left'><strong>Sex:
                                </strong></span>$gender</li>";
                        }
                        echo "<li class='list-group-item text-muted lead font-weight-normal' contenteditable='false'>Contact details</li>
                        <li class='list-group-item text-right'><span class='pull-left'><strong>Cellphone Number:
                                </strong></span>$contact</li>
                                <li class='list-group-item text-right'><span class='pull-left'><strong>Address:
                                </strong></span> $address</li>
                        <li class='list-group-item text-right'><span class='pull-left'><strong>City:
                                </strong></span>$city</li>
    
                    </ul>
                </div> 
            </div>
        </div>
        <hr>";
    ?>
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