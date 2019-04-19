<?php 
require "header.php";
?>
	<style>
	.gallery
			{
				border:2px solid white;height:30%;width:32.95%;
				float:left;
				background-image:url(images/BackgroundImage.jpg);
				background-size:100% 100%;
				background-repeat:no-repeat;
			}
	</style>
	<script src="js/jquery.js"></script>
		<script>
			$(document).ready(function(){
				$(".card-img-top").click(function(){
				$("#imagePopup").css({
					"background-image":"url("+ this.src+")",
						"background-size": "100% 100%",
						"background-repeat":"no-repeat"
						}).show(500);
				}); 
			});
		</script>
		<style>
			h3:hover{
				transition: color 0.5s;
				transition: font-size 1.5s;
				color:red;
				font-size:34px;
				font-weight:0.5s;
				font-weight:bold;
				}
		</style>
<div class="container">
	<!-- Page Heading/Breadcrumbs -->
      <div class="row" style="margin-top:20px">
		<div class="col-lg-8">
			<h1 class="" style="font-weight:bold; color:#2d2756;">TimeLine</h1>
		</div>
			<div class="col-lg-2 ">	
				<h3 style="cursor:pointer;"onclick="window.location='public-gallery2.php';"><i class="fa fa-th-list"></i><?php echo " "?>detail</h3>
		</div>
		<div class="col-lg-2 	" >	
				<h3 style="cursor:pointer;" class="active"onclick="window.location='public-gallery.php';"><i class="fa fa-th"></i><?php echo " "?>listView</h3>
		</div>

    </div>
	   <ol class="breadcrumb" style="background-color:#404042">
        <li class="breadcrumb-item">
          <a href="index.php" style="color:white">Home</a>
        </li>
        <li class="breadcrumb-item active"style="color:white">TimeLine</li>
      </ol>

	
	<div class="row">
        <?php 
			 if(isset($_SESSION['userLogged']))
			$userPhotos=sql_query("SELECT users.id as uid, users.name as uname,  user_photos.description as description, user_photos.name as pname,user_photos.id as pid,username, (case when EXISTS(select * from likes where user_id={$_SESSION['userLogged']} and photo_id=user_photos.id) then 1 else 0 end) as isLiked from user_photos,users where user_photos.user_id = users.id order by user_photos.time desc");
		else
			$userPhotos=sql_query("SELECT users.id as uid, users.name as uname,  user_photos.description as description, user_photos.name as pname,user_photos.id as pid,username from user_photos,users where user_photos.user_id = users.id order by user_photos.time desc");
			foreach ($userPhotos as $key => $value) {
				$count=sql_query("select count(photo_id) as like_count from likes where photo_id={$value['pid']} ");
				echo '<div class="gallery col-lg-12 portfolio-item container" >
							<div class="row rounded"style="border: 10px solid;">
								<div class="col-md-8"style="">
									<img class="card-img-top rounded" style="height:500px;margin-top:10px;margin-bottom:10px;padding:10px" src="user_photos/png/'.$value['pid'].'.png" alt="error loading image">
								</div>

								<div class="card-body col-md-4" style="">
									<span style="font-size: x-large;text-align: center;">
										<a href="my-gallery2.php?clicked-id='.$value['uid'].'" class="text-info" style=" font-size:38px;  text-decoration: none">'.$value['username'].'</a>
									</span>
									<br>
									<div class="" style="font-weight:bold;color:#1bc70ff5;text-decoration: none; font-size: 25px;">'.$value['pname'].'</div>
									<div style="height: 30%;position: relative;font-size:22px;width:320px;text-decoration:none;font-weight:bold; color:#232108f5;overflow: scroll;"> '.$value['description'].'</div>
									<div style="height: 30%;position: relative;font-size:22px;width:320px;text-decoration:none;font-weight:bold; color:#232108f5;overflow: scroll;"id="comment_area"></div>
										<h4>
											<div class="row"  style="margin-top:20px">';
											if(isset($_SESSION['userLogged']))
											{
												if($value['isLiked'] == 1){
												echo '
												<div class="col-md-9">
													<div ><i class="fa fa-heart" style="transition: color 0.5s;color:red;" onclick="fnDoUnlike(this,'.$value['pid'].')"> </i>
														<span id="count">'.$count[0]['like_count'].'</span></div>
												</div>';
											}
											else{
												echo '
													<div class="col-md-9">
														<div ><i class="fa fa-heart" style="transition: color 0.5s;" onclick="fnDoLike(this,'.$value['pid'].')"> </i>
														<span id="count">'.$count[0]['like_count'].'</span></div>
													</div>';
												}
											echo '
												<div class="col-md-3">
													<div class=""><i class="fa fa-share" style="" onclick="fnDoLike(this)"> </i></div>
												</div>
											</div>
											 </h4>
												<input type="text" id="comment_input"placeholder="Write a Comment..." style="font-weight:bold;width:200px;"><button id="comment_button"class="" style="border-radius:00px 30px 00px 10px;width:100px;float:right; background-color:#0e62ab;font-weight:bold;color:white">Comment</button>';
											}
											else
											{
												echo '
													<div class="col-md-9">
													<div ><i class="fa fa-heart" style="" onclick="locationa()"> </i></div>
												</div>
												<div class="col-md-3">
													<div class=""><i class="fa fa-share" style="" onclick="locationa()"> </i></div>
												</div>
												</h4>
												<input type="text" id="comment_input"placeholder="Write a Comment..." style="font-weight:bold;width:200px;"><button onclick="locationa()" id="comment_button"class="" style="border-radius:00px 30px 00px 10px;width:100px;float:right; background-color:#0e62ab;font-weight:bold;color:white">Comment</button>';
											}
									echo	'</div>
									  </div>
									</div>';
			}
		?>
		<div class="rounded"id="imagePopup" style="border:15px solid black;display:none;background-size:100% 100%;background-repeat:no-repeat;position:fixed;height:90%;width:86%;top:10%;left:7%;background:white;">
					<div class="rounded"style="font-size:30px; border:2px solid black; border-radius:0px; padding-left:10px; padding-right:10px;  color:red;background:black;position:absolute; right:15px;top:0px; cursor:pointer;" onclick="this.parentElement.style.display='none'">
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
	function locationa(){
			window.location='login.php';
			}
</script>
