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
        fieldset {
    border: 1px solid rgb(19, 1, 1); 
    border-radius: 4px;
    padding: 20px;
    padding-left: 40px;
    background: #fbfbfb;
}
legend {
   color: rgb(79, 87, 95);
   font-weight: 1000;
   border-bottom: 2px solid rgb(190, 181, 181);
   
}

.title{
    margin-bottom: 20px;
    
}
.form-control {
    width: 95%;
}
.reg_f{
    border: 1px solid rgb(19, 1, 1); 
    border-radius: 4px;
    padding: 20px;
    padding-left: 40px;
    background-color:aliceblue;  
}
    </style>
    <!-- <link href="../css/reg_style.css" rel="stylesheet"> -->
</head>

<body style="background: url('../img/abg.jpg'); background-size: cover;">
    <?php include "aheader.php" ?>
    <div class="d-flex ">
        <?php include "sidebar.php" ?>
        <div class="col-lg-10 m-3 p-0">
            <div class="reg_f col-lg-9 m-auto">
                <?php
                $bbid = $_GET['bbid'];
                $bbdtl = mysqli_query($db,"select * from blood_bank where bb_id = $bbid");
                $bbres = mysqli_fetch_array($bbdtl);
                ?>
                <form action="" method="post" id="fileForm" role="form" class="m-auto w-75">
                    <legend class="title text-center fs-30 mb-10">Update Details</legend>

                    <div class="form-group">
                        <label for="name"><span class="req">* </span> Name: </label>
                        <input class="form-control border-primary" type="text" name="name" value="<?php echo $bbres[1];?>" id="txt" onkeyup="nameValidate(this)"  required />
                    </div>

                    <div class="form-group">
                        <label for="phonenumber"><span class="req">* </span> Contact: </label>
                        <input required type="text" name="contact" value="<?php echo $bbres[2];?>" id="phone" class="form-control border-primary phone" maxlength="10" onkeyup="validatephone(this);" placeholder="Enter Phone Number" />
                    </div>

                    <div class="form-group">
                        <label for="address"><span class="req">* </span> Address: </label>
                        <input class="form-control border-primary" type="text" name="address" value="<?php echo $bbres[3];?>" id="txt" placeholder="Address..." required />
                        <div class="statusAdd" id="statusAdd"></div>
                    </div>

                    <div class="form-group">
                        <label for="city"><span class="req">* </span> City: </label>
                        <select name="city" class="form-control border-primary" required>
                            <?php
                            $cityname = mysqli_query($db, "SELECT * FROM city");

                            while ($res = mysqli_fetch_array($cityname)) {
                                echo "<option name='' value='$res[1]' ";
                                if($bbres[4]==$res[1])
                                {
                                    echo "selected";
                                }
                                echo "> $res[1]</option>";
                            }
                            ?>
                        </select>
                    </div>
                    
        
                    <div class="form-group mt-4" >
                        <div class="d-inline">
                            <input class="btn btn-primary w-100 px-4 py-2" type="submit" name="update" value="Update">
                        </div>
                        
                    </div>
                </form><!-- ends register form -->
            </div>
        </div>
    </div>
</body>

</html>
<?php
if($_POST['update'])
{   
    $name = $_POST['name'];
    $contact = $_POST['contact'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $sql = "update blood_bank set bb_name = '".$name."', bb_contact = '".$contact."', bb_add = '".$address."', bb_city = '".$city."' where bb_id= $bbid";          
  
    mysqli_query($db,$sql);
}
?>