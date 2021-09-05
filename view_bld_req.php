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

<body style="background:url('img/bg5.jpg');  background-size:cover;">
    <?php
    include "header.php"
    ?>
    <div class="container-fluid">
        <div class="row mt-4 mb-5">
            <div class="m-auto col-sm-12">
                <?php
                $userid = $_SESSION['userid'];
                ?>

                <table class="table table-border table-striped table-secondary">
                    <thead class="text-center">
                        <tr>
                            <th colspan="10">
                                <h3>Patient Blood Requests</h3>
                            </th>
                        </tr>
                        <tr>
                            <th>Name</th>
                            <th>Address</th>
                            <th>City</th>
                            <th>Contact</th>
                            <th>Email</th>
                            <th>Blood Type</th>
                            <th>Quntity</th>
                            <th>Date</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $preq = mysqli_query($db, "SELECT * FROM bld_request where bb_userid = '" . $userid . "'");

                        while ($req = mysqli_fetch_array($preq)) {
                            $bbtype = mysqli_query($db, "SELECT * FROM blood_type where bldgrp_val = '" . $req[7] . "'");
                            $typeres = mysqli_fetch_array($bbtype);

                            echo "<tr class='text-center'>
                                        <td>" . $req[2] . "</td>
                                        <td>" . $req[4] . "</td>
                                        <td>" . $req[5] . "</td>
                                        <td>" . $req[3] . "</td>
                                        <td>" . $req[1] . "</td>
                                        
                                        <td>" . $typeres[1] . "</td>
                                        <td>" . $req[8] . "</td>
                                        <td>" . $req[10] . "</td>
                                        <td><form action='' method='post'>";
                            if ($req[9] == "Waiting") {
                                echo "<input type='hidden' value='$req[0]'>
                                            <input type='submit' class='btn btn-success' name='accept$req[0]' value='Accepted'>
                                            <input type='submit' class='btn btn-danger' name='decline$req[0]' value='Declined'>";
                            } else {
                                if ($req[9] == "Accepted") {
                                    echo "<div class='p-1 m-0 bg-success text-light'>" . $req[9] . "</div>";
                                } elseif ($req[9] == "Declined") {
                                    echo "<div class='p-1 m-0 bg-danger text-light'>" . $req[9] . "</div>";
                                }
                            }
                            echo "</form></td>
                                    </tr>";
                        }

                        ?>
                    </tbody>
                </table>

            </div>
        </div>
    </div>
    </div>
    <?php
    include "footer.php"
    ?>


</body>

</html>
<?php
$preq1 = mysqli_query($db, "SELECT * FROM bld_request where bb_userid = '" . $userid . "'");

while ($req = mysqli_fetch_array($preq1)) {
    $bbtype = mysqli_query($db, "SELECT * FROM blood_type where bldgrp_val = '" . $req[7] . "'");
    $typeres = mysqli_fetch_array($bbtype);
    $contact = $req[3];
    $message = "";
        
    if (isset($_POST['accept' . $req[0]])) {
        $bbstock = mysqli_query($db, "select * from blood_stock where bb_userid = '" . $userid . "'");
        while ($bb = mysqli_fetch_array($bbstock)) {
            //  echo  $bb[$typeres[2]] . "<br>";
            $bb_ava_stock = $bb[$typeres[2]];
        }
        
        $pat_stock = $req[8];
//        $pat = mysqli_query($db, "select * from bld_request where bb_userid = '" . $userid . "'");
        //echo "Bbstock ".$bb_ava_stock." patstock".$pat_stock." Bld type".$typeres[2];
        if ($pat_stock > $bb_ava_stock) {
            echo "<script typr='text/javascript'> ";
            echo "confirm('We have Not Enough Stock Available!!!' )";
            echo "</script>";
            
        } else {
            $updstk = $bb_ava_stock - $pat_stock;
            mysqli_query($db, "update blood_stock set $typeres[2] = $updstk where bb_userid = '" . $req[6] . "'");
            $acc = mysqli_query($db, "update bld_request set status = 'Accepted' where req_id = " . $req[0] . "");
            $message = "Your Blood Request is Accpted.You Can Take Blood From Our Blood Bank.";
        
            #Send Notification for request Accepted
            // $number = 8758628731;
            // $url = "www.way2sms.com/api/v1/sendCampaign";
            // $message = urlencode("Your Request Accepted"); #urlencode send message
            // $curl = curl_init();
            // curl_setopt($curl, CURLOPT_PUT,1); #set post data to true
            // curl_setopt($curl, CURLOPT_POSTFIELDS, "apikey-&secret-&usetype-stage&phone-$number&senderid-dhavalkamariya30@gmail.com&message-$message");

            // curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
            // curl_setopt($curl, CURLOPT_URL, $url);
            // curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            // $result = curl_exec($curl);
            // curl_close($curl);
            // echo $result;

            if ($acc) {
                header("Location: view_bld_req.php");
            } else {
                echo "Error";
            }
        }
        
    } else if (isset($_POST['decline' . $req[0]])) {
        $dec = mysqli_query($db, "update bld_request set status = 'Declined' where req_id = " . $req[0] . "");
        $message = "Sorry! Your Request Is Rejected!, Because Our Blood bank has Not Enough Stock Available.";
        if ($dec) {
            header("Location: view_bld_req.php");
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
    //echo $result;
} ?>


<!-- <script lanaguage="text/javascrit">
$(function()
{
    $('[data-toggle="popover"]').popover()
})
$('.popover-dismiss').popover({
    trigger:'focus'
})
</script>
echo"<input type='submit' class='btn btn-success' name='accept' value='Accepted' tabindex='0' data-toggle='popover' data-trigger='hover' title='Dismissible popover' data-content='Enough Stock Not Available'>
                                            <input type='submit' class='btn btn-danger' name='decline' value='Declined'>";
               -->