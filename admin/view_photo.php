<?php
require "../dbfiles/db.php";
require "header.php";
$start=0;
$count=20;
if(isset($_GET['show_photo'])){
	$id=$_GET['show_photo'];
	$userPhotos=sql_query("SELECT users.id as uid, users.name as uname,  user_photos.description as description, user_photos.name as pname,user_photos.id as pid,username from user_photos,users where user_photos.user_id = users.id and user_photos.id='{$id}'");
}
?>

		<main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
			<div class="card border-info">
				<div class="card-header text-white bg-info">User's Info</div>
				<div class="card-body">
					
			<?php 			foreach ($userPhotos as $key => $value) {
									$count=sql_query("select count(photo_id) as like_count from likes where photo_id={$value['pid']} ");
									echo	'<img class="card-img-top " style="height:500px;margin-top:10px;margin-bottom:10px;padding:10px" src="../user_photos/png/'.$value['pid'].'.png" alt="error loading image">
									<a href="view_photo.php?show_photo='.$value['uid'].'" class="text-info" style=" font-size:38px;  text-decoration: none">'.$value['username'].'</a>
									<div class="text-left" style="text-decoration:none;text-align:center;font-weight:bold; color:#1bc70ff5;font-size:20px;">'.$value['pname'].'</div>
									<div class="" style=" font-size:20px">'.$value['description'].'</div><hr>
									<div class="row" style>
									'; ?>
					<div class="col-6"><h3>User Who Liked This Photo</h3>
					<?php $follower=sql_query("SELECT users.username as username, likes.photo_id as photo_id, users.id as  id from users , likes where users.id=likes.user_id and likes.photo_id={$id}");
					foreach ($follower as $key => $value)
							echo '<a style="text-decoration:none;" href="view_user.php?show_user='.$value['id'].'"><div  style="font-size:20px" class="text-info"><img class="rounded-circle" style="height:30px;width;30px;" src=../user_pics/'.$value['id'].'.png> '.$value['username'].'</div></a>';
					 ?>
				</div>

				<div class="col-6"><h3>Comments On This Photo</h3>
					<?php $following=sql_query("select photo_id,comment,time, (select username from users where id=comments.user_id) as uname, (select id from users where id=comments.user_id) as uid from comments where photo_id={$id} order by time desc"); 
					
						foreach ($following as $key => $value)
							echo '<a style="text-decoration:none; " href="view_user.php?show_user='.$value['uid'].'"><div  style="font-size:20px" class="text-info"><img class="rounded-circle" style="height:30px;width;30px;" src=../user_pics/'.$value['uid'].'.png> '.$value['uname'].'</div></a>'.$value['comment'];
					 ?>		
				</div>

		<?php } ?>
				</div>
			</div>
	
          
<?php 
require "footer.php";
?>

