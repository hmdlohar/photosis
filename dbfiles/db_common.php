<?php 
require_once "db.php";
function dbNextId($tableName,$pk){
	$rs=sql_query("select max({$pk}) as max from {$tableName}");
	//print_r($rs);
	if($rs[0]["max"]){
		return $rs[0]["max"]+1;
	}else{
		return 1;
	}
}
function isLogged(){
	if(isset($_SESSION['userLogged'])){
		return true;
	}
	return false;
}

function convertDateToAgo($date){
	 $dateNow = time();
	 $dateThen = strtotime($date);
	 
	 $dateDiffInSec = ( $dateNow -$dateThen) ;	
	//print_r($dateNow,$dateThen,$dateDiffInSec);
	if($dateDiffInSec < 8 ){
		return " Just Now";
	}
	else if($dateDiffInSec < 60 && $dateDiffInSec > 10){
		return floor($dateDiffInSec) . " Second Ago";
	}
	else if($dateDiffInSec > 60 && $dateDiffInSec < 3600){
		return floor($dateDiffInSec / 60) . " Minutes Ago";
	}
	else if($dateDiffInSec > 60 && $dateDiffInSec < (3600 * 24)){
		return floor(($dateDiffInSec / 60) /60) . " Hours Ago";
	}
	else if($dateDiffInSec > 3600 ){
		return floor($dateDiffInSec / 60 /60 /24) . " Days Ago";
	}
	return "wrong";
}
?>
