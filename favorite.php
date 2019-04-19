<?php 
require_once "header.php";
require_once "is_logged.php";
$user=sql_query("select * from users where id={$_SESSION['userLogged']}");
$userPhotos=sql_query("SELECT users.name as uname, user_photos.name as pname,user_photos.id as pid,username, (case when EXISTS(select * from likes where user_id={$_SESSION['userLogged']} and photo_id=user_photos.id) then 1 else 0 end) as isLiked from user_photos,users where user_photos.user_id = users.id and user_id={$_SESSION['userLogged']}");


?>
<script src="js/jquery.js"></script>
			<script>
			$(document).ready(function(){
					$(".card-img-top").click(function(){
					$("#imagePopup").show(500);
					$("#imgPopup")[0].src = this.src;
				}); 

			});
		</script>
		<style>
			h3:hover{color:blue;}
		</style>
<div class="container">

	<!-- Page Heading/Breadcrumbs -->
	<div class="row" style="margin-top:20px">
		<div class="col-lg-3">
			<a href="profile.php"><img class="rounded-circle " style="border:8px solid #bebebf;height:245px;width:255px;" src="<?php echo $profilePic?>">	</a>
		</div>
			
			<div class="col-lg-5">
				<a href="#" class="text-info" style="text-align:center;font-size:40px; text-decoration:none;">
					<?php
						foreach ($user as $key => $value)
							echo $value['username'];
					?>
				</a >
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
					<a class="btn btn-primary" href="profile.php"style="display:none;color:black;width:250px;height:40px;margin-top:10px;margin-left:20px;font-weight:bold;font-size:20px; background-color:white; border:3px solid black;"  class="breadcrumb">
						Edit Profile
					</a>
					<a class="btn btn-primary" style="display:none;width:250px;height:40px;margin-top:10px;margin-left:20px;font-weight:bold;font-size:20px; background-color:#1380de;"  class="breadcrumb">
						FOLLOW
					</a>
					<a class="btn btn-primary" style="display:none;width:250px;height:40px;margin-top:10px;margin-left:20px;font-weight:bold;font-size:20px; background-color:#white;"  class="breadcrumb">
						FOLLOWING
					</a>
					<div class="row" style="margin-top:10px">
						<div class="col-lg-4" >
							<span style="font-weight:600; color:blue;">
								<?php
									$total_posts=sql_query("SELECT count(*) as pid from user_photos where user_id = {$_SESSION['userLogged']}");
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
									$total_posts=sql_query("SELECT count(*) as pid from user_photos where user_id = {$_SESSION['userLogged']}");
									foreach ($total_posts as $key => $value)
									{
										echo $value['pid'].' ';
								
									}
								?>
							</span>followers
						</div>
						
						<div class="col-lg-4" >
							<span style="font-weight:600; color:blue;">
								<?php
									$total_posts=sql_query("SELECT count(*) as pid from user_photos where user_id = {$_SESSION['userLogged']}");
									foreach ($total_posts as $key => $value)
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
		<div class="col-lg-5">
			<h1 class="" style="font-weight:bold; color:#2d2756;">Favorite</h1>
		</div>
		<div class="col-lg-2 	" >	
				<h3 style="cursor:pointer;"onclick="window.location='my-gallery.php';"><i class="fa fa-book"></i><?php echo " "?>Gallery</h3>
		</div>
		<div class="col-lg-2 ">	
				<h3 style="cursor:pointer;"onclick="window.location='love.php';"><i class="fa fa-heart"></i><?php echo " "?>Loves</h3>
		</div>
		<div class="col-lg-3 ">	
				<h3 style="cursor:pointer;"onclick="window.location='favorite.php';"><i class="fa fa-bookmark"></i><?php echo " "?>Favorite</h3>
		</div>

    </div>
	<ol class="breadcrumb"style="background-color:#404042">
		<li class="breadcrumb-item">
			<a href="index.php"style="color:white">Home</a>
		</li>
		<li class="breadcrumb-item active"style="color:white">Favorite</li>
	</ol>
	<!---gallery making-->
	<div class="row">
      	<?php 
			
			foreach ($userPhotos as $key => $value)
			{
				echo '<div class="gallery col-lg-4 col-sm-6 portfolio-item">
			          <div class="card h-100 rounded">
		                <a href="#" class="text-info" style="text-align:center;id="username" text-decoration:none;">'.$value['username'].'</a>
			            <img class="card-img-top rounded" style="padding:10px" src="user_photos/png/'
			            .$value['pid'].'.png" alt="error loading image">
			            <div class="card-body">
			              <h4 class="card-title">
			                <a href="#" class="text-left card-img-top" style="text-decoration:none;text-align:center;font-weight:bold; color:#1bc70ff5;">'.$value['pname'].'</a>
			                <div class="row"  style="margin-top:20px">';
			                if($value['isLiked'] == 1){
			                	echo '
								<div class="col-md-3">
									<div class="love"><i class="fa fa-heart" style="transition: color 0.5s;color:red;" onclick="fnDoUnlike(this,'.$value['pid'].')"> </i></div>
								</div>';
			                }
			                else{

			                echo '
								<div class="col-md-3">
									<div class="love"><i class="fa fa-heart" style="transition: color 0.5s;" onclick="fnDoLike(this,'.$value['pid'].')"> </i></div>
								</div>';
			                }

							echo '
								<div class="col-md-3">
									<div class=""><i class="fa fa-comments" style="transition: color 0.5s;" onclick="fnDoLike(this)"> </i></div>
								</div>
								<div class="col-md-3">
									<div class=""><i class="fa fa-share-alt" style="transition: color 0.5s;" onclick="fnDoLike(this)"> </i></div>
								</div>
								<div class="col-md-3">
									<div class=""><i class="fa fa-bookmark" style="transition: color 0.5s;" onclick="fnDoLike(this)"> </i></div>
								</div>
			                </div>
			              </h4>
			            </div>
			          </div>
			        </div>';
			}
		?>
    </div>
	<!----cross-->
	<div class="rounded" id="imagePopup" style="overflow: scroll; display:none;background-repeat:no-repeat;border:0px solid black;position:fixed;height:80%;width:1100px;top:10%;left:10%;background:white;text-align:center;">
				<img class="rounded" src="" id="imgPopup" style="width:80%;margin: auto;height: 80%; margin-top: 20px;" />

						<div class="" style="text-align: left;width:80%;margin:auto;">
									<span style="font-size: x-large;text-align: center;">
										<a href="#" class="text-info" id="username" style="text-decoration: none"><?php echo $value['username']?></a>
									</span>
									<br>
									<a href="#" class="" id="photoname"style="font-weight:bold;color:#1bc70ff5;text-decoration: none; font-size: 25px;"><?php echo $value['pname']?></a>
									<div style="height: 75%;position: relative;"> {value wala div}</div>
										<div class="row"  style="margin-top:20px">
											<div class="col-md-3">
												<div class=""><i class="fa fa-heart" style="transition: color 0.5s;" onclick="fnDoLike(this)"> </i></div>
											</div>
											<div class="col-md-3">
												<div class=""><i class="fa fa-comments" style="transition: color 0.5s;" onclick="fnDoLike(this)"> </i></div>
											</div>
											<div class="col-md-3">
												<div class=""><i class="fa fa-share-alt" style="transition: color 0.5s;" onclick="fnDoLike(this)"> </i></div>
											</div>
											<div class="col-md-3">
												<div class=""><i class="fa fa-bookmark" style="transition: color 0.5s;" onclick="fnDoLike(this)"> </i></div>
											</div>
										</div>
								</div>
					<div  class="rounded" style="fixed; font-size:30px; border:2px solid black; border-radius:0px; padding-left:10px; padding-right:10px;  color:red;background:black;position:fixed; top:10%;right:7%;; cursor:pointer;" onclick="this.parentElement.style.display='none'">
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
        url: "dataProvider.php",
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

<script type="text/javascript">
	function fnDoLike(element, photo_id){
		element.style.color="red";
		element.onclick = fnDoUnlike.bind(null,element);
		$.ajax({
			url: "dataProvider.php",
			type: "POST",
			data:{
				doLike: true,
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
	function fnDoUnlike(element,photo_id){
		element.style.color="black";
		element.onclick = fnDoLike.bind(null,element);
		$.ajax({
			url: "dataProvider.php",
			type: "POST",
			data:{
				doUnLike: true,
				photo_id: photo_id
			},
			success: function(data){
				console.log(data);
			},
			error: function(err){
				console.log(err);
			}
		});
		console.log("unklije");
	}

</script>
