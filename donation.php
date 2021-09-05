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

<body style="background:url('img/bg2.jpg'); background-size:cover;">
    <?php
    include "header.php"
    ?>
    <?php
    $userid = $_SESSION['userid'];

    ?>
    <div class="container-fluid">
        <div class="row mt-3 mb-5">
            <div class="m-auto col-sm-12">
                <?php
                $userid = $_SESSION['userid'];
                $mydon = mysqli_query($db, "SELECT * FROM bld_donation where d_userid = '" . $userid . "'");
                $num = mysqli_num_rows($mydon);
                if ($num > 0) {
                ?>
                    <table class="table table-border table-primary table-striped">
                        <thead class="text-center">
                            <tr>
                                <th colspan="10">
                                    <h3>My Blood Donation</h3>
                                </th>
                            </tr>
                            <tr>
                                <th>Blood Bank</th>
                                <th>Address</th>
                                <th>City</th>
                                <th>Contact</th>
                                <th>Email</th>
                                <th>Blood Type</th>
                                <th>Date</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            while ($res = mysqli_fetch_array($mydon)) {
                                $bbdetail = mysqli_query($db, "SELECT * FROM blood_bank where bb_userid = '" . $res[7] . "'");
                                $bbres = mysqli_fetch_array($bbdetail);

                                echo "<tr class='text-center'>
                                        <td>" . $bbres[1] . "</td>
                                        <td>" . $bbres[3] . "</td>
                                        <td>" . $bbres[4] . "</td>
                                        <td>" . $bbres[2] . "</td>
                                        <td>" . $bbres[5] . "</td>
                                        
                                        <td>" . $res[6] . "</td>
 
                                        <td>" . $res[9] . "</td>
                                        <td><div class='p-1 text-light ";
                                if ($res[8] == "Waiting") {
                                    echo "bg-warning";
                                } else if ($res[8] == "Accepted") {
                                    echo "bg-success";
                                } else if ($res[8] == "Declined") {
                                    echo "bg-danger";
                                }
                                echo "'>" . $res[8] . "</div></td>

                                    </tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                <?php
                }
                ?>
            </div>
        </div>
        <div class="row mt-3 mb-3 text-center">
            <div class="m-auto col-sm-6">
                <h2 class="text-light">Search Blood Bank</h2>
                <form action="" method="post">
                    <div class="form-group">
                        <select name="city" class="form-control">
                            <option value="city" disabled selected>--Select City--</option>
                            <?php
                            $cityname = mysqli_query($db, "SELECT * FROM city");

                            echo $res;
                            while ($res = mysqli_fetch_array($cityname)) {
                                echo "<option name=''> $res[1]</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-success form-control" name="search" value="Search">
                    </div>
                </form>
            </div>
        </div>
        <?php
        if (isset($_POST['search'])) {
        ?>
            <div class="row mt-3 mb-5">
                <div class="m-auto col-sm-10">
                    <table class="table table-border table-striped table-warning">
                        <thead class="text-center">
                            <tr>
                                <th colspan="6">
                                    <h3>List of Blood Bank</h3>
                                </th>
                            </tr>
                            <tr>
                                <th>Name</th>
                                <th>Contact</th>
                                <th>Address</th>
                                <th>City</th>
                                <th>Email</th>
                                <th>Add New Dontaion</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $bbdetails = mysqli_query($db, "SELECT * FROM blood_bank where bb_city = '" . $_POST['city'] . "'");
                            while ($res = mysqli_fetch_array($bbdetails)) {
                                echo "<tr class='text-center'>
                    <td>" . $res[1] . "</td>
                    <td>" . $res[2] . "</td>
                    <td>" . $res[3] . "</td>
                    <td>" . $res[4] . "</td>
                    <td>" . $res[5] . "</td>
                    <td>
                    <form action='' method='post'>
                    <input type='hidden' name='city' value='$res[3]'>
                    <input type='submit' name='add$res[7]' value='Add' class='btn btn-primary'>
                    </form>
                    </td>
                    </tr>";
                                // echo $_POST['add'.$res[5]];

                            ?>

                            <?php
                            }
                            ?>

                        </tbody>
                    </table>
                </div>
            </div>
        <?php
        }
        ?>
    </div>

    <?php
    include "footer.php"
    ?>
</body>

</html>

<?php

$bbdetail1 = mysqli_query($db, "SELECT * FROM blood_bank");
while ($res = mysqli_fetch_array($bbdetail1)) {
    if (isset($_POST['add' . $res[7]])) {
        $ddetails = mysqli_query($db, "SELECT * FROM donor WHERE d_userid = '$userid'");
        $dres = mysqli_fetch_array($ddetails);
        $status = "Waiting";
        $date = date("Y-m-d");

        $dins = mysqli_query($db, "insert into bld_donation values('' ,'" . $userid . "','" . $dres[1] . "'," . $dres[2] . ",'" . $dres[3] . "','" . $dres[4] . "','" . $dres[7] . "','" . $res[5] . "','" . $status . "','" . $date . "')");
        if ($dins) {
            header("Loaction: donation.php");
        } else {
            echo "Error";
        }

        // $lastdate = mysqli_query($db, "SELECT * FROM bld_donation where d_userid = $userid and dnt_id=(SELECT max(dnt_id) FROM bld_donation))");
        // $ldate = mysqli_fetch_array($lastdate);
        // echo $ldate[9];
        // //echo $last_d_date;
        
    }
}
?>