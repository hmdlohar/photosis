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
<div class="container">

	<!-- Page Heading/Breadcrumbs -->
      <h1 class="my-4" style="font-weight:bold;">The Timeline</h1>
	  
	   <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="index.php">Home</a>
        </li>
        <li class="breadcrumb-item active">TimeLine</li>
      </ol>

	
	<div class="row">
        <?php 
			$userPhotos=sql_query("SELECT users.name as uname, user_photos.name as pname,user_photos.id as pid,username from user_photos,users where user_photos.user_id = users.id");
			foreach ($userPhotos as $key => $value) {
				// print_r($value);
				// return;
				echo '<div class="gallery col-lg-4 col-sm-6 portfolio-item">
			          <div class="card h-100">
		                <span  class="text-info">'.$value['username'].'</span>
			            <img class="card-img-top" src="user_photos/png/'
			            .$value['pid'].'.png" alt="error loading image"></a>
			            <div class="card-body">
			              <h4 class="card-title">
			                <a href="#" class="text-left">'.$value['pname'].'</a>
			                <div class="text-right"><i class="fa fa-heart" style="transition: color 0.5s;" onclick="fnDoLike(this)"> </i></div>
			                <div class=""><i class="fa fa-comment" style="transition: color 0.5s;" onclick="fnDoLike(this)"> </i></div>
			                <div class=""><i class="fa fa-comments" style="transition: color 0.5s;" onclick="fnDoLike(this)"> </i></div>
			                <div class=""><i class="fa fa-share-alt" style="transition: color 0.5s;" onclick="fnDoLike(this)"> </i></div>
			                <div class=""><i class="navbar-toggler-icon" style="transition: color 0.5s;" onclick="fnDoLike(this)"> </i></div>
			              </h4>
			            </div>
			          </div>
			        </div>';
			}
		?>
          
		<div id="imagePopup" style="display:none;background-size:100% 100%;background-repeat:no-repeat;border:6px solid black;position:fixed;height:80%;width:80%;top:10%;left:10%;background:white;">
					<div style="font-size:30px; border:2px solid black; border-radius:0px; padding-left:10px; padding-right:10px;  color:red;background:black;position:absolute; right:0px;top:0px; cursor:pointer;" onclick="this.parentElement.style.display='none'">
						<span style="font-weight:bold;">X</span>
					</div>
				</div>
		</div>
	
		
<div>
<?php 
require "footer.php";
?>

<script type="text/javascript">
	function fnDoLike(element){
		element.style.color="red";
		element.onclick = fnDoUnlike.bind(null,element);

	}
	function fnDoUnlike(element){
		element.style.color="black";
		element.onclick = fnDoLike.bind(null,element);
	}
</script>