<?php
    include("config.php");
    ob_start();
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>About us</title>
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

<body>
<?php
include "header.php"
?>

<main id="main">

    <!--==========================
      About Us Section
    ============================-->
    <section id="about">
      <div class="container">
        <div class="row about-container">

          <div class="col-lg-6 content order-lg-1 order-2">
            <h2 class="title">Few Words About Us</h2>
            <p>
            Ensures hospitals have good supply or inventories of blood bags.<br>
List the availability of blood bags at any given time.<br>
Ability to manage the information of its blood donor.<br>
Allows good documentation about the donor and their blood donation activities.<br>
Support fast searching to find match blood bags for the right person<br>
Effectively manage blood camps<br>
And many more...<br>
            </p>
          </div>

          <div class="col-lg-6 background order-lg-2 order-1 wow fadeInRight" style="box-shadow:black 5px 5px 10px;"></div>
        </div>

      </div>
    </section><!-- #about -->
</main>
<?php
  include "footer.php"
  ?>


</body>
</html>