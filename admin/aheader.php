<?php 
if($_SESSION['admin']!="admin")
{
    header("Location: ../index.php");
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link href="../img/icon1.png" rel="icon">
  <!-- <link href="img/icon1.png" rel="apple-touch-icon"> -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Poppins:300,400,500,700" rel="stylesheet">
  <link href="../lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../lib/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <link href="../lib/animate/animate.min.css" rel="stylesheet">
  <link href="../css/style.css" rel="stylesheet">
        <title>Admin Panel</title>
        </head>
<body>
<div class="w-full d-flex text-white p-3" style="background-image:linear-gradient(90deg,  #181ff3bf, #0af1bbb0);">
			<div style="width:100%">
			<center>
				<a href="admin_panel.php"><span style="font-size:30px;font-weight:bold; color:white;">Admin Panel</span></a>
			</center>
			</div>
		</div>
</body>
        
		
		