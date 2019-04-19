<?php 
require_once "header.php";
require_once "is_logged.php";
$user=sql_query("select * from users where id={$_GET['clicked-id']}");
$follow_data=sql_query("select * from follow where user_id={$_GET['clicked-id']} and follower_id={$_SESSION['userLogged']}");
$userPhotos=sql_query("SELECT users.id as uid,  users.name as uname, user_photos.name as pname, user_photos.description as description,user_photos.id as pid,username, (case when EXISTS(select * from likes where user_id={$_SESSION['userLogged']} and photo_id=user_photos.id) then 1 else 0 end) as isLiked from user_photos,users where user_photos.user_id = users.id and user_photos.id in (Select photo_id from likes where user_id = {$_GET['clicked-id']}) order by user_photos.time desc");
?>
<script src="js/jquery.js"></script>
<script src="js/allOfPhotosis.js"></script>
			<script>
				$(document).ready(function(){
				$(".card-img-top").click(function(){
					$("#imagePopup").show(500);
					$("#imgPopup")[0].src = this.src;
					$("#photodescription").html($(this).attr("data-desc"));
					var photoId = $(this).attr("data-id");
					window.lg= this;
					var rootGallery = $(this).parentsUntil(".gallery");
					var name =rootGallery.find(".text-left").text();
					var username =rootGallery.find(".gallery-uname").text();
					$("#photoname").text(name);
					$("#username").text(username);
					loadCommentForOnePhoto(photoId);
				}); 

			});
		</script>
		<style>
			h3:hover{
				transition: color 0.5s;
				transition: font-size 1s;
				color:red;
				font-size:34px;
				}
		</style>
<div class="container">
<?php
	if($user[0]['id']!= $_SESSION['userLogged'] && isset($_GET['clicked-id'])){
		$profilePic="user_pics/{$_GET['clicked-id']}.png";
		$userData=sql_query("select profile_pic_status from users where id={$_GET['clicked-id']}");
		if($userData[0]['profile_pic_status']==0)
		{
			$profilePic="user_pics/emptyProfile.png";
		}
	}
?>
	<!-- Page Heading/Breadcrumbs -->
	<div class="row" style="margin-top:20px">
		<div class="col-lg-3">
			<div><img class="rounded-circle " style="border:8px solid #bebebf;height:245px;width:255px;" src="<?php echo $profilePic?>">	</div>
		</div>
			
			<div class="col-lg-5">
				<div  class="text-info" style="font-size:40px; text-decoration:none;">
					<?php
						foreach ($user as $key => $value)
							echo $value['username'];
					?>
				</div>
				<div class="" style="font-size:25px;text-decoration:none;font-weight:bold; color:#232108f5;">
					<?php
						foreach ($user as $key => $value)
							echo $value['fav_quote'];
					?>
				</div>
					
			</div>
			<!----<script type="text/javascript">
$(document). ready(function(){
// Hide displayed paragraphs.
$(".hide-btn"). click(function(){
$("p"). hide();
});--->
				<div class="col-lg-4">
<?php
	if($user[0]['id']== $_SESSION['userLogged'] ){
		echo '<a class="btn btn-primary breadcrumb" href="profile.php"style=";color:black;width:250px;height:40px;margin-top:10px;margin-left:20px;font-weight:bold;font-size:20px;padding:auto; background-color:white; border:3px solid black;"  >
						Edit Profile
					</a>';
	}
	else  {
		if($follow_data )
		{
			echo '<a class="btn btn-primary" id="following" onclick="fnDoUnfollow(this,'.$user[0]['id'].')" style="background-color:white;display:none;width:250px;height:40px;margin-top:10px;margin-left:20px;font-weight:bold;font-size:20px; background-color:#white;"  >
						FOLLOWING
					</a>';
		}
		else {
			echo ' <a class="btn btn-primary " onclick="fnDoFollow(this,'.$user[0]['id'].')" id="follow" style="display:none;color:white;width:250px;height:40px;margin-top:10px;margin-left:20px;font-weight:bold;font-size:20px; background-color:#1380de;" >
						FOLLOW
					</a> 
					';
		}
	}
?>			
					<div class="row" style="margin-top:10px">
						<div class="col-lg-4" >
							<span style="font-weight:600; color:blue;">
								<?php
									$total_posts=sql_query("SELECT count(*) as pid from user_photos where user_id ={$_GET['clicked-id']}");
									foreach ($total_posts as $key => $value)
									{
										echo $value['pid'].' ';
								
									}
								?>
							</span>posts
						</div>
						
						<div class="col-lg-4" >
							<span style="font-weight:600; color:blue;">
								<?php
									$total_follower=sql_query("SELECT count(*) as pid from follow where user_id ={$_GET['clicked-id']}");
									foreach ($total_follower as $key => $value)
									{
										echo $value['pid'].' ';
								
									}
								?>
							</span>followers
						</div>
						
						<div class="col-lg-4" >
							<span style="font-weight:600; color:blue;">
								<?php
									$total_follower=sql_query("SELECT count(*) as pid from follow where user_id = {$_GET['clicked-id']}");
									foreach ($total_follower as $key => $value)
									{
										echo $value['pid'].' ';
								
									}
								?>
							</span>followings
						</div>
						
					</div>
				</div>
	</div><hr>
	
    <div class="row">
		<div class="col-lg-8">
			<h1 class="" style="font-weight:bold; color:#2d2756;">Love</h1>
		</div>
		
		<div class="col-lg-2	">	
				<h3 style="cursor:pointer;"onclick="window.location='love.php';"><i class="fa fa-heart"></i><?php echo " "?>Loves</h3>
		</div>
		<div class="col-lg-2 	" >	
				<h3 style="cursor:pointer;"onclick="window.location='my-gallery.php';"><i class="fa fa-book"></i><?php echo " "?>Gallery</h3>
		</div>

    </div>
	<ol class="breadcrumb"style="background-color:#404042">
		<li class="breadcrumb-item">
			<a href="index.php"style="color:white">Home</a>
		</li>
		<li class="breadcrumb-item active"style="color:white">Love</li>
	</ol>
	<!---gallery making-->
	<div class="row">
      	<?php 
			
			foreach ($userPhotos as $key => $value)
			{
				$count=sql_query("select count(photo_id) as like_count from likes where photo_id={$value['pid']} ");
				echo '<div class="gallery col-lg-4 col-sm-6 portfolio-item">
			          <div class="card h-100 rounded">
		                <a href="love2.php?clicked-id='.$value['uid'].'" class="text-info" style="text-align:center;id="username" text-decoration:none;">'.$value['username'].'</a>
			            <img class="card-img-top rounded" data-id="'.$value['pid'].'" data-desc="'.$value["description"].'" style="padding:10px" src="user_photos/png/'
			            .$value['pid'].'.png" alt="error loading image">
			            <div class="card-body">
			              <h4 class="card-title">
			                <div class="text-left " style="text-decoration:none;text-align:center;font-weight:bold; color:#1bc70ff5;">'.$value['pname'].'</div>
			                <div class="row"  style="margin-top:20px">';
			                if($value['isLiked'] == 1){
			                	echo '
								<div class="col-md-9">
									<div class="love"><i class="fa fa-heart" style="transition: color 0.5s;color:red;" onclick="fnDoUnlike(this,'.$value['pid'].')"> </i>
														<span id="count">'.$count[0]['like_count'].'</span></div>
								</div>';
			                }
			                else{

			                echo '
								<div class="col-md-9">
									<div class="love"><i class="fa fa-heart" style="transition: color 0.5s;" onclick="fnDoLike(this,'.$value['pid'].')"> </i>
														<span id="count">'.$count[0]['like_count'].'</span></div>
								</div>';
			                }

							echo '
								<div class="col-md-3">
									<div class=""><i class="fa fa-share" style="transition: color 0.5s;" onclick="fnDoLike(this)"> </i></div>
								</div>								
			                </div>
			              </h4>
			              <input type="text" id="comment_input"placeholder="Write a Comment..." style="font-weight:bold;width:200px;"><button onclick="writeComment(this,'.$value['pid'].')" id="comment_button"class="" style="border-radius:00px 30px 00px 10px;width:100px;float:right; background-color:#0e62ab;font-weight:bold;color:white">Comment</button>
			            </div>
			          </div>
			        </div>';
			}
		?>
    </div>
	<!----cross-->
	<?php if(isset($_SESSION['userLogged'])){
			$path="";
		}
		else{ $path="onclick='locationa()'";}
		?>
		<div class="rounded" id="imagePopup" style="overflow: scroll; display:none;background-repeat:no-repeat;border:0px solid black;position:fixed;height:80%;width:1100px;top:10%;left:10%;background:white;text-align:center;">
				<img class="rounded" src="" id="imgPopup" style="width:80%;margin: auto;height: 80%; margin-top: 20px;" />

						<div class="" style="text-align: left;width:80%;margin:auto;">
									<span style="font-size: x-large">
										<div class="text-info" id="username" style="text-decoration: none"><?php echo $value['username']?></div>
									</span>
									<div class="" id="photoname"style="font-weight:bold;color:#1bc70ff5;text-decoration: none; font-size: 25px;"><?php echo $value['pname']?></div>
									<div id="photodescription"style="width:100%;position: relative;font-size:20px;"> </div>
									<?php $count1=sql_query("select count(photo_id) as like_count from likes where photo_id={$value['pid']} "); 
										?>
										<div class="row"  style="margin-top:20px">
											<div class="col-md-11">
												<div class=""><h4><i class="fa fa-heart" <?php echo $path; ?> style="transition: color 0.5s;" onclick="fnDoLike(this)"> </i></h4></div>
											</div>
											<div class="col-md-1">
												<div class=""><h4><i class="fa fa-share" <?php echo $path; ?> style="transition: color 0.5s;" onclick="fnDoLike(this)"> </i></h4></div>
											</div>
										</div>
										<div style="margin-top:10px; margin-bottom:10px;" id="comment_area">
											
										</div>
								</div>
					<div  class="rounded" style="fixed; font-size:30px; border:2px solid black; border-radius:0px; padding-left:10px; padding-right:10px;  color:red;background:black;position:absolute; right:0px;top:0px; cursor:pointer;" onclick="this.parentElement.style.display='none'">
						<span style="font-weight:bold;">X</span>
					</div>
					
				</div>
		</div>
	</div>
		
<div>
	
<?php 
require "footer.php";
?>


<script type="text/javascript">
	
</script>

<script type="text/javascript">
	function fnDoLike(element, photo_id){
		element.style.color="red";
		$(element).attr("onclick", "fnDoUnlike(this,"+photo_id+")");
		console.log(element);
		$.ajax({
			url: "dataProvider.php",
			type: "POST",
			data:{
				doLike: true,
				photo_id: photo_id
			},
			success: function(data){
				
				if(data != "error")
				{
					window.count=JSON.parse(data);	
					$(element).next().text(count[0].like_count);
					
				}
				
			},
			error: function(err){
				console.log(err);
			}
		});
	}
	function fnDoUnlike(element,photo_id){
		element.style.color="black";
		$(element).attr("onclick", "fnDoLike(this,"+photo_id+")");
		console.log(element);
		$.ajax({
			url: "dataProvider.php",
			type: "POST",
			data:{
				doUnLike: true,
				photo_id: photo_id
			},
			success: function(data){
				if(data != "error")
				{
					window.count=JSON.parse(data);	
					$(element).next().text(count[0].like_count);
					
				}
			},
			error: function(err){
				console.log(err);
			}
		});
	}
	function fnDoFav(element, photo_id){
		element.style.color="red";
		element.onclick = fnDoUnlike.bind(null,element);
		$.ajax({
			url: "dataProvider.php",
			type: "POST",
			data:{
				doFav: true,
				photo_id: photo_id
			},
			success: function(data){
				console.log(data);
			},
			error: function(err){
				console.log(err);
			}
		});
	}

function fnDoUnfav(element, photo_id){
		element.style.color="red";
		element.onclick = fnDoUnlike.bind(null,element);
		$.ajax({
			url: "dataProvider.php",
			type: "POST",
			data:{
				doUnfav: true,
				photo_id: photo_id
			},
			success: function(data){
				console.log(data);
				var count=JSON.parse(data);
				$("love").append("<div>"+count.like+"</div>");
			},
			error: function(err){
				console.log(err);
			}
		});
	}

	function fnDoFollow(element, user_id){
		$("#following").show();
		$("#follow").hide();
		$.ajax({
			url: "dataProvider.php",
			type: "POST",
			data:{
				doFollow: true,
				user_id: user_id
			},
			success: function(data){
				if (data== "success")
					console.log(data);
			},
			error: function(err){
				console.log(err);
			}
		});

	}
		function fnDoUnfollow(element, user_id){
		$("#follow").show();
		$("#following").hide();
		$.ajax({
			url: "dataProvider.php",
			type: "POST",
			data:{
				doUnfollow: true,
				user_id: user_id
			},
			success: function(data){
				if (data== "success")
					console.log(data);
			},
			error: function(err){
				console.log(err);
			}
		});

	}
</script>
