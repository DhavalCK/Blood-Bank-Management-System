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

<body style="background:url('img/bg15.jpg');  background-size:cover;">
    <?php
    include "header.php"
    ?>
    <div class="container">
        <div class="row mt-3 mb-5">
            <div class="m-auto col-sm-12">
                <?php
                $userid = $_SESSION['userid'];
                $myreq = mysqli_query($db, "SELECT * FROM bld_request where p_userid = '" . $userid . "'");
                $num = mysqli_num_rows($myreq);
                if ($num > 0) {
                ?>

                    <table class="table table-border table-striped table-primary">
                        <thead class="text-center">
                            <tr>
                                <th colspan="10">
                                    <h3>My Blood Requests</h3>
                                </th>
                            </tr>
                            <tr>
                                <th>Blood Bank</th>
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
                            while ($req = mysqli_fetch_array($myreq)) {
                                $bbdetail = mysqli_query($db, "SELECT * FROM blood_bank where bb_userid = '" . $req[6] . "'");
                                $bbres = mysqli_fetch_array($bbdetail);
                                $bbtype = mysqli_query($db, "SELECT * FROM blood_type where bldgrp_val = '" . $req[7] . "'");
                                $typeres = mysqli_fetch_array($bbtype);
                                
                                echo "<tr class='text-center'>
                                        <td>" . $bbres[1] . "</td>
                                        <td>" . $bbres[3] . "</td>
                                        <td>" . $bbres[4] . "</td>
                                        <td>" . $bbres[2] . "</td>
                                        <td>" . $bbres[5] . "</td>
                                        
                                        <td>" . $typeres[1] . "</td>

                                        <td>" . $req[8] . "</td>
                                        <td>" . $req[10] . "</td>
                                        <td><div class='p-1 text-light ";if($req[9]=="Waiting"){echo"bg-warning";} else if($req[9]=="Accepted"){echo"bg-success";} else if($req[9]=="Declined"){echo"bg-danger";} 
                                        echo "'>". $req[9] . "</div></td>

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
                                    <h3>Available Blood Bank</h3>
                                </th>
                            </tr>
                            <tr>
                                <th>Name</th>
                                <th>Contact</th>
                                <th>Address</th>
                                <th>City</th>
                                <th>Email</th>
                                <th>Request</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $cityname = mysqli_query($db, "SELECT * FROM blood_bank where bb_city = '" . $_POST['city'] . "'");
                            while ($res = mysqli_fetch_array($cityname)) {
                                echo "<tr class='text-center'>
                    <td>" . $res[1] . "</td>
                    <td>" . $res[2] . "</td>
                    <td>" . $res[3] . "</td>
                    <td>" . $res[4] . "</td>
                    <td>" . $res[5] . "</td>
                    <td><button type='button' class='btn btn-primary' data-toggle='modal' data-target='#exampleModal'>
                    Send Request
                        </button></td>
                    </tr>";
                            ?>
                                <!-- Request Model -->
                                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Fill Up Details</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form action="" class="text-left" method="post">
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label for="blood_grp"><span class=" req">* </span> Blood Group: </label>
                                                        <select name="b_grp" class="form-control border-primary" required>
                                                            <option value="bld_grp" disabled selected>--Select Blood Group--</option>
                                                            <?php
                                                            $bldtype = mysqli_query($db, "SELECT * FROM blood_type");

                                                            while ($resbt = mysqli_fetch_array($bldtype)) {
                                                                echo "<option value=" . $resbt[2] . "> $resbt[1]</option>";
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="bld_stock"><span class=" req">* </span> Blood Stock: </label>
                                                        <input type="number" class="form-control border-primary" name="stock" required>
                                                    </div>
                                                    <input type="hidden" name="bb_userid" value="<?php echo $res[5]; ?>">

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <input type="submit" name="send" class="btn btn-primary" value="Send">
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            <?php
                            } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        <?php
        }
        ?>
    </div>

    <?php
    if (isset($_POST['send'])) {
        $p_userid = $_SESSION['userid'];
        $pdetails = mysqli_query($db, "SELECT * FROM patient WHERE p_userid = '$p_userid'");
        $res = mysqli_fetch_array($pdetails);

        $p_name = $res[1];
        $p_contact = $res[2];
        $p_add = $res[3];
        $p_city = $res[4];
        $bb_userid = $_POST['bb_userid'];
        $bld_grp = $_POST['b_grp'];
        $bld_stock = $_POST['stock'];
        $status = "Waiting";
        $date = date("Y-m-d");
        $sql = "INSERT INTO bld_request VALUES ('' ,'" . $p_userid . "','" . $p_name . "'," . $p_contact . ",'" . $p_add . "','" . $p_city . "','" . $bb_userid . "','" . $bld_grp . "'," . $bld_stock . ",'" . $status . "','" . $date . "')";
        $retval = mysqli_query($db, $sql);
        if ($retval) {
            header("Location: make_request.php");
        } else {
            echo "Error";
        }
    }
    include "footer.php"
    ?>


</body>

</html>