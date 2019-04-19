<?php 
include "dbfiles/db.php";
include_once "dbfiles/db_common.php";
date_default_timezone_set("Asia/Kolkata");
//Register User -----------------------------------------------------
if(isset($_POST['register'])){
	$name=filter_data($_POST['name']);
	$username=filter_data($_POST['username']);
	$email=filter_data($_POST['email']);
	$dob=filter_data($_POST['dob']);
	$gender=filter_data($_POST['gender']);
	$password=filter_data($_POST['password']);
	
	if(empty($name) || empty($username) ||empty($email)||empty($gender)||empty($dob)||empty($password)){
		echo "missingData";
		return;
	}
	$passwd=md5($password);
	$res=sql_nonquery("insert into users (name,username,email,password,gender,dob) values ('{$name}','{$username}','{$email}','{$passwd}',{$gender},'{$dob}')");
	if($res==1){
		echo "success";
	}
	else{
		echo "problemInserting";
	}
}
else if(isset($_POST['updateProfile'])){
	$name=filter_data($_POST['name']);
	$username=filter_data($_POST['username']);
	$email=filter_data($_POST['email']);
	$dob=filter_data($_POST['dob']);
	$gender=filter_data($_POST['gender']);
	
	if(empty($name) || empty($username) ||empty($email)||empty($gender)||empty($dob)){
		echo "missingData";
		return;
	}
	$gender = $gender=="male"?1:2;
	//$date=sql_query("SELECT DATE_FORMAT($dob, '%Y %m %d') as dob ");
	$res=sql_nonquery("update users set name='{$name}', username= '{$username}',email= '{$email}',gender= {$gender} ,dob='{$dob}' where id={$_SESSION['userLogged']}");
	
	if($res<=0){
		echo "problemInserting";
	}
	else{
		echo "success";
	}
}
else if(isset($_POST['updatePassword'])){
	$op=filter_data($_POST['op']);
	$p=filter_data($_POST['p']);
	
	if(empty($op) || empty($p)){
		echo "missingData";
		return;
	}
	$passwd=md5($op);
	$newPasswd=md5($p);
	$rs=sql_query("SELECT password from users where id={$_SESSION['userLogged']} ");
	if(count($rs) > 0 && $rs[0]['password']==$passwd)
	{
		$res=sql_nonquery("update users set password= '{$newPasswd}' where id={$_SESSION['userLogged']} ");
		if($res==1)	
		{
			echo "success";
		}
		else{
			echo "passwordInAccurate";
			}
		}
	else{
		echo "passwordInAccurate";
	}
	
}

//Login Authentication -----------------------------------------------------
else if(isset($_POST['login'])){
	
	$username=filter_data($_POST['username']);
	$password=filter_data($_POST['password']);
	$passwd=md5($password);
	$rs=sql_query("select * from users where username='{$username}' ");
	if(count($rs)==0){
		echo "userNotFound";
	}
	else{
		if($rs[0]['password']==$passwd){
			$_SESSION['userLogged']=$rs[0]['id'];
			//$status= sql_query("select status from users where username='{$username}'");
			//if($status[0][0]==0)
				//$rrs="register2.php";
			//else
				//$rrs="my-gallery.php";
			//echo json_encode($rrs)
			if($rs[0]['login_status']==0){
				$res=sql_nonquery("update users set login_status=1 where id={$_SESSION['userLogged']} ");
				echo "register2";
			}
			else
				echo "my-gallery";
		}
		else{
			echo "passwordDoNotMatch";
		}
	}
}

else if(isset($_POST['search']))
{	
	$sear=filter_data($_POST['sear']);
	$rs=sql_query("select * from users where username like '%{$sear}%' or name  like '%{$sear}%'");
	if(count($rs)!=0){
		for ($i=0;$i<count($rs);$i++)  {

			if($rs[$i]['profile_pic_status']==0)
			{
				$rs[$i]['fav_quote2']="user_pics/emptyProfile.png";
			}
			else{
				$rs[$i]['fav_quote2']="user_pics/{$rs[$i]['id']}.png";
			}
		}

		echo json_encode($rs);	
	}
	else{
		echo "userNotFound";
		}
}
// else if(isset($_POST['doFollow']))
// {	
// 	$user_id=filter_data($_POST['user_id']);
// 	$rs=sql_nonquery("insert into follow (user_id,follower_id) values ({$user_id},{$_SESSION['userLogged']})");
// 	if(count($rs)!=0){
// 		echo "success";	
// 	}
// 	else{
// 		echo "userNotFound";
// 		}
// }
// else if(isset($_POST['doUnfollow']))
// {	
// 	$user_id=filter_data($_POST['user_id']);
// 	$rs=sql_nonquery("delete from follow where user_id={$user_id} and follower_id={$_SESSION['userLogged']})");
// 	if(count($rs)!=0){
// 		echo "success";	
// 	}
// 	else{
// 		echo "userNotFound";
// 		}
// }

//Update User's Profile -----------------------------------------------------
else if(isset($_GET['user_profile'])){

}
else if(isset($_GET['notify_follow'])){
	
	$rs=sql_query("select users.username as username, follow.user_id as user_id, follow.follower_id as follower_id from follow,users where follow.user_id={$_SESSION['userLogged']} and follow.user_id=users.id order by follow.time desc");
	if(count($rs)!=0)
	{
		echo json_encode($rs);		
	}
	else
		echo"nothing";
}
else if(isset($_POST['notify_like'])){
//select photo_id, (select username from users where id=likes.user_id) as uname from likes where likes.notify_status = 0 and likes.user_id=1	
	$rs=sql_query("select likes.photo_id from likes,user_photos where user_photos.id=likes.photo_id and user_photos.user_id={$_SESSION['userLogged']} order by time desc "); 
	if(count($rs)!=0)
	{
		echo json_encode($rs);		
	}
	else
		echo"nothing";
}
else if(isset($_GET['notify_comment'])){
	//select photo_id, (select username from users where id=comments.user_id) as uname,comment, time from comments where notify_status = 0 and user_id=4
	$rs=sql_query("select users.username as username, follow.user_id as user_id, follow.follower_id as follower_id from follow,users where follow.follower_id={$_SESSION['userLogged']} and follow.user_id=users.id order by time desc");
	if(count($rs)!=0)
	{
		echo json_encode($rs);		
	}
	else
		echo"nothing";
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
	$user_photo_desc=filter_data($_POST['user_photo_desc']);
	
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
	$date = date("Y/m/d h:i:s");
		$dbQueryRes=sql_nonquery("insert into user_photos (id,name,description,user_id,status,time) values ({$user_photo},'{$user_photo_name}','{$user_photo_desc}',{$_SESSION['userLogged']},1,'{$date}')");
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

else if(isset($_POST['doLike'])){
	$photo_id=filter_data($_POST['photo_id']);
	$user_id = $_SESSION['userLogged'];
	$date = date("Y/m/d h:i:s");
	$photo_owner=sql_query("select user_photos.user_id as id from user_photos where user_photos.id={$photo_id}");
	$owner=$photo_owner[0]["id"];
	$res = sql_nonquery("insert into likes (user_id,photo_owner_id,photo_id,time) values ({$user_id},{$owner},{$photo_id},'{$date}')");
	//$res = sql_nonquery("insert into likes (user_id,photo_id,time) values ({$user_id},{$photo_id},'{$date}')");
	$count = sql_query("select count(photo_id) as like_count from likes where photo_id={$photo_id}");
	
	if(!$res){
		echo "error";
	}
	else{
		echo json_encode($count);
	}
}


else if(isset($_POST['doUnLike'])){
	$photo_id=filter_data($_POST['photo_id']);
	$user_id = $_SESSION['userLogged'];
	$res = sql_nonquery("delete from likes where user_id = {$user_id} and photo_id={$photo_id}");
	$count = sql_query("select count(photo_id) as like_count from likes where photo_id={$photo_id}");
	if(!$res){
		echo "error";
	}
	else{
		echo json_encode($count);
	}
}
else if(isset($_POST['doComment'])){
	$photo_id=filter_data($_POST['photo_id']);
	$comment=filter_data($_POST['comment']);
	$user_id = $_SESSION['userLogged'];
	$date = date("Y/m/d H:i:s");
	$photo_owner=sql_query("select user_photos.user_id as id from user_photos where user_photos.id={$photo_id}");
	$owner=$photo_owner[0]["id"];
	$res = sql_nonquery("insert into comments (user_id,photo_owner_id,photo_id,comment,time) values ({$user_id},{$owner},{$photo_id},'{$comment}','{$date}')");
	$comments = sql_query("SELECT users.id as uid, users.name as uname,  user_photos.description as description, user_photos.name as pname,user_photos.id as pid users.username as username, comments.comment as comment from user_photos,users where user_photos.user_id = users.id  where photo_id={$photo_id}");
	$count = sql_query("select count(photo_id) as like_count from likes where photo_id={$photo_id}");
	if(count($res)==0){
		echo "error";
	}
	else{
		echo json_encode($comments);
	}
}
else if(isset($_POST['getCommentsForPhoto'])){
	$photoId=filter_data($_POST['photoId']);
	
	//$res = sql_nonquery("insert into comments (user_id,photo_id,comment,time) values ({$user_id},{$photo_id},'{$comment}','{$date}')");
	$comments = sql_query("SELECT *,users.name as uname, comments.id as id from users,comments where users.id = comments.user_id and photo_id={$photoId}");
	//$count = sql_query("select count(photo_id) as like_count from likes where photo_id={$photo_id}");
	echo json_encode($comments);
}

//Update User's Profile -----------------------------------------------------
else if(isset($_POST['profileInfo'])){
	if(isLogged()){
		$userData=sql_query("select * from user_profiles where user_id={$_SESSION['userLogged']}");
		if(count($userData)==0){
			echo "profileNotFound";
		}
		else{
			echo json_encode($userData[0]);
		}
	}
	else{
		echo "profileNotFound";
	}
	return;
}
else if(isset($_POST['loginInfo'])){
	if(isLogged()){
		$userData=sql_query("select id,username,name,email from users where id={$_SESSION['userLogged']}");
		$userData[0]['logged']=true;
		echo json_encode($userData[0]);
	}
	else{
		echo "{\"logged\": false}";
	}
	return;
}
else if(isset($_POST['doFollow'])){
	if(isLogged()){
		$user_id = $_POST['user_id'];
		$follower_id=$_SESSION['userLogged'];		
		$date = date("Y/m/d H:i:s");
		$res=sql_nonquery("insert into follow(user_id, follower_id,time) values ({$user_id},{$follower_id},{$date})");
		
		if($res){
			echo "success";
		}
		else{
			echo "error";
		}
	}
	else{
		echo "userNotLogged";
	}
	return;
}
else if(isset($_POST['doUnfollow'])){
	if(isLogged()){
		$user_id = $_POST['user_id'];
		$follower_id=$_SESSION['userLogged'];
		$res=sql_nonquery("delete from follow where user_id={$user_id} and follower_id={$follower_id}");
		//echo "delete from follow where user_id={$user_id} and follower_id={$follower_id}";
		if($res){
			echo "success";
		}
		else{
			echo "error";
		}
	}
	else{
		echo "userNotLogged";
	}
	return;
}
else if(isset($_POST['updateProfilePic'])){
	if(isLogged()){
		$sourcePath = $_FILES['img']['tmp_name'];
		$tt=explode(".",$_FILES['img']['name']);
		$ext=end($tt);
		$path="user_pics/{$_SESSION['userLogged']}.png";
		$res=move_uploaded_file($sourcePath,$path) ; 
		if($res){
			$rs=sql_nonquery("update users set profile_pic_status=1 where id={$_SESSION['userLogged']} ");
			echo "success";
		}
		else{
			echo "error";
		}

	}
	else{
		echo "userNotLogged";
	}
	return;
}

//echo "asdfsdaf";

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
