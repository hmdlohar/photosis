<?php 
include "dbfiles/db.php";
include "dbfiles/db_common.php";

//Register User -----------------------------------------------------
if(isset($_POST['register'])){
	$name=filter_data($_POST['name']);
	$username=filter_data($_POST['username']);
	$email=filter_data($_POST['email']);
	$password=filter_data($_POST['password']);
	if(empty($name) || empty($username) ||empty($email)||empty($password)){
		echo "missingData";
		return;
	}
	$passwd=md5($password);
	$res=sql_nonquery("insert into users (name,username,email,password) values ('{$name}','{$username}','{$email}','{$passwd}')");
	if($res==1){
		echo "success";
	}
	else{
		echo "problemInserting";
	}
}

//Login Authentication -----------------------------------------------------
else if(isset($_POST['login'])){
	
	$username=filter_data($_POST['username']);
	$password=filter_data($_POST['password']);
	$passwd=md5($password);
	$rs=sql_query("select * from users where username='{$username}'");
	if(count($rs)==0){
		echo "userNotFound";
	}
	else{
		if($rs[0]['password']==$passwd){
			$_SESSION['userLogged']=$rs[0]['id'];
			echo "success";

		}
		else{
			echo "passwordDoNotMatch";
		}
	}
}

//Update User's Profile -----------------------------------------------------
else if(isset($_GET['user_profile'])){

}

//Register User -----------------------------------------------------
else if(isset($_GET['register'])){

}
else if(isset($_GET['listCliparts'])){
	$rs=sql_query("select * from assets where type='clipart'");
	echo json_encode($rs);
}
else if(isset($_GET['listFrames'])){
	$rs=sql_query("select * from assets where type='frame'");
	echo json_encode($rs);
}
else if(isset($_POST['saveUserPhoto'])){
	$user_photo=filter_data($_POST['user_photo']);
	$user_photo_name=filter_data($_POST['user_photo_name']);
	
	$image=$_POST['image'];
	$svg=$_POST['svg'];
	if(empty($svg) || empty($image)){
		echo "dataMissing";
		return;
	}
	
	if($user_photo== "-1" ){
		$nextId=dbNextId("user_photos","id");
		$user_photo=$nextId;
	}
	
	$numRows=sql_query("select count(id) as count from user_photos where id={$user_photo}");
	$dbQueryRes;
	
	if($numRows[0]['count'] == 0){
		//echo "insering";
		$dbQueryRes=sql_nonquery("insert into user_photos (id,name,user_id,status) values ({$user_photo},'{$user_photo_name}',{$_SESSION['userLogged']},1)");
	}
	else{
		//echo "updating";
		$dbQueryRes=sql_nonquery("update user_photos set name='{$user_photo_name}' where id={$user_photo}");
	}
	//echo $dbQueryRes;
	if($dbQueryRes){
		$saveSvg=saveFile("user_photos/svg/{$user_photo}.svg",$svg);
		$savePng=savePng("user_photos/png/{$user_photo}.png",$image);
		if($saveSvg && $savePng){
			echo "success:{$user_photo}";
		}
		else{
			echo "problemSavingFile";
		}
	}
	else{
		echo "problemInsertingDb";
	}	
}
else if(isset($_POST['getUserPhoto'])){
	$user_photo=filter_data($_POST['user_photo']);
	//echo "select * from user_photos where id={$user_photo}";
	$res=sql_query("select * from user_photos where id={$user_photo}");
	if(sizeof($res)==0){
		echo "notFound";
	}
	else{
		echo json_encode($res);	
	}
}
else if(isset($_POST['deleteUserPhoto'])){
	$id=filter_data($_POST['deleteUserPhoto']);
	$res=sql_query("select * from user_photos where id={$id}");
	if($res[0]['user_id']==$_SESSION['userLogged']){
		$res=sql_nonquery("delete from user_photos where id={$id}");
		if($res){
			deleteFile("user_photos/svg/{$id}.svg");
			deleteFile("user_photos/png/{$id}.png");
			echo "success";
		}
	}
	else{
		echo "notAllowed";
	}
}
function filter_data($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
function saveFile($path, $data)
{
    $file = fopen($path, "w+");
    if (!$file) {
        return false;
    } else if (fwrite($file, $data)) {
        return true;
    } else {
        return false;
    }
}
function savePng($path,$data){
    $data = str_replace('data:image/png;base64,', '', $data);
    $data = str_replace(' ', '+', $data);
    $data = base64_decode($data);
    if (file_put_contents($path, $data)) {
        return true;
    } else {
    	return false;
    }
}
function deleteFile($path){
	if(is_file($path)){
		if(unlink($path)){
			return true;
		}
	}
	return false;
}
?>