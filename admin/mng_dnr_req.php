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
    <title></title>
    <style>

    </style>
</head>

<body style="background: url('../img/abg.jpg'); background-size: cover;">
    <?php include "aheader.php" ?>
    <div class="d-flex ">
        <?php include "sidebar.php" ?>
        <div class="col-lg-10 mt-4 m-0 p-0">
            <div class="col-lg-12">

                <table class="table table-border table-striped table-primary">
                    <thead class="text-center">
                        <tr>
                            <th colspan="10">
                                <h3>Manage Donor Request</h3>
                            </th>
                        </tr>
                        <tr>
                        <th>Blood Bank Detail</th>
                        <th colspan="5">Donor Detail</tr>
                        <tr>
                            <th>Blood Bank</th>
                            <th>Name</th>
                            <th>City</th>
                            <th>Contact</th>
                            <th>Blood Group</th>
                            <th>Date</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody class='text-center'>
                    <?php
                        $bbdetails = mysqli_query($db,"select * from blood_bank");
                        
                        while($bbres = mysqli_fetch_array($bbdetails))
                        {
                            $dnrreq = mysqli_query($db,"select * from bld_donation where bb_userid = '".$bbres[5]."'");
                            $dnum = mysqli_num_rows($dnrreq);
                            if ($dnum > 0) {
                                echo "<tr><td rowspan=$dnum>".  $bbres[1] .  "<br>".$bbres[3]." <br>". $bbres[4]." </td>";
                            
                                while ($dres = mysqli_fetch_array($dnrreq)) {
                                    echo "<td>".  $dres[2] .  " </td>
                                <td>".  $dres[5] .  " </td>
                                <td>".  $dres[3] .  " </td>
                                <td>".  $dres[6] .  " </td>
                                <td>".  $dres[9] .  " </td>
                                <td><form action='' method='post'>";
                                if ($dres[8] == "Waiting") {
                                    echo "<input type='hidden' value='$dres[0]'>
                                                <input type='submit' class='btn btn-success' name='accept$dres[0]' value='Accepted'>
                                                <input type='submit' class='btn btn-danger' name='decline$dres[0]' value='Declined'>";
                                } else {
                                    if ($dres[8] == "Accepted") {
                                        echo "<div class='p-1 m-0 bg-success text-light'>" . $dres[8] . "</div>";
                                    } elseif ($dres[8] == "Declined") {
                                        echo "<div class='p-1 m-0 bg-danger text-light'>" . $dres[8] . "</div>";
                                    }
                                }
                                echo "</form></td></tr>"
                                ;
                                }
                            }   }

                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>

<?php
$dres1 = mysqli_query($db, "SELECT * FROM bld_donation");
while ($res = mysqli_fetch_array($dres1)) {
    #Getting Blood Type
    $message = "";
    $bbtype = mysqli_query($db, "SELECT * FROM blood_type where bldgrp_name = '" . $res[6] . "'");
    $typeres = mysqli_fetch_array($bbtype);
    $bbid = $res[7];
    $contact = $res[3];
    #if Request Accept Upgrade Stock and Status
    if (isset($_POST['accept' . $res[0]])) {
        $bbstock = mysqli_query($db, "select * from blood_stock where bb_userid = '" . $res[7] . "'");
        while ($bb = mysqli_fetch_array($bbstock)){
            $bb_ava_stock = $bb[$typeres[2]];
            echo $bb_ava_stock."<br>";
        }
        $updstk = $bb_ava_stock + 1;
        echo $typeres[2]."  ".$updstk;
        $updres = mysqli_query($db,"update blood_stock set $typeres[2] ='". $updstk."' where bb_userid ='". $res[7]."'");
        echo $updres;    
            $acc = mysqli_query($db, "update bld_donation set status = 'Accepted' where dnt_id = " . $res[0] . "");
                    // Data for text message. This is the text message data.
        $message = "Your Blood Request is Accpted.You Can Donate Blood At Our Blood Bank.";

            if ($acc) {
                header("Location: mng_dnr_req.php");
            } else {
                echo "Error";
            }
    #if Request Decline Upgrade Status  
    } else if (isset($_POST['decline' . $res[0]])) {
        $dec = mysqli_query($db, "update bld_donation set status = 'Declined' where dnt_id = " . $res[0] . "");
        // Data for text message. This is the text message data.
        $message = "Sorry, Your Blood Request is Declined, Beacuse We have Enough Stock.";
        
        if ($dec) {
            header("Location: mng_dnr_req.php");
        } else {
            echo "Error";
        }
    }

     // Authorisation details.
     $username = "dhavalkamariya30@gmail.com";
     $hash = "4d31d8e22691073194abfe230fa79061fce111ffb079e3bd29f40fb7cc749f81";

     // Config variables. Consult http://api.textlocal.in/docs for more info.
     $test = "0";

     
     $sender = "BBMS"; // This is who the message appears to be from.
     $number = $contact;
     $numbers = "6353734183"; // A single number or a comma-seperated list of numbers
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
     //echo $result.$contact;

} ?>

