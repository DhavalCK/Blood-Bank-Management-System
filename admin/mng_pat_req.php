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
                                <h3>Manage Blood Request</h3>
                            </th>
                        </tr>
                        <tr>
                            <th>Blood Bank Detail</th>
                            <th colspan="5">Patient Detail</th>
                        </tr>
                        <tr>
                            <th>Blood Bank</th>
                            <th>Name</th>
                            <th>City</th>
                            <th>Contact</th>
                            <th>Blood Group</th>
                            <th>Quntity</th>
                            <th>Date</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody class='text-center'>
                    <?php
                        $bbdetails = mysqli_query($db,"select * from blood_bank");
                        
                        while ($bbres = mysqli_fetch_array($bbdetails)) {
                            $patreq = mysqli_query($db, "select * from bld_request where bb_userid = '".$bbres[5]."'");
                            $pnum = mysqli_num_rows($patreq);
                            if ($pnum > 0) {
                                echo "<tr><td rowspan=$pnum>".  $bbres[1] .  "<br>".$bbres[3]." <br>". $bbres[4]." </td>";
                            
                                while ($pres = mysqli_fetch_array($patreq)) {
                                    $bbtype = mysqli_query($db, "SELECT * FROM blood_type where bldgrp_val = '" . $pres[7] . "'");
                                    $typeres = mysqli_fetch_array($bbtype);

                                    echo "<td>".  $pres[2] .  " </td>
                                <td>".  $pres[5] .  " </td>
                                <td>".  $pres[3] .  " </td>
                                <td>".  $typeres[1] .  " </td>
                                <td>".  $pres[8] .  " </td>
                                <td>".  $pres[10] .  " </td>
                                <td><form action='' method='post'>";
                                    if ($pres[9] == "Waiting") {
                                        echo "<input type='hidden' value='$pres[0]'>
                                                <input type='submit' class='btn btn-success' name='accept$pres[0]' value='Accepted'>
                                                <input type='submit' class='btn btn-danger' name='decline$pres[0]' value='Declined'>";
                                    } else {
                                        if ($pres[9] == "Accepted") {
                                            echo "<div class='p-1 m-0 bg-success text-light'>" . $pres[9] . "</div>";
                                        } elseif ($pres[9] == "Declined") {
                                            echo "<div class='p-1 m-0 bg-danger text-light'>" . $pres[9] . "</div>";
                                        }
                                    }
                                    echo "</form></td></tr>"
                                ;
                                }
                            }
                        }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>

<?php
$preq1 = mysqli_query($db, "SELECT * FROM bld_request");

while ($req = mysqli_fetch_array($preq1)) {
    $bbtype = mysqli_query($db, "SELECT * FROM blood_type where bldgrp_val = '" . $req[7] . "'");
    $typeres = mysqli_fetch_array($bbtype);
    $bbid = $req[6];
    $contact = $req[3];
    $message ="";
    if (isset($_POST['accept' . $req[0]])) {
        $bbstock = mysqli_query($db, "select * from blood_stock where bb_userid = '" . $req[6] . "'");
        while ($bb = mysqli_fetch_array($bbstock)) {
          //  echo  $bb[$typeres[2]] . "<br>";
            $bb_ava_stock = $bb[$typeres[2]];
        }
        
        $pat_stock = $req[8];
        //echo "Bbstock ".$bb_ava_stock." patstock".$pat_stock." Bld type".$typeres[2];
        if ($pat_stock > $bb_ava_stock) {
            echo "<script typr='text/javascript'> ";
            echo "confirm('We have Not Enough Stock Available!!!' )";
            echo "</script>";
        } else {
            $updstk = $bb_ava_stock - $pat_stock;
            mysqli_query($db,"update blood_stock set $typeres[2] = $updstk where bb_userid = '".$req[6]."'");
            $acc = mysqli_query($db, "update bld_request set status = 'Accepted' where req_id = " . $req[0] . "");
            $message = "Your Blood Request is Accpted.You Can Take Blood From Our Blood Bank.";
        
            if ($acc) {
                header("Location: mng_pat_req.php");
            } else {
                echo "Error";
            }
        }
        
    } else if (isset($_POST['decline' . $req[0]])) {
        $dec = mysqli_query($db, "update bld_request set status = 'Declined' where req_id = " . $req[0] . "");
        $message = "Sorry! Your Request Is Rejected!, Because Our Blood bank has Not Enough Stock Available.";
        if ($dec) {
            header("Location: mng_pat_req.php");
        } else {
            echo "Error";
        }
    }
    // Authorisation details.
    $username = "dhavalkamariya30@gmail.com";
    $hash = "4d31d8e22691073194abfe230fa79061fce111ffb079e3bd29f40fb7cc749f81";

    // Config variables. Consult http://api.textlocal.in/docs for more info.
    $test = "0";

    // Data for text message. This is the text message data.
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
//    echo $result;
} ?>

