<?php
session_start();
if(isset($_SESSION['userid']))
{
	header("location: profile.php");
	exit();
}
if(isset($_SESSION['admin']))
{
	header("location: admin/admin_panel.php");
	exit();
}
?>