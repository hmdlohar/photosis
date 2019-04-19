<?php
require "../dbfiles/db.php";

//Insert Assets -----------------------------------------------------
if(isset($_POST['login'])){
	$username=filter_data($_POST['username']);
	$password=filter_data($_POST['password']);
	$passwd=md5($password);
	$rs=sql_query("select * from admin where username='{$username}' ");
	if(count($rs)==0){
		echo "userNotFound";
	}
	else{
		if($rs[0]['password']==$passwd){
			$_SESSION['adminLogged']=$rs[0]['id'];
			echo "success";
		}
		else{
			echo "passwordDoNotMatch";
		}
	}
}
else if(isset($_POST['viewAdmin'])){
	$name=filter_data($_POST['name']);
	$username=filter_data($_POST['username']);
	$email=filter_data($_POST['email']);
	$dob=filter_data($_POST['dob']);
	$gender=filter_data($_POST['gender']);
	$adminId=filter_data($_POST['adminId']);
	
	if(empty($name) || empty($username) ||empty($email)||empty($gender)||empty($dob)){
		echo "missingData";
		return;
	}
	$gender = $gender=="male"?1:2;
	//$date=sql_query("SELECT DATE_FORMAT($dob, '%Y %m %d') as dob ");
	$res=sql_nonquery("update admin set name='{$name}', username= '{$username}',email= '{$email}',gender= {$gender} ,dob='{$dob}' where id={$adminId}");
	//echo "update admin set name='{$name}', username= '{$username}',email= '{$email}',gender= {$gender} ,dob='{$dob}' where id={$_SESSION['adminLogged']}";
	//echo $res;
	if($res<=0){
		echo "problemInserting";
	}
	else{
		echo "success";
	}
}
else if(isset($_POST['deleteAdmin'])){
	$id=filter_data($_POST['deleteAdminId']);
	if(isset($_SESSION['adminLogged'])){
		$res=sql_nonquery("delete from admin where id={$id}");
		if($res){
			echo "success";
		}
	}
	else{
		echo "notAllowed";
	}
}
else if(isset($_POST['add_admin'])){
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
	$res=sql_nonquery("insert into admin (name,username,email,password,gender,dob) values ('{$name}','{$username}','{$email}','{$passwd}',{$gender},'{$dob}')");
	if($res==1){
		echo "success";
	}
	else{
		echo "problemInserting";
	}
}

else if(isset($_POST['add_user'])){
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

else if(isset($_POST['add_admin'])){
		$name=filter_data($_POST['name']);
	$username=filter_data($_POST['username']);
	$email=filter_data($_POST['email']);
	$dob=filter_data($_POST['dob']);
	$gender=filter_data($_POST['gender']);
	$password=filter_data($_POST['password']);
	$passwd=md5($password);
	$res=sql_nonquery("insert into admin (name,username,email,password,gender,dob) values ('{$name}','{$username}','{$email}','{$passwd}',{$gender},'{$dob}')");
	if($res==1){
		header("Location: index.php");
	}
	else{		
		header("Location: add_admin.php");
	}
}


else if(isset($_POST['in_assets'])){
	$name=filter_data($_POST['name']);
	$type=filter_data($_POST['type']);
	$temp=sql_query("select max(id) as id from assets");
	$next_id=(int)$temp[0]['id']+1;
	
	if(isset($_FILES['image'])){
			
	  $errors= array();
	  $file_name = $_FILES['image']['name'];
	  $file_size =$_FILES['image']['size'];
	  $file_tmp =$_FILES['image']['tmp_name'];
	  $file_type=$_FILES['image']['type'];
	  //$file_ext=strtolower(end(explode('.',$_FILES['image']['name'])));
	  
	  
	  
	  if($file_size > 2097152){
		 $errors[]='File size must be excately 2 MB';
	  }
	  
	  if(empty($errors)==true){
		$res=move_uploaded_file($file_tmp,"../assets/".$next_id.".png");
		if(!$res){
			
		}
		
	  }else{
	  	
		 header("Location: cliparts.php?error=".$errors[0]);
	  }
	}
	$res=sql_nonquery("insert into assets (id,name,type) values ({$next_id},'{$name}','{$type}')");
	if(!$res){
		if($type=='clipart'){
			header("Location: cliparts.php?error=".$res);
			exit;
		}
		else{
			header("Location: frames.php?error=".$res);
			exit;
		}
	}
	if($type=='clipart'){
		header("Location: cliparts.php");
		exit;
	}
	else{
		header("Location: frames.php");
		exit;
	}
	
}
//Update Assets -----------------------------------------------------
else if(isset($_POST['update_assets'])){
	$name=filter_data($_POST['name']);
	$type=filter_data($_POST['type']);
	$id=filter_data($_POST['id']);

	if(isset($_FILES['image'])){
			
	  $errors= array();
	  $file_name = $_FILES['image']['name'];
	  $file_size =$_FILES['image']['size'];
	  $file_tmp =$_FILES['image']['tmp_name'];
	  $file_type=$_FILES['image']['type'];
	  //$file_ext=strtolower(end(explode('.',$_FILES['image']['name'])));
	  
	  
	  if($file_size > 2097152){
		 $errors[]='File size must be excately 2 MB';
	  }
	  
	  if(empty($errors)==true){
	  	$res=move_uploaded_file($file_tmp,"../assets/".$id.".png");
		if(!$res){
			return;
		}
		
	  }else{
		 header("Location: cliparts.php?error=".$errors[0]);
	  }
	}
	$res=sql_nonquery("update assets set name='{$name}' where id={$id}");
	if(!$res){
		if($type=='clipart'){
			header("Location: cliparts.php?error=".$res);
			exit;
		}
		else{
			header("Location: frames.php?error=".$res);
			exit;
		}
	}
	if($type=='clipart'){
		header("Location: cliparts.php");
		exit;
	}
	else{
		header("Location: frames.php");
		exit;
	}
}
//Delete Assets -----------------------------------------------------
else if(isset($_GET['delete_assets'])){
	$id=filter_data($_GET['id']);
	if(is_file("../assets/{$id}.png")){
		unlink("../assets/{$id}.png");
	}
	$res=sql_nonquery("delete from assets where id=".$id);
	if(!$res){
		
		header("Location: {$_SERVER['HTTP_REFERER']}?error=".$res);
		exit;
	
	}
	header("Location: ".$_SERVER['HTTP_REFERER']);
	exit;
}
else if(isset($_GET['delete_user_photo'])){
	$id=filter_data($_GET['id']);
	if(is_file("../user_photos/png/{$id}.png")){
		unlink("../user_photos/png/{$id}.png");
	}
	if(is_file("../user_photos/svg/{$id}.svg")){
		unlink("../user_photos/svg/{$id}.svg");
	}
	$res=sql_nonquery("delete from user_photos where id=".$id);
	if(!$res){
		
		header("Location: {$_SERVER['HTTP_REFERER']}?error=".$res);
		exit;
	
	}
	header("Location: ".$_SERVER['HTTP_REFERER']);
	exit;
}



//Moving Assets auto -----------------------------------------------------
else if(isset($_GET['test'])){
	//echo "doing";
	$dr=scandir("../assets/cliparts");
	$row=sql_query("select max(id) from assets");
	$next_id=(int)$row[0] +1;
	foreach ($dr as $key => $value) {
		if($value == "." || $value ==".."){
			continue;
		}
		$name=explode('.', $value);
		$res=sql_nonquery("insert into assets (id,name,type) value ({$next_id},'".ucfirst($name[0])."','clipart')");		
		if(!$res){
			echo "error ";
			break;

		}
		copy("../assets/cliparts/{$value}","../assets/{$next_id}.png");
		echo "--".$next_id.ucfirst($name[0])."<br>";
		$next_id++;
	}

}


function filter_data($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>
