<?php 
session_start();
unset($_SESSION['userLogged']);
//changes have been made.
header("Location: login.php");
?>