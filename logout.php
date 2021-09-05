<?php
session_start();
ob_start();
unset($_SESSION['userid']);
header("Location: index.php"); 
?>