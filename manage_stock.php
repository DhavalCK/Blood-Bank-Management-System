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
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <link href="lib/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <style>
    table,th,tr{
        border:1px solid black;
    }</style>
</head>

<body style="background:url('img/bg10.jpg');  background-size:cover;">
    <?php
    include "header.php"
    ?>

    <div class='conainer p-5'>
        <?php
        $id = $_SESSION['userid'];
        $stock = mysqli_query($db, "SELECT * FROM blood_stock WHERE bb_userid = '$id'");
        $res = mysqli_fetch_array($stock);
        $bb_detail = mysqli_query($db, "SELECT * FROM blood_bank WHERE bb_userid = '$id'");
        $bbres = mysqli_fetch_array($bb_detail);
        $bbname = $bbres['bb_name'];

        if ($res) {
            #For Show Table Of Blood Stock
            echo "<div class='row'>
            <div class='col-lg-6 m-auto'>
                <h2 class='text-center' style='color:white;'>View/Update Stock Details</h2>
            </div>
        </div>
        <div class='row'>
            <div class='col-lg-8 m-auto'>
                <table class='table text-center table-bordered table-info' style='box-shadow: #7ec5ef 5px 5px 10px;'>
                    
                    <thead class='thead-dark'>
                    <tr>
                        <th class='text-center'>Blood Type</th>
                        <th class='text-center'>Quantity</th>
                        <th class='text-center'>Enter Stock</th>
                        <th class='text-center'>Add</th>
                        <th class='text-center'>Sub</th>
                    </tr>
                    </thead>
                    <form method='post'>
                    <tbody >
                    "; ?><?php
                        $get_blood = mysqli_query($db, "select * from blood_type");
                        $i = 0;
                        while ($get_blood_res = mysqli_fetch_array($get_blood)) {
                            echo "<tr>
                        <td>" . $get_blood_res[1] . "</td>
                        <td>" . $res[$get_blood_res[2]] . "</td>
                        <td class='p-0'><input type='number' class='w-100 text-center' name='" . $get_blood_res[2] . "' style='height:50px; background-color:#bee5eb; border:0' value='0'></td>
                        <td class=''><input type='submit' name='" . $get_blood_res[2] . "add' class='btn btn-success text-white' value='Add'></td>
                        <td class=''><input type='submit' name='" . $get_blood_res[2] . "sub' class='btn btn-danger text-white' value='Sub'></td>
                    </tr>";
                        }
                        ?>
    <?php 
            echo "</tbody>
                    </form>
                </table>
            </div>
        </div>";
        } else {
            #First Time Add Blood Stock
            echo "
        <div class='row'>
            <div class='col-lg-5 m-auto center '>
            <form action='' id='AddStock' method='post' class='border border-dark p-3 bg-light' name='formstock' role='form'>
                <div class='form-group'>
                    <legend class='title text-center fs-30 mb-10'>Enter Stock Details</legend>
                </div>
                <hr>
                <div class='d-flex'>
                    <div class='form-group col-sm-2 text-center m-auto'>
                        <label for='A+'>A+</label>
                    </div>    
                    <div class='form-group col-sm-10'> 
                        <input type='number' name='A+' value='0' class='form-control border-primary'>
                    </div>
                </div>
                <div class='d-flex'>
                    <div class='form-group col-sm-2 text-center m-auto'>
                        <label for='B+'>B+</label>
                    </div>    
                    <div class='form-group col-sm-10'> 
                        <input type='number' name='B+' value='0' class='form-control border-primary'>
                    </div>
                </div>
                <div class='d-flex'>
                    <div class='form-group col-sm-2 text-center m-auto'>
                        <label for='AB+'>AB+</label>
                    </div>    
                    <div class='form-group col-sm-10 text-center'> 
                        <input type='number' name='AB+' value='0' class='form-control border-primary'>
                    </div>
                </div>
                <div class='d-flex'>
                    <div class='form-group col-sm-2 text-center m-auto'>
                        <label for='O+'>O+</label>
                    </div>    
                    <div class='form-group col-sm-10'> 
                        <input type='number' name='O+' value='0' class='form-control border-primary'>
                    </div>
                </div>
                <div class='d-flex'>
                    <div class='form-group col-sm-2 text-center m-auto'>
                        <label for='A-'>A-</label>
                    </div>    
                    <div class='form-group col-sm-10'> 
                        <input type='number' name='A-' value='0' class='form-control border-primary'>
                    </div>
                </div>
                <div class='d-flex'>
                    <div class='form-group col-sm-2 text-center m-auto'>
                        <label for='B-'>B-</label>
                    </div>    
                    <div class='form-group col-sm-10'> 
                        <input type='number' name='B-' value='0' class='form-control border-primary'>
                    </div>
                </div>
                <div class='d-flex'>
                    <div class='form-group col-sm-2 text-center m-auto'>
                        <label for='AB-'>AB-</label>
                    </div>    
                    <div class='form-group col-sm-10'> 
                        <input type='number' name='AB-' value='0' class='form-control border-primary'>
                    </div>
                </div>
                <div class='d-flex'>
                    <div class='form-group col-sm-2 text-center m-auto'>
                        <label for='O-'>O-</label>
                    </div>    
                    <div class='form-group col-sm-10'> 
                        <input type='number' name='O-' value='0' class='form-control border-primary'>
                    </div>
                </div>
                <div class='d-flex'>
                <div class='form-group col-sm-6'>
                <input type='submit' name='add_stock' value='Add' class='form-control btn-success'>
                </div>
                <div class='form-group col-sm-6'>
                <input type='reset' name='clear' value='Clear' class='form-control btn-danger'>
                </div>
                </div>
            </form>
            </div>
        </div>";
        }
    ?>
    </div>
    <?php
    #insert stock value into blood_stock table 
    if (isset($_POST['add_stock'])) {
        $sql = "INSERT INTO blood_stock VALUES ('" . $id . "','" . $bbname . "'," . $_POST['A+'] . "," . $_POST['B+'] . "," . $_POST['AB+'] . "," . $_POST['O+'] . "," . $_POST['A-'] . "," . $_POST['B-'] . "," . $_POST['AB-'] . "," . $_POST['O-'] . ")";
        mysqli_query($db, $sql);
        header("Location: manage_stock.php");
    }
    #update value of particular stock
    $get_blood = mysqli_query($db, "select * from blood_type");
    while ($get_blood_res = mysqli_fetch_array($get_blood)) {
        if (isset($_POST[$get_blood_res[2] . "add"])) {
            $new = $_POST[$get_blood_res[2]];
            $sql = "UPDATE blood_stock SET " . $get_blood_res[2] . " = (" . $res[$get_blood_res[2]] . " + $new) WHERE bb_userid = '" . $id . "' ";
            $s1 = mysqli_query($db, $sql);
            header("Location: manage_stock.php");
        } else if (isset($_POST[$get_blood_res[2] . "sub"])) {
            $new = $_POST[$get_blood_res[2]];
            $sql = "UPDATE blood_stock SET ".$get_blood_res[2]." = (".$res[$get_blood_res[2]]." - $new) WHERE bb_userid = '" . $id . "' ";
            $s1 = mysqli_query($db, $sql);
            header("Location: manage_stock.php");
        }
    }
    
    function stk_alert()
    {
        echo "
                <div class='alert alert-danger alert-dismissible fade show' role='alert'>
                Please Enter Less or Equal stock than present Stock.
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                        <span aria-hidden='true'>&times;</span>
                    </button>
                </div>";
    }
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