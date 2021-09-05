<?php
include("config.php");
ob_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Registration</title>
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
    <link href="css/reg_style.css" rel="stylesheet">
</head>

<body style="background-image:linear-gradient(to right,red,white,red);">
    <?php
    include "header.php"
    ?>
    <div class="container r1 mb-5">
        <div class="reg_f col m-auto w-75" style="box-shadow:black 3px 3px 5px">

            <form action="reg.php" method="post" id="fileForm" role="form" class="m-auto w-75">
                <legend class="title text-center fs-30 mb-10">Register Here!</legend>

                <div class="form-group">
                    <label for="role" class="d-block">Registration For</label>

                    <div class="d-inline p-2"><input type="radio" name="role" value="Donor" id="donor" onclick="reg_user()" checked></div>
                    <div class="d-inline pr-3">Donor</div>
                    <div class="d-inline p-2"><input type="radio" name="role" value="Patient" id="patient" onclick="reg_user()"></div>
                    <div class="d-inline pr-3">Patient</div>
                    <div class="d-inline p-2"><input type="radio" name="role" value="BloodBank" id="blood_bank" onclick="reg_user()"></div>
                    <div class="d-inline pr-3">Blood Bank</div>
                </div>
                <div class="form-group">
                    <label for="name"><span class="req">* </span> Name: </label>
                    <input class="form-control border-primary" type="text" name="name" id="txt" onkeyup="nameValidate(this)" placeholder="Name" required />
                    <!-- <div id="errFirst"></div>     -->
                </div>

                <div class="form-group">
                    <label for="phonenumber"><span class="req">* </span> Contact: </label>
                    <input required type="text" name="contact" id="phone" class="form-control border-primary phone" maxlength="10" onkeyup="validatephone(this);" placeholder="Enter Phone Number" />
                </div>

                <div class="form-group">
                    <label for="address"><span class="req">* </span> Address: </label>
                    <input class="form-control border-primary" type="text" name="address" id="txt" placeholder="Address..." required />
                    <div class="statusAdd" id="statusAdd"></div>
                </div>

                <div class="form-group">
                    <label for="city"><span class="req">* </span> City: </label>
                    <select name="city" class="form-control border-primary" required>
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
                <div class="form-group non_b_bank">
                    <label for="age"><span class="req">* </span> Age: </label>
                    <input class="form-control border-primary" required type="number" name="age" id="number" placeholder="Age" value="18" />
                </div>
                <div class="form-group non_b_bank">
                    <label class="d-block" for="gender"><span class="req">* </span> Gender: </label>
                    <div class="d-inline p-2"><input type="radio" name="gender" value="Male" id="male" checked></div>
                    <div class="d-inline pr-3">Male</div>
                    <div class="d-inline p-2"><input type="radio" name="gender" value="Female" id="female"></div>
                    <div class="d-inline pr-3">Female</div>
                </div>
                <div class="form-group non_b_bank">
                    <label for="blood_grp"><span class=" req">* </span> Blood Group: </label>
                    <select name="b_grp" class="form-control border-primary" required>
                        <option value="city" disabled selected>--Select Blood Group--</option>
                        <?php
                        $cityname = mysqli_query($db, "SELECT * FROM blood_type");

                        echo $res;
                        while ($res = mysqli_fetch_array($cityname)) {
                            echo "<option value=" . $res[1] . "> $res[1]</option>";
                        }
                        ?>
                    </select>
                </div>

                <!-- <div class="form-group non_b_bank">
                    <label for="blood_grp"><span class=" req">* </span> Blood Group: </label>
                    <select name="b_grp" class="form-control border-primary">
                        <option value="A+" selected>A+</option>
                        <option value="B+">B+</option>
                        <option value="AB+">AB+</option>
                        <option value="O+">O+</option>
                        <option value="A-">A-</option>
                        <option value="B-">B-</option>
                        <option value="AB-">AB-</option>
                        <option value="O-">O-</option>

                    </select>
                </div> -->

                <div class="form-group">
                    <label for="email"><span class="req">* </span> Email Address: <small>This will be your login user id</small></label>
                    <input class="form-control border-primary" required type="text" name="email" id="email" onchange="email_validate(this.value);" placeholder="Email" />
                    <div class="status" id="status"></div>
                </div>

                <!-- <div class="form-group">
                <label for="username"><span class="req">* </span> User ID:  <small>This will be your login user id</small> </label> 
                    <input class="form-control border-primary" type="text" name="userid" id = "txt" onkeyup = "userValidate(this)" placeholder="minimum 6 letters" required />  
                        <div id="errLast"></div>
            </div> -->

                <div class="form-group">
                    <label for="password"><span class="req">* </span> Password: </label>
                    <input required name="password" type="password" class="form-control border-primary inputpass" placeholder="Password" minlength="4" maxlength="16" id="pass1" /> </p>
                    <div class="pstatus" id="pstatus"></div>
                    <label for="password"><span class="req">* </span> Password Confirm: </label>
                    <input required name="password" type="password" class="form-control border-primary inputpass" minlength="4" maxlength="16" placeholder="Enter again to validate" id="pass2" onkeyup="checkPass(); return false;" />
                    <span id="confirmMessage" class="confirmMessage"></span>
                </div>


                <div class="form-group mt-4">
                    <div class="d-inline mr-5">
                        <input class="btn btn-success px-4 py-2" type="submit" name="submit_reg" value="Submit">
                    </div>
                    <div class="d-inline mr-5">
                        <input class="btn btn-danger px-4 py-2" type="reset" name="reset_reg" value="Reset">

                    </div>
                </div>
            </form><!-- ends register form -->
        </div>
    </div>
    <?php
    include "footer.php"
    ?>
    <script src="js/reg_js.js"></script>
    <script type="text/javascript">
        function email_validate(email) {
            var status = document.getElementById("status");
            regMail = /^([a-zA-z0-9\.-]+)@([a-zA-z0-9-]+).([a-zA-z]{2,3}){1}$/;
            if (regMail.test(email)) {
                status.innerHTML = "<span class='valid'>Thanks, you have entered a valid Email address!</span>";
                status.style.color = "green";
            } else {
                status.innerHTML = "<span class='warning'>Email address is not valid yet.</span>";
                status.style.color = "red";

            }

        }
    </script>

</body>

</html>
<?php
if (isset($_POST['submit_reg'])) {
    $check_email = $_POST['email'];
    $result = mysqli_query($db, "SELECT * FROM user WHERE userid = '$check_email'");
    $num = mysqli_num_rows($result);
    if ($num == 0) {
        $role = $_POST['role'];
        if ($role == 'Donor') {
            $name = $_POST['name'];
            $contact = $_POST['contact'];
            $address = $_POST['address'];
            $city = $_POST['city'];
            $age = $_POST['age'];
            $gender = $_POST['gender'];
            $b_grp = $_POST['b_grp'];
            $email = $_POST['email'];
            $pwd = $_POST['password'];
            $sql = "INSERT INTO donor VALUES ('" . $role . "','" . $name . "'," . $contact . ",'" . $address . "','" . $city . "'," . $age . ",'" . $gender . "','" . $b_grp . "','" . $email . "','" . $pwd . "')";
            mysqli_query($db, $sql);
            $sqluser = "INSERT INTO user VALUES ('" . $role . "','" . $email . "','" . $pwd . "')";
            $a = mysqli_query($db, $sqluser);
            echo $a;
        } elseif ($role == 'Patient') {
            $name = $_POST['name'];
            $contact = $_POST['contact'];
            $address = $_POST['address'];
            $city = $_POST['city'];
            $age = $_POST['age'];
            $gender = $_POST['gender'];
            $b_grp = $_POST['b_grp'];
            $email = $_POST['email'];
            $pwd = $_POST['password'];
            $sql = "INSERT INTO patient VALUES ('" . $role . "','" . $name . "'," . $contact . ",'" . $address . "','" . $city . "'," . $age . ",'" . $gender . "','" . $b_grp . "','" . $email . "','" . $pwd . "')";
            mysqli_query($db, $sql);
            $sqluser = "INSERT INTO user VALUES ('" . $role . "','" . $email . "','" . $pwd . "')";
            $a = mysqli_query($db, $sqluser);
            echo $a;
        } elseif ($role == 'BloodBank') {
            $name = $_POST['name'];
            $contact = $_POST['contact'];
            $address = $_POST['address'];
            $city = $_POST['city'];
            $email = $_POST['email'];
            $pwd = $_POST['password'];
            $sql = "INSERT INTO blood_bank VALUES ('" . $role . "','" . $name . "'," . $contact . ",'" . $address . "','" . $city . "','" . $email . "','" . $pwd . "','')";
            mysqli_query($db, $sql);
            $sqluser = "INSERT INTO user VALUES ('" . $role . "','" . $email . "','" . $pwd . "')";
            $a = mysqli_query($db, $sqluser);
            echo $a;
            echo "in blood babk";
        } else {
            echo "Type Not Found";
        }
        //echo "in submit";
        header("Location: login.php");
    } else {
?>
        <script>
            alert("This email has alredy Account.");
        </script>
<?php
    }
} //end of submit_reg

?>