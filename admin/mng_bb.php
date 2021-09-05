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
        <div class="col-lg-10 mt-4 p-0">
            <div class="col-lg-12">

                <table class="table table-border table-striped table-light">
                    <thead class="text-center">
                        <tr>
                            <th colspan="10">
                                <h3>Manage Blood Bank Information</h3>
                            </th>
                        </tr>
                        <tr>
                            <th>Name</th>
                            <th>Contact</th>
                            <th>Address</th>
                            <th>City</th>
                            <th>Email</th>
                            <th colspan="2">Operation</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $bbdetails = mysqli_query($db, "SELECT * FROM blood_bank");

                        while ($res = mysqli_fetch_array($bbdetails)) {
                            echo "<tr class='text-center'>
                            <td>" . $res[1] . "</td>
                            <td>" . $res[2] . "</td>
                            <td>" . $res[3] . "</td>
                            <td>" . $res[4] . "</td>
                            <td>" . $res[5] . "</td>
                            <form action='' method='post'>
                            <td><a href='edit_bb.php?bbid=$res[7]' class='btn btn-primary'>Edit</a></td>
                            <td><input type='submit' name='delete$res[7]' value='Delete' class='btn btn-danger'></td>
                            </form>
                            <tr>";
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
$bbdetails = mysqli_query($db, "SELECT * FROM blood_bank");
while ($res = mysqli_fetch_array($bbdetails)) {
    if (isset($_POST['delete' . $res[7]])) {
        mysqli_query($db, "delete from blood_bank where bb_id = $res[7]");
        header ("Location: mng_bb.php");
    }
}
?>
<!-- 
echo "<script typr='text/javascript'> ";
            echo "if(confirm('Are You Sure Want To Delete ?')){}";
            echo "</script>"; -->