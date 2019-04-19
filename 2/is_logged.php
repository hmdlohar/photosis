<?php 
if(isset($_SESSION['userLogged'])){


}
else{
	header("Location: login.php");
}
?>