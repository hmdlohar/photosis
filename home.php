<?php 
require_once "header.php";
require_once "is_logged.php";

	$profilePicPath="img/emptyProfile.png";
	//if(isLogged()){
		//if(is_file("user_pics/{$_SESSION['userLogged']}.png")){
			//$profilePicPath="user_pics/{$_SESSION['userLogged']}.png";
		//}
	//}	
	
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
<div class="container">

	<!---gallery making-->
	<div class="row" style="margin-top:20px; margin-bottom:20px">
		<div class="col-sm-4">
			<img src="<?php echo $profilePicPath; ?>" id="imgProfilePic" style="margin-top:20px;"class="img-fluid rounded d-block">
		</div>
		<div class="col-sm-8">
			<?php
			$user=sql_query("select username from users where id={$_SESSION['userLogged']}");
			echo "$user[0]['username']";
			?>
		</div>
	</div>
	
	<hr><h1 class="my-4" style="font-weight:bold; color:#2d2756;">My Gallery</h1>
		<div class="row">
      	<?php 
		$userPhotos=sql_query("SELECT users.name as uname, user_photos.name as pname,user_photos.id as pid,username from user_photos,users where user_photos.user_id = users.id and user_id={$_SESSION['userLogged']}");
		$users=sql_query("select * from users where user_id={$_SESSION['userLogged']}");
			foreach ($userPhotos as $key => $value)
			{
				echo '<div class="gallery col-lg-4 col-sm-6 portfolio-item">
			          <div class="card h-100 rounded">
		                <a href="#" class="text-info" style="text-align:center; text-decoration:none;">'.$value['username'].'</a>
			            <img class="card-img-top rounded" style="padding:10px" src="user_photos/png/'
			            .$value['pid'].'.png" alt="error loading image">
			            <div class="card-body">
			              <h4 class="card-title">
			                <a href="#" class="text-left card-img-top" style="text-decoration:none;text-align:center;font-weight:bold; color:#1bc70ff5;">'.$value['pname'].'</a>
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
									<div class=""><i class="fa fa-save" style="transition: color 0.5s;" onclick="fnDoLike(this)"> </i></div>
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
										<a href="#" class="text-info" style="text-decoration: none">'.$value['username'].'</a>
									</span>
									<br>
									<a href="#" class="" style="font-weight:bold;color:#1bc70ff5;text-decoration: none; font-size: 25px;">'.$value['pname'].'</a>
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
	function fnDoLike(element){
		element.style.color="red";
		element.onclick = fnDoUnlike.bind(null,element);

	}
	function fnDoUnlike(element){
		element.style.color="black";
		element.onclick = fnDoLike.bind(null,element);
	}
</script>
