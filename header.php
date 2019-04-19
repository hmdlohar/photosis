<?php 
require_once "dbfiles/db.php";
if(isset($_SESSION['userLogged']))
{
	$rrs=sql_query("select gender from users where id={$_SESSION['userLogged'] }");
	if($rrs[0]['gender']=='1')
		$profilePicPath="user_pics/emptyProfile.png";
	else
		$profilePicPath="user_pics/emptyfemale.png";
		if(isset($_SESSION['userLogged'])){
			if(is_file("user_pics/{$_SESSION['userLogged']}.png")){
				$profilePicPath="user_pics/{$_SESSION['userLogged']}.png";
		}
	}
}



?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="description" content="">
		<meta name="author" content="">
		<link rel = "icon" type = "image/png" href = "img/hqdefault.jpg">
		<title>photOsis - Just Edit & Share</title>
		
		<!-- Bootstrap core CSS -->
		<link href="css/test/bootstrap.min (10).css" rel="stylesheet">
		<link href="vendor/font-awesome/css/all.css" rel="stylesheet">
		<link href="css/notie.min.css" rel="stylesheet">
		
		<!-- Custom styles for this template -->
		<link href="css/modern-business.css" rel="stylesheet">
		<link href="css/style.css" rel="stylesheet">
		<script src="js/notie.min.js"></script>
		

		<link type="text/css" rel="stylesheet" href="vendor/jssocials/jssocials.css" />
		<link type="text/css" rel="stylesheet" href="vendor/jssocials/jssocials-theme-flat.css" />
	</head>
	<body>
		<!-- Navigation -->
		<nav style="background-color:black; border-bottom:3px solid gold"class="navbar fixed-top navbar-expand-lg navbar-dark fixed-top" >
			<div class="container"> 
				<a class="navbar-brand" href="index.php">
					<img style="height:35px;width:55px" src="img/hqdefaulta.jpg">
					<span style="font-weight:bold;color:gold; font-size:20px;">photOsis</span>
				</a>
					<!-- Button Adding have confusion -->
					
				<div class="collapse navbar-collapse nav-collapse" id="navbarResponsive" id="nav-collapse">
				<ul class="navbar-nav ml-auto nav" id="nav">
					<li class="nav-item" style="margin-top:7px; margin-right:90px;">						
						<input type="text"  id="search_input"  placeholder="Username or Name..."style="border:2px solid black;border-radius:5px 5px 05px 05px;left:28%;display:none;background-color:white; height:30px; width:225px;">
						<!--button id="search_button" style="display:none;"><i class="fa fa-search"style="background-color:white; width:20px"></i></button-->
						<div id="search_div" class="" style="display:none;border:2px solid black;width:225px;border-radius:005px 005px 05px 5px;width:225px;left:28%;background:white;text-align:center;cursor:pointer;"><i class="fa fa-search"style="background-color:white; width:20px"></i>Username or Name...
						</div><?php
						if(isset($_SESSION['userLogged'])){
						echo '<div id="search_value" style="display:none;border:2px solid black;width:225px;border-radius:00px 00px 15px 15px;width:225px;left:28.5%;background:white;position:fixed;"></div>';
					}
					else{
						echo '<div id="search_value" style="display:none;border:2px solid black;width:225px;border-radius:00px 00px 15px 15px;width:225px;left:32.5%;background:white;position:fixed;"></div>';
						}
						?>
					</li>
					
					<li class="nav-item active">
					  <a class="nav-link" href="public-gallery.php">TimeLine</a>
					</li>
					<li class="nav-item active">
					  <a class="nav-link" href="features.php">Features</a>
					</li>
					<?php 
						if(isset($_SESSION['userLogged']))
						{
							echo '<li class="nav-item active">
									  <a class="nav-link" href="ieditor.php">iEditor</a>
									</li>';
						}
						else
						{
							echo '<li class="nav-item active">
									  <a class="nav-link" href="login.php">iEditor</a>
									</li>';
						}
					?> 		
					<li class="nav-item active">
					  <a class="nav-link" href="about.php">About</a>
					</li>
					<li class="nav-item">
					  <a class="nav-link" href="contact.php">Contact</a>
					</li>
					
					<?php 
						if(isset($_SESSION['userLogged']))
						{
					?>
						<li class="nav-item active">
						  <a class="nav-link" href="my-gallery.php">My Gallery</a>
						</li><li class="nav-item active">
						  <a class="nav-link" href="logout.php">Logout</a>
						</li>
					<?php
						}
						else
						{
					?>
						<li class="nav-item active">
						  <a class="nav-link" href="login.php">Login</a>
						</li>
						<li class="nav-item active">
						  <a class="nav-link" href="register.php">Register</a>
						</li> 
					<?php
						}
					?>  				 
						<li  style="width:10px"></li>
					<?php 
						if(isset($_SESSION['userLogged']))
						{
							$userData=sql_query("select profile_pic_status from users where id={$_SESSION['userLogged']}");
							if($userData[0]['profile_pic_status']==0)
							{
								echo '<li class="active nav-item">
											<a href="login.php"><img class="rounded-circle " style="height:45px;width:55px" src='." $profilePicPath".'>	</a>
										</li>';
							}
							else{
									$profilePic="user_pics/{$_SESSION['userLogged']}.png";
									echo '<li class="active nav-item">
												<a href="profile.php"><img class="rounded-circle " style="height:45px;width:55px" src='." $profilePic".'>	</a>
											</li>';
							}
						}
						else
						{
							$profilePic="user_pics/emptyProfile.png";
							echo '<li class="nav-item active">
										<a href="login.php"><img class="rounded-circle " style="height:45px;width:55px" src='." $profilePic".'>	</a>
									</li>';
						}
						if(isset($_SESSION['userLogged']))
						{
							echo '<li class="nav-item active">
									  <div class="nav-link fa " style="cursor:pointer;" onclick="fnShowHideModal1(true)"><div style="padding=10px;"class="fa-bell"></div></div>
									  <div id="noti_value" style="display:none;border:2px solid black;border-radius:5px 5px 10px 10px;width:225px;left:83.3%;top:64px;background:#0159fbf2;position:fixed;">ss</div>
									</li> ';
						}
					?> 
					
						        
					
					</ul>
				</div>
			</div>
		</nav>

	<div class="modal" id="divNotiModal">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header" style="background-color:#559df7ff;">
	        <h5 class="modal-title" style="color:white;">Notification</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
			<ul class="nav nav-tabs">
	      
			  <li class="nav-item">
			    <a class="nav-link active" data-toggle="tab" href="#likes">Likes</a>
			  </li>
			  <li class="nav-item">
			    <a class="nav-link" data-toggle="tab" href="#comments">Comments</a>
			  </li>
			  <li class="nav-item">
			    <a class="nav-link" data-toggle="tab" href="#follows">Follows</a>
			  </li>
			  
			</ul>
			<div id="divTabContent" class="tab-content" >
			  <div class="tab-pane fade active show" id="likes">
			    <ul class="list-group" style="max-height:300px; overflow-y: scroll;">
			    	<?php
				      $allLikes = sql_query("select photo_id, time, (select username from users where id=likes.user_id) as uname,(select id from users where id=likes.user_id) as uid from likes where likes.notify_status = 0 and likes.photo_id in(select id from user_photos where user_id={$_SESSION['userLogged']}) order by time desc");
				      if(count($allLikes)<=0)
				      {
						  echo '<li class="list-group-item d-flex justify-content-between align-items-center"style="color:red"> No Notifications... </li>';
						}
						else{
							foreach ($allLikes as $key => $value) {
								echo '<li class="list-group-item d-flex justify-content-between align-items-center">
									<img style="height:40px;width:40px;" class="rounded" src="user_photos/png/'.$value['photo_id'].'.png" alt="Photo" /> <a href="my-gallery2.php?clicked-id='.$value['uid'].'">'.$value['uname'].'</a> Liked Your Photo 
									<span class="badge badge-primary badge-pill">'. convertDateToAgo($value["time"]) .'</span>
								  </li>';
							}
						}
				      ?>				 
				</ul>
			  </div>
			  <div class="tab-pane fade" id="comments">
			    <ul class="list-group" style="max-height:300px; overflow-y: scroll;">
			    	<?php
				      $allComments = sql_query("select photo_id, (select username from users where id=comments.user_id) as uname,(select id from users where id=comments.user_id) as uid from comments where notify_status = 0 and photo_id in(select id from user_photos where user_id={$_SESSION['userLogged']}) order by time desc");
				         if(count($allComments)<=0)
				      {
						  echo '<li class="list-group-item d-flex justify-content-between align-items-center"style="color:red"> No Notifications... </li>';
						}
						else{
				      	foreach ($allComments as $key => $value) {
				      		echo '<li class="list-group-item d-flex justify-content-between align-items-center">
							    <img style="height:40px;width:40px;" class="rounded" src="user_photos/png/'.$value['photo_id'].'.png" alt="Photo" /> <a href="my-gallery2.php?clicked-id='.$value['uid'].'">'.$value['uname'].'</a> Commented On Your Photo
							    <span class="badge badge-primary badge-pill">2 Hours Ago</span>
							  </li>';
				      	}
					}
				      ?>
				  
				</ul>
			  </div>
			  <div class="tab-pane fade" id="follows" >
			   <ul class="list-group" style="max-height:300px; overflow-y: scroll;">
			   	<?php
				      
				      $allFollows = sql_query("select users.username as username, follow.user_id as user_id, follow.follower_id as follower_id from follow,users where follow.user_id={$_SESSION['userLogged']} and follow.follower_id=users.id order by follow.time desc");
				          if(count($allFollows)<=0)
				      {
						  echo '<li class="list-group-item d-flex justify-content-between align-items-center" style="color:red"><center> No Notifications... </center></li>';
						}
						else{
				      	foreach ($allFollows as $key => $value) {
				      		echo '<li class="list-group-item d-flex justify-content-between align-items-center">
							    <a href="my-gallery2.php?clicked-id='.$value['user_id'].'">'.$value['username'].'</a> Followed You
							    <span class="badge badge-primary badge-pill">2 Hours Ago</span>
							  </li>';
				      	}
					}
				      ?>
				  
				</ul>
			  </div>
			 
			</div>
	      </div>
	      
	    </div>
	  </div>
	</div>
	</body>
<div  id="loader">
	<div class="loader"></div>
</div>
</body>
</html>

</html>

<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript">
		$(document).ready(function(){
			$("#search_input").on("input",function(){
					var input_value=document.getElementById("search_input").value;
					if(input_value.length==0)
					{
							$("#search_value").empty();
							$("#search_value").append("<div style=' width:225px;text-align:right;margin-right:10px;padding-right:10px;color:red;cursor:pointer;'onclick='searc()' >cancel</div>");
							$("#search_value").append("<div style=' width:225px;text-align:right;margin-right:10px;padding-right:10px;color:red;cursor:pointer;'onclick='searc()' >Please enter something to search</div>");
							$("#search_value").show();		
					}
					$.ajax({
						url: "dataProvider.php",
						type:"POST",
						data:{
							search:"true",
							sear : input_value
							},
							success : function(data){
								if (data!="userNotFound"){
									window.items=JSON.parse(data);
									

									$("#search_value").empty();
									$("#search_value").append("<div style=' width:225px;text-align:right;margin-right:10px;padding-right:10px;color:red;cursor:pointer;'onclick='searc()' >cancel</div>");
									for(c of items){
										$("#search_value").append("<div style='height:45px; width:225px;' ><a style='cursor:pointer;margin-top:10px;color:#17a2b8;text-decoration:none;margin-left:15px;'href='my-gallery2.php?clicked-id="+c.id+"'><img  class='rounded-circle' style='height:35px;width:35px' src='"+c.fav_quote2+"'>"+c.username+"</a></div>");
										}
										$("#search_value").show();				
									}	
								else{
									$("#search_value").empty();
									$("#search_value").append("<div style=' width:225px;text-align:right;margin-right:10px;padding-right:10px;color:red;cursor:pointer;'onclick='searc()' >cancel</div>");
									$("#search_value").append("<div style='height:30px; width:225px;text-align:center;color:red;'>User Does not  Exist...</div>");
									$("#search_value").show();
								}							
							},
							error:function(err){
								console.log(err);
										return;
										console.log(err.responseText);
							}						
						});
				});
			});
		$(document).ready(function(){
			$("#search_div").show();
			$("#search_div").click(function(){
				$("#search_div").hide();
				$("#search_input").show();
				$("#search_input").focus();
				
			});
		});
		function searc(){
			$("#search_value").hide();
		}
		function noti(){
			$("#noti_value").hide();
		}
			function actionNotiLike(){		
			$.ajax({
						url: "dataProvider.php",
						type:"POST",
						data:{
							notify_like:"true"
							},
							success : function(data){
								if (data !="nothing"){
									window.items=JSON.parse(data);		
									$("#noti_value").empty();
									$("#noti_value").append("<div><span onclick=''actionNotiLike()'>Likes</span><span onclick=''actionNotiComment()'>Comments</span><span onclick=''actionNotiFollow()'>Follows</span><span style=' width:225px;text-align:right;margin-right:10px;padding-right:10px;color:red;cursor:pointer;'onclick='noti()' >cancel</span></div>");
									for(c of items){
										var timee=convertDateToAgo(c.time);
										$("#noti_value").append("<div style='height:45px; width:225px;' ><a style='cursor:pointer;margin-top:10px;color:#17a2b8;text-decoration:none;margin-left:15px;'href='my-gallery2.php?clicked-id="+c.follower_id+"'><img  class='rounded-circle' style='height:35px;width:35px' src='user_pics/"+c.follower_id+".png'>"+c.username+"started following you<span style='color:#6f6f6f' >"+timee+"</span></a></div>");
										}
										$("#noti_value").show();				
									}	
								else{
									$("#noti_value").empty();
									$("#noti_value").append("<div style=' width:225px;text-align:right;margin-right:10px;padding-right:10px;color:red;cursor:pointer;'onclick='noti()' >cancel</div>");
									$("#noti_value").append("<div style='height:30px; width:225px;text-align:center;color:red;'>No Notification...</div>");
									$("#noti_value").show();
								}							
							},
							error:function(err){
								console.log(err);
										return;
										console.log(err.responseText);
							}						
						});
						
		}
		function actionNotiFollow(){		
			$.ajax({
						url: "dataProvider.php",
						type:"POST",
						data:{
							notify_follow:"true"
							},
							success : function(data){
								if (data !="nothing"){
									window.items=JSON.parse(data);		
									$("#noti_value").empty();
									$("#noti_value").append("<div><span onclick=''actionNotiLike()'>Likes</span><span onclick=''actionNotiComment()'>Comments</span><span onclick=''actionNotiFollow()'>Follows</span><span style=' width:225px;text-align:right;margin-right:10px;padding-right:10px;color:red;cursor:pointer;'onclick='noti()' >cancel</span></div>");
									for(c of items){
										var timee=convertDateToAgo(c.time);
										$("#noti_value").append("<div style='height:45px; width:225px;' ><a style='cursor:pointer;margin-top:10px;color:#17a2b8;text-decoration:none;margin-left:15px;'href='my-gallery2.php?clicked-id="+c.follower_id+"'><img  class='rounded-circle' style='height:35px;width:35px' src='user_pics/"+c.follower_id+".png'>"+c.username+"started following you<span style='color:#6f6f6f' >"+timee+"</span></a></div>");
										}
										$("#noti_value").show();				
									}	
								else{
									$("#noti_value").empty();
									$("#noti_value").append("<div style=' width:225px;text-align:right;margin-right:10px;padding-right:10px;color:red;cursor:pointer;'onclick='noti()' >cancel</div>");
									$("#noti_value").append("<div style='height:30px; width:225px;text-align:center;color:red;'>No Notification...</div>");
									$("#noti_value").show();
								}							
							},
							error:function(err){
								console.log(err);
										return;
										console.log(err.responseText);
							}						
						});
						
		}
	
		function actionNotiComment(){		
			$.ajax({
						url: "dataProvider.php",
						type:"POST",
						data:{
							notify_comment:"true"
							},
							success : function(data){
								if (data !="nothing"){
									window.items=JSON.parse(data);		
									$("#noti_value").empty();
									$("#noti_value").append("<div><span onclick=''actionNotiLike()'>Likes</span><span onclick=''actionNotiComment()'>Comments</span><span onclick=''actionNotiFollow()'>Follows</span><span style=' width:225px;text-align:right;margin-right:10px;padding-right:10px;color:red;cursor:pointer;'onclick='noti()' >cancel</span></div>");
									for(c of items){
										var timee=convertDateToAgo(c.time);
										$("#noti_value").append("<div style='height:45px; width:225px;' ><a style='cursor:pointer;margin-top:10px;color:#17a2b8;text-decoration:none;margin-left:15px;'href='my-gallery2.php?clicked-id="+c.follower_id+"'><img  class='rounded-circle' style='height:35px;width:35px' src='user_pics/"+c.follower_id+".png'>"+c.username+"started following you<span style='color:#6f6f6f' >"+timee+"</span></a></div>");
										}
										$("#noti_value").show();				
									}	
								else{
									$("#noti_value").empty();
									$("#noti_value").append("<div style=' width:225px;text-align:right;margin-right:10px;padding-right:10px;color:red;cursor:pointer;'onclick='noti()' >cancel</div>");
									$("#noti_value").append("<div style='height:30px; width:225px;text-align:center;color:red;'>No Notification...</div>");
									$("#noti_value").show();
								}							
							},
							error:function(err){
								console.log(err);
										return;
										console.log(err.responseText);
							}						
						});
						
		}
		function convertDateToAgo(date){
			var dateNow = new Date();
			var dateThen = new Date(date);
			var dateDiffInSec = ( dateNow.getTime() -dateThen.getTime()) / 1000;	
			console.log(dateNow,dateThen,dateDiffInSec);
			if(dateDiffInSec < 6 ){
				return " Just Now";
			}
			else if(dateDiffInSec < 60 && dateDiffInSec > 10){
				return Math.floor(dateDiffInSec) + " Second Ago";
			}
			else if(dateDiffInSec > 60 && dateDiffInSec < 3600){
				return Math.floor(dateDiffInSec / 60) + " Minutes Ago";
			}
			else if(dateDiffInSec > 60 && dateDiffInSec < (3600 * 24)){
				return Math.floor((dateDiffInSec / 60) /60) + " Hours Ago";
			}
			else if(dateDiffInSec > 3600 ){
				return Math.floor(dateDiffInSec / 60 /60 /24) + " Days Ago";
			}
			return "wrong";
		}
	function fnShowHideModal1(blnShown){
		$("#divNotiModal").modal(blnShown?"show":"hide");
	}
</script>		
