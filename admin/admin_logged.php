<?php 
if(!session_id()){
	session_start();
}


if(!isset($_SESSION['adminLogged'])){
	header("Location: login.php");
}
?>