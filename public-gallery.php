<?php 
require "header.php";


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
					$("#comment_button1").attr("onclick","writeComment1(this,"+photoId+")")
					loadCommentForOnePhoto(photoId);
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
		<div class="col-lg-2 	" >	
				<h3 style="cursor:pointer;" class="active"onclick="window.location='public-gallery.php';"><i class="fa fa-th"></i><?php echo " "?>listView</h3>
		</div>
		<div class="col-lg-2 ">	
				<h3 style="cursor:pointer;"onclick="window.location='public-gallery2.php';"><i class="fa fa-th-list"></i><?php echo " "?>detail</h3>
		</div>

    </div>
	  
	   <ol class="breadcrumb" style="background-color:#404042">
        <li class="breadcrumb-item">
          <a href="index.php" style="color:white">Home</a>
        </li>
        <li class="breadcrumb-item active"style="color:white">TimeLine</li>
        <h4 style="font-weight:bold; color:white;"><span onclick="fnShowHideSlideShow(this)" style="margin-left:900px;"><i class="fa fa-play"></i></span></h4>
      </ol>

	
	<div class="row">
        <?php 
        if(isset($_SESSION['userLogged']))
			$userPhotos=sql_query("SELECT users.id as uid, users.name as uname,  user_photos.description as description, user_photos.name as pname,user_photos.id as pid,username, (case when EXISTS(select * from likes where user_id={$_SESSION['userLogged']} and photo_id=user_photos.id) then 1 else 0 end) as isLiked from user_photos,users where user_photos.user_id = users.id order by user_photos.time desc");
		else
			$userPhotos=sql_query("SELECT users.id as uid, users.name as uname,  user_photos.description as description, user_photos.name as pname,user_photos.id as pid,username from user_photos,users where user_photos.user_id = users.id order by user_photos.time desc");
			//$userPhotos=sql_query("SELECT users.name as uname, user_photos.name as pname,user_photos.id as pid,username from user_photos,users where user_photos.user_id = users.id");
			foreach ($userPhotos as $key => $value) 
			{
				$var = sql_query("select users.username as uname, users.id as id from likes,users where likes.photo_id={$value['pid']} and  likes.user_id=users.id");
				$count=sql_query("select count(photo_id) as like_count from likes where photo_id={$value['pid']} ");
					echo '<div class="gallery col-lg-4 col-sm-6 portfolio-item">
								<div class="card h-100 rounded">
									<a href="my-gallery2.php?clicked-id='.$value['uid'].'" class="gallery-uname text-info" style="text-align:center;id="username" text-decoration:none;">'.$value['username'].'</a>
									<img class="card-img-top rounded" data-id="'.$value['pid'].'" data-desc="'.$value["description"].'" style="padding:10px" src="user_photos/png/'
										.$value['pid'].'.png" alt="error loading image">
									<div class="card-body">
										<h4 class="card-title">
											<div class="text-left" style="text-decoration:none;text-align:center;font-weight:bold; color:#1bc70ff5;">'.$value['pname'].'</div>
											<div class="row"  style="margin-top:10px">';
											if(isset($_SESSION['userLogged']))
											{
												if($value['isLiked'] == 1){
												echo '
												<div class="col-md-9">
													<div >
														<i class="fa fa-heart" style="transition: color 0.5s;color:red;" onclick="fnDoUnlike(this,'.$value['pid'].')"> </i>
														<span id="count" onclick="fnShowHideComment('.$value['pid'].')"style="cursor:pointer;">'.$count[0]['like_count'].' </span>
														<div class="rounded" id="like_show_'.$value['pid'].'" style="height:200px; width:330px;border:2px solid green;padding:10px; padding-left:18px; position:absolute; bottom:0px; left:0px;background:white;z-index:5; display:none; overflow-y:scroll;overflow-x:hidden;"><div style="width:225px;text-align: end;    margin-left: 53px;								color:red;cursor:pointer;" onclick="$(this).parent().hide(500);" >X</div>';
														
														foreach ($var as $key => $k)
														{
															echo '<div style="width:300px;margin:10px;" class="text-info"><img class="rounded-circle"style="height:35px; width:40px;" src="user_pics/'.$k['id'].'.png"><a style="margin-left:10px;text-decoration:none;color:#17a2b8;font-weight:bold;" href="my-gallery2.php?clicked-id='.$k['id'].'"">'.$k['uname'].'</a></div>';
														}
														echo '</div>
													</div>
													
												</div>';
											}
											else{
												echo '
													<div class="col-md-9">
														<div >
															<i class="fa fa-heart" style="transition: color 0.5s;" onclick="fnDoLike(this,'.$value['pid'].')"> </i>
															<span id="count" onclick="fnShowHideComment('.$value['pid'].')"style="cursor:pointer;">'.$count[0]['like_count'].' </span>
														<div class="rounded" id="like_show_'.$value['pid'].'" style="height:200px; width:330px;border:2px solid green;padding:10px; padding-left:18px; position:absolute; bottom:0px; left:0px;background:white;z-index:5; display:none; overflow-y:scroll;overflow-x:hidden;"><div style="width:225px;text-align:right;margin-right:10px;padding-right:10px;color:red;cursor:pointer;" onclick="$(this).parent().hide(500);" >X</div>';
														
														foreach ($var as $key => $k)
														{
															
															echo '<div style="width:300px;margin:10px;" class="text-info"><img class="rounded-circle"style="height:35px; width:40px;" src="user_pics/'.$k['id'].'.png"><a style="margin-left:10px;text-decoration:none;color:#17a2b8;font-weight:bold;" href="my-gallery2.php?clicked-id='.$k['id'].'"">'.$k['uname'].'</a></div>';
														}														
														echo '<div style="width:300px;margin:10px;" class="text-info"><img class="rounded-circle"style="height:35px; width:40px;" src="user_pics/'.$_SESSION['userLogged'].'.png"><a style="text-decoration:none;color:#17a2b8;font-weight:bold;" href="my-gallery2.php?clicked-id='.$_SESSION['userLogged'].'">You</a></div>
														</div>
													</div>
													
												</div>';
												}
											echo '
												<div class="col-md-3" id="divShareBtn_'.$value['pid'].'">
													<div class=""><i onclick="fnShowHideModal(true)" class="fa fa-share" style="transition: color 0.5s;" onclick="fnDoLike(this)"> </i>
													</div>													
												</div>
											</div>
											 </h4>
												<input type="text" id="comment_input"placeholder="Write a Comment..." style="font-weight:bold;width:200px;"><button onclick="writeComment(this,'.$value['pid'].')" id="comment_button"class="" style="border-radius:00px 30px 00px 10px;width:100px;float:right; background-color:#0e62ab;font-weight:bold;color:white">Comment</button>';
											}
											else
											{
												echo '
												<div class="col-md-9">
													<div ><i class="fa fa-heart" style="cursor:pointer;" onclick="locationa()"> </i>
															<span id="count" >'.$count[0]['like_count'].'</span></div>
												</div>
												<div class="col-md-3">
													<div class=""><i class="fa fa-share" style="transition: color 0.5s;" onclick="locationa()"> </i></div>
												</div>
												</h4>
												<input type="text" id="comment_input"placeholder="Write a Comment..." style="font-weight:bold;width:200px;"><button onclick="locationa()" id="comment_button" class="" style="border-radius:00px 30px 00px 10px;width:100px;float:right; background-color:#0e62ab;font-weight:bold;color:white">Comment</button>';
											}
									echo	'</div>
									  </div>
									</div>';
			}
		?></div>
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
										<input type="text" id="comment_input_div"placeholder="Write a Comment..." style="font-weight:bold;width:750px;"><button onclick="" id="comment_button1"class="" style="border-radius:00px 30px 00px 10px;width:100px;float:right; background-color:#0e62ab;font-weight:bold;color:white">Comment</button>
										<br>
								</div>
					<div  class="rounded" style="fixed; font-size:30px; border:2px solid black; border-radius:0px; padding-left:10px; padding-right:10px;  color:red;background:black;position:absolute; right:0px;top:0px; cursor:pointer;" onclick="this.parentElement.style.display='none'">
						<span style="font-weight:bold;">X</span>
					</div>
					
				</div>
		</div>
	</div>
	<div id="divSlideShow"style="">
		<img src="" id="imgSlideShow" />
		<div  class="rounded" style="fixed; font-size:30px; border:2px solid black; border-radius:0px; padding-left:10px; padding-right:10px;  color:red;background:black;position:absolute; right:0px;top:0px; cursor:pointer;" onclick="close_div()">
						<span style="font-weight:bold;">X</span>
					</div>
	</div>

	<div class="modal" id="divShareModal">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title">Share</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	        <div id="divShareDiv"></div>
	      </div>
	      
	    </div>
	  </div>
	</div>
	
	
	
	
<div>
<?php    
require "footer.php";
?>

<script type="text/javascript">
	$(document).ready(function(){
		$("#divShareDiv").jsSocials({
		    showLabel: false,
		    showCount: false,
		    shares: ["email", "twitter", "facebook", "googleplus", "linkedin", "pinterest", "stumbleupon", "whatsapp"]
		});

		fnStartSlideShow();
	});

	function fnShowHideModal(blnShown){
		$("#divShareModal").modal(blnShown?"show":"hide");
	}
	function fnShowHideComment(pid){
		$("#like_show_"+pid).show(500);
	}
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
function func(element){
	element.sibling
		$("#like_show").show();
}

function fnGetCurrentPhotos(){
	var aryImages = [];
	$(".card-img-top").each(function(){
		aryImages.push(this.src);
	});
	return aryImages;
}

function fnStartSlideShow(){
	var aryImages = fnGetCurrentPhotos();
	window.currentSlide = 0;
	fnChangeImage();
	window.intervalSlideShow = setInterval(fnChangeImage,5000);

	function fnChangeImage(){
		$("#imgSlideShow").css("opacity","0");
		setTimeout(function(){
			$("#imgSlideShow")[0].src = aryImages[window.currentSlide];
			fnGetNextSlide();
			$("#imgSlideShow").css("opacity","1");
		},1000);
	}
	function fnGetNextSlide(){
		if(window.currentSlide >= aryImages.length - 1)
			window.currentSlide = 0;
		window.currentSlide++;
		return window.currentSlide;
	}
}

function fnShowHideSlideShow(blnShown){
	if(blnShown)
		$("#divSlideShow").show(500);
	else
		$("#divSlideShow").hide(500);
}
function close_div()
{
	$("#divSlideShow").hide(500);
}
</script>


