<?php
    include("config.php");
    ob_start();
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Contact us</title>
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
      Contact Section
    ============================-->
    <section id="contact">
      <div class="container wow fadeInUp">
        <div class="section-header">
          <h3 class="section-title">Contact</h3>
          <p class="section-description"></p>
        </div>
      </div>
      <div class="container wow fadeInUp">
        <div class="row justify-content-center">

          <div class="col-lg-3 col-md-4">

            <div class="info">
              <div>
                <i class="fa fa-map-marker"></i>
                <p>Online Blood Bank<br>Gujarat, India</p>
              </div>

              <div>
                <i class="fa fa-envelope"></i>
                <p>onlinebloodbank@gmail.com</p>
              </div>

              <div>
                <i class="fa fa-phone"></i>
                <p>+91 5589 55488 55</p>
              </div>
            </div>
          </div>

          <div class="col-lg-5 col-md-8">
            <form action="" method="post">
            <div class="form-group">
                  <input type="text" name="name" class="form-control" placeholder="Your Name" >
            </div>
            <div class="form-group">
                  <input type="email" class="form-control" name="email"placeholder="Your Email">
                  
                </div>
                <div class="form-group">
                  <input type="text" class="form-control" name="subject" placeholder="Subject">
                 
                </div>
                <div class="form-group">
                  <textarea class="form-control" name="message" rows="5"placeholder="Message"></textarea>
                 </div>
            <div class="form-group">
              <input type="submit" name="submit" value="Send Message" style="
  background: #2dc997;
  border: 0;
  padding: 10px 24px;
  color: #fff;
  transition: 0.4s;"> 
            </div>
                
            </form>
            
          </div>

        </div>

      </div>
    </section><!-- #contact -->

  </main>
<?php
  include "footer.php"
  ?>

<script src="contactform/contactform.js"></script>
  
</body>
</html>

<?php 
  if(isset($_POST['submit'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];
                    
    mysqli_query($db,"insert into contactus values ('','" . $name . "','" . $email . "','" . $subject . "','" . $message . "')");
  }
?>