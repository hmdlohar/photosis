<?php 
include_once "dbfiles/session_start.php";
if(!isset($_SESSION['userLogged'])){

	header("Location: login.php");
}
?>
