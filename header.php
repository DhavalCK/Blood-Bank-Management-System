<?php 
// $user = mysqli_query($db,"select * from user");
// $num = mysqli_num_rows($user);
// echo $num;
// while ($ures == mysqli_fetch_array($user)) {
//     echo $ures[1];
//     if ($_SESSION['userid']!=$ures[1]) {
//         header("Location: index.php");
//     }
// }
?>
<div  style="height:15vh; ">
  <header class="position-absolute" id="header"  style="box-shadow: black 2px 2px 10px; background-image:url('img/bg1.jpg'); opacity:1; height:15vh;">
    <div class="container" >

      <div id="logo" class="pull-left">
        <a href="#hero"><img src="img/logo1.jpg" width="50px" alt="" title="" /></img></a>
      </div>

      <nav id="nav-menu-container">
        <ul class="nav-menu">
          <li><a href="index.php">Home</a></li>
          <?php
          if (isset($_SESSION['userid'])) {
              if($_SESSION['utype']=="Donor")
              {
                echo "<li><a href='donation.php'>Add Donation</a></li>";
                echo "<li><a href='profile.php'>My Profile</a></li>";
              }
              else if($_SESSION['utype']=="Patient")
              {
                echo "<li><a href='make_request.php'>Make A Blood request</a></li>";
                echo "<li><a href='profile.php'>My Profile</a></li>";
              }
              else if($_SESSION['utype']=="BloodBank")
              {
                echo "<li><a href='view_bld_req.php'>View Patient Request</a></li>";
                echo "<li><a href='view_bld_dnr.php'>View Donor List</a></li>";
                echo "<li><a href='manage_stock.php'>Manage Stock</a></li>";
                echo "<li><a href='profile.php'>My Profile</a></li>";
              }
          }
          else
          {
              echo "<li><a href='reg.php'>Registration</a></li>";
              echo "<li><a href='login.php?msg=nothing'>Login</a></li>";
              // echo "<li><a href='adminlogin.php'>Admin Panel</a></li>";
              // echo "<li><a href='camps.php'>Camps</a></li>";
          }
          ?>
          <li><a href="about.php">About US</a></li>
          <li><a href="contact.php">Contact Us</a></li>
          <?php
          if (isset($_SESSION['userid'])) {
              echo "<li><a href='logout.php'>Log Out</a></li>";
          }
          ?>
        </ul>
      </nav><!-- #nav-menu-container -->

      <script type="text/javascript">
      const currentLocation = location.href;
      const menuItem = document.querySelectorAll('a');
      const menuLi = document.querySelectorAll('li');
      const menuLength = menuItem.length;
      for(let i=0; i<menuLength; i++)
      {
        if(menuItem[i].href == currentLocation)
        {
          menuLi[i-1].className = "menu-active";
        }
      }
      </script>
      
    </div>
  </header><!-- #header -->
  </div>
  