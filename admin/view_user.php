<?php
require "../dbfiles/db.php";
require "header.php";
$start=0;
$count=20;
if(isset($_GET['show_user'])){
	$id=$_GET['show_user'];
	$res=sql_query("select * from users where id={$id}");

	$profilePicPath="../user_pics/emptyProfile.png";
	if(is_file("../user_pics/{$id}.png")){
		$profilePicPath="../user_pics/{$id}.png";
	}
}

?>
<script src="../js/jquery.js"></script>
<script src="../js/allOfPhotosis.js"></script>
<main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
    <div class="row" style="margin-top:20px">
		<div class="col-lg-3">
			<img class="" style="border:8px solid #bebebf;height:245px;width:255px;" src="<?php echo $profilePicPath?>">
		</div>
        <div class="col-lg-4">
				<div class="control-group form-group">
				  <div class="controls">
					<label>Name:</label>
					<input type="text" class="form-control"  name="name" value="<?php
						
							echo $res[0]['name'];
					?>">
					<p class="help-block"></p>
				  </div>
				</div>           
				<div class="control-group form-group">
				  <div class="controls">
					<label>Email:</label>
					<input type="text" class="form-control"  name="email"  value="<?php
						
							echo $res[0]['email'];
					?>">
					<p class="help-block"></p>
				  </div>
				</div>
				 <div class="control-group form-group">
				  <div class="controls">
					<label>Date of Birth:</label>
					<input type="text" class="form-control" name="dob" value="<?php
					
							echo $res[0]['dob'];
					?>">
					<p class="help-block"></p>
				  </div>
				</div>
		</div>
				
				<div class="col-lg-3">
					<div class="control-group form-group">
						  <div class="controls">
							<label>Username:</label>
							<input type="text" class="form-control" name="username" value="<?php
						foreach ($res as $key => $value)
							echo $value['username'];
					?>">
							<p class="help-block"></p>
						  </div>
						</div>
					<div class="control-group form-group">
						  <div class="controls">
							<label>Gender:</label>
							<select name="gender" class="form-control">
												<option value="1">Male</option>
												<option value="2">Female</option>
											</select>
							<p class="help-block"></p>
						  </div>
						</div>
						
				</div>
					
			</div>	<hr>
			<div class="row">
				<div class="col-6 "><h3 style="color: #080c8c;">Follower</h3>
					<?php $follower=sql_query("SELECT follow.user_id,follow.follower_id as follower_id, users.username as username from follow,users where follow.user_id = {$id} and users.id=follow.follower_id");
						if(count($follower)!=0){
					foreach ($follower as $key => $value)
							echo '<a style="text-decoration:none;" href="view_user.php?show_user='.$value['follower_id'].'"><div  style="font-size:20px;font-weight:bold;" class="text-info"><img class="rounded-circle" style="height:30px;width;30px;" src=../user_pics/'.$value['follower_id'].'.png> '.$value['username'].'</div></a>';
						}
						else{
							echo '<div style="font-size:20px ;font-weight:bold;color:#bd1010">No Follower...</div>';
							}
					 ?>
				</div>
				<div class="col-6" ><h3 style="color: #080c8c;">Following</h3>
					<?php $following=sql_query("SELECT follow.user_id as user_id ,follow.follower_id, users.username as username  from follow,users where follow.follower_id = {$id} and users.id=follow.user_id"); 
							if(count($following)!=0){
							foreach ($following as $key => $value)
						echo '<a style="text-decoration:none; " href="view_user.php?show_user='.$value['user_id'].'"><div  style="font-size:20px;font-weight:bold;" class="text-info"><img class="rounded-circle" style="height:30px;width;30px;" src=../user_pics/'.$value['user_id'].'.png> '.$value['username'].'</div></a>';
					}
					else{
						echo '<div style="font-size:20px ;font-weight:bold;color:#bd1010">No Following...</div>';
					}
					 ?>		
				</div>
			</div><hr>
			<h3 style="color: #080c8c;">Uploaded Photos</h3>
				<div class="row">

			<?php $userPhotos=sql_query("SELECT users.id as uid, users.name as uname,  user_photos.description as description, user_photos.name as pname,user_photos.id as pid,username from user_photos,users where user_photos.user_id = users.id and user_id={$id} order by user_photos.time desc"); 
			if(count($userPhotos)!=0){
				foreach ($userPhotos as $key => $value)
				{
					echo '<div class="gallery col-lg-4 col-sm-6 portfolio-item" style="margin-top:10px;">
			          <div class="card h-100 rounded">
		                <a href="view_user.php?show_user='.$value['uid'].'" class="text-info" style="text-align:center;id="username" text-decoration:none;">'.$value['username'].'</a>
			            <img style="border:4px solid #dad3d3"class="card-img-top rounded" data-id="'.$value['pid'].'" data-desc="'.$value["description"].'" style="padding:10px" src="../user_photos/png/'
			            .$value['pid'].'.png" alt="error loading image">
			            <div class="card-body">
			              <h4 class="card-title">
			                <div class="text-left " style="text-decoration:none;text-align:center;font-weight:bold; color:#1bc70ff5;">'.$value['pname'].'</div>
			                <div class="btn btn-danger float-right" style="background-color:#ce1414;"onclick="deleteUserPhoto('.$value['pid'].',this)">Delete<small class="d-none d-sm-block"></small></div>
			              </div>
			            </div>
					</div>';
			      }
			  }
			  else
			  {
				  echo '<div style="font-size:20px ;font-weight:bold;color:#bd1010">No Photo Uploaded...</div>';
				}
			?></div>
			<br><hr>
			<h3 style="color: #080c8c	;">Liked Photos</h3><br>
				<div class="row">

			<?php $likePhotos=sql_query("SELECT  user_photos.description as description,users.id as uid,  users.name as uname, user_photos.name as pname,user_photos.id as pid,username from user_photos,users where user_photos.user_id = users.id and user_photos.id in (Select photo_id from likes where user_id = {$id}) order by user_photos.time desc");
			if(count($likePhotos)!=0){
				foreach ($likePhotos as $key => $value)
				{
					echo '<div class="gallery col-lg-4 col-sm-6 portfolio-item">
			          <div class="card h-100 rounded">
		                <a href="view_user.php?show_user='.$value['uid'].'" class="text-info" style="text-align:center;id="username" text-decoration:none;">'.$value['username'].'</a>
			            <img style="border:4px solid #dad3d3" class="card-img-top rounded" data-id="'.$value['pid'].'" data-desc="'.$value["description"].'" style="padding:10px" src="../user_photos/png/'
			            .$value['pid'].'.png" alt="error loading image">
			            <div class="card-body">
			              <h4 class="card-title">
			                <div class="text-left " style="text-decoration:none;text-align:center;font-weight:bold; color:#1bc70ff5;">'.$value['pname'].'</div>
			                
			              </div>
			            </div>
					</div>';
			      }
			   }
			   else{
				   echo '<div style="font-size:20px ;font-weight:bold;color:#bd1010">No Liked Photo...</div>';
				   }
			?></div>
</main>


<?php 
require "footer.php";
?>
<script>
function loc(id){
location.href="view_user.php?show_user="+id+"";
}
function deleteUserPhoto(id,e){
	notie.confirm({
		text: "Do you really want to delete this photo?",
		submitText :'Yes',
		cancelText:'No'
	},function(){
		deleteRequest(id,e);
	},function(){

	});
}
function deleteRequest(id,e){
	$.ajax({
        url: "../dataProvider.php",
        type:"POST",
        data:{
            deleteUserPhoto: id
        },
        success:function(data){
        	if(data =="success"){
        		notie.alert({ text: "Image Deleted Successfully", type: 1 });
        		$(e).parents(".portfolio-item").remove()
        	}
        	else if(data=="notAllowed"){
        		notie.alert({ text: "Action not allowed", type: 3 });
        	}
        	
        },
        error:function(err){
            console.log(err.responseText);
        }
    });
}
</script>
