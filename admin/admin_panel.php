<?php
    include("../config.php");
    ob_start();
    session_start();
    //echo "<h1>".$_SESSION['admin']."</h1>";
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

        <title>Admin Panel</title>
        <style>
            .dbox{
                background-image: linear-gradient(45deg, red, white);
                border-radius: 10px;
                width: 35%;
                border: 1px solid black;
                padding: 30px;
                margin: 45px 80px;
                text-align: center;
            }
            h2{
                color: white!important;
            }
            h3
            {
                font-weight: 500!important;
            }
               .list-group-item {
            background-color: transparent !important;

        }


        .list-group-item a {
            color: white !important;
        }
        
        .list-group-item:hover,
        .active {
             background-color: #a8c0ff!important;
                background-image:radial-gradient(circle, #0d28ea, #0e0e0efa)!important;
                color: black!important; 
            border: 1px solid white;
        }
        </style>
    </head>
    <body style="background: url('../img/abg.jpg'); background-size: cover;">
        <?php include "aheader.php" ?>
        <div class="d-flex ">
        <div class="col-lg-2 m-0 p-0" style="background-image:linear-gradient(to bottom,  #181ff3bf, #0af1bbb0);">
        <div class="bg-light text-center p-3"><img src="../img/icon1.png" width="150px"></div>
        <ul class="list-group">
            <li class="list-group-item active"><a class="pr-6 py-2 font-weight-bold" href="admin_panel.php">Home</a></li>
            <li class="list-group-item"> <a class="pr-6 py-2 font-weight-bold" href="mng_bb.php">Manage Blood Bank</a></li>
            <li class="list-group-item"><a class="pr-6 py-2 font-weight-bold" href="mng_dnr_req.php">Manage Donor Request</a></li>
            <li class="list-group-item"><a class="pr-6 py-2 font-weight-bold" href="mng_pat_req.php">Manage Blood Request</a></li>
            <li class="list-group-item"><a class="pr-6 py-2 font-weight-bold" href="adminlogout.php">Logout</a></li>
        </ul>

    </div>
            <?php //include "sidebar.php" ?>
            <?php
            $u = mysqli_query($db,"select * from user"); 
            $unum = mysqli_num_rows($u);
            
            $bb = mysqli_query($db,"select * from blood_bank"); 
            $bbnum = mysqli_num_rows($bb);
            $d = mysqli_query($db,"select * from donor"); 
            $dnum = mysqli_num_rows($d);
            $p = mysqli_query($db,"select * from patient"); 
            $pnum = mysqli_num_rows($p);
            
            $bd = mysqli_query($db,"select * from bld_donation"); 
            $bdnum = mysqli_num_rows($bd);
            $br = mysqli_query($db,"select * from bld_request"); 
            $brnum = mysqli_num_rows($br);
                ?>
    
            <div class="col-lg-10 m-0 p-0">
                <div class="w-100 text-center p-3 mb-2 border-bottom">
                    <h1 class="text-light">Welcome Admin</h1>
                </div>
                <div class="d-flex">
                    <div class="dbox">
                       <h3><b>Total User : </b><?php echo $unum;?></h3></h3>
                    </div>
                    <div class="dbox">
                        <h3><b>Total Blood Bank : </b><?php echo $bbnum;?></h3>
                    </div>
                    
                </div>
                <div class="d-flex">
                    <div class="dbox">
                        <h3><b>Total Donor : </b><?php echo $dnum;?></h3></h3>
                    </div>
                    <div class="dbox">
                       <h3><b>Total Patient : </b><?php echo $pnum;?></h3></h3>
                    </div>
                </div>
                <div class="d-flex">
                    
                <div class="dbox">
                       <h3><b>Total Blood Donation : </b><?php echo $bdnum;?></h3></h3>
                    </div>
                    <div class="dbox">
                        <h3><b>Total Blood Request : </b><?php echo $brnum;?></h3></h3>
                    </div>
                </div>
                
            </div>
        </div>
    </body>
</html>
