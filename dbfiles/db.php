<?php
include_once "session_start.php";
include_once "db_common.php";
$db=Array(
	"host"=>"localhost",
	"username"=>"root",
	"password"=>"",
	"name"=>"iEdit"
);
function sql_nonquery($query)
{
	global $db;
	$con=mysqli_connect($db['host'],$db['username'],$db['password'],$db['name']);
	if(!$con)	
	{
		die(mysqli_error($con));
	}
	$res=mysqli_query($con,$query);
	if(!$res)
	{
		return mysqli_error($con);
	}
	mysqli_close($con);
	return $res;
}


function sql_query($query)
{
	global $db;
	$con=mysqli_connect($db['host'],$db['username'],$db['password'],$db['name']);
	if(!$con){
		die(mysqli_error($con));
	}
	$arr=[];
	$res=mysqli_query($con,$query);
	if(!$res){
		return mysqli_error($con);
	}
	while ($row=mysqli_fetch_assoc($res)) {
		$arr[]=$row;
	}
	mysqli_close($con);
	return $arr;
}
?>
