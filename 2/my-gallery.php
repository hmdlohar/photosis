<?php 
require_once "header.php";
require_once "is_logged.php";
?>
<script src="js/jquery.js"></script>
<script>
	$(document).ready(function(){
		$(".gallery").click(function(){
			$("#imagePopup").css({
				"background-image":"url("+ $(this).find("img")[0].src+")",
				"background-size": "100% 100%",
				"background-repeat":"no-repeat"
			}).show(500);
		}); 
	});
</script>
<div class="container">

	<!-- Page Heading/Breadcrumbs -->
    <h1 class="my-4" style="font-weight:bold;">My Gallery</h1>
	<ol class="breadcrumb">
		<li class="breadcrumb-item">
			<a href="index.php">Home</a>
		</li>
		<li class="breadcrumb-item active">My Gallery</li>
	</ol>
	<!---gallery making-->
	<div class="row">
      	<?php 
			$userPhotos=sql_query("select * from user_photos where user_id={$_SESSION['userLogged']}");
			$users=sql_query("select * from users where user_id={$_SESSION['userLogged']}");
			foreach ($userPhotos as $key => $value)
			{
				echo '<div class="gallery col-lg-4 col-sm-6 portfolio-item">
						<div class="card h-100">
						<a href="#"><img class="card-img-top" src="user_photos/png/'.$value['id'].'.png" alt="error loading image"></a>
			            <div class="card-body">
			              <h4 class="card-title">
			                <a href="ieditor.php?user_photo='.$value['id'].'">'.$value['name'].'</a>
			                <div class="btn btn-danger float-right" onclick="deleteUserPhoto('.$value['id'].',this)"><i class="fa fa-trash"></i><small class="d-none d-sm-block"></small></div>
			              </h4>
			            </div>
						</div>
					</div>';
			}	
		?>
    </div>
	<!----cross-->
	<div id="imagePopup" style="display:none;background-size:100% 100%;background-repeat:no-repeat;border:6px solid black;position:fixed;height:80%;width:80%;top:10%;left:10%;background:white;">
		<div style="font-size:30px; border:2px solid black; border-radius:0px; padding-left:10px; padding-right:10px;  color:red;background:black;position:absolute; right:0px;top:0px; cursor:pointer;" onclick="this.parentElement.style.display='none'">
			<span style="font-weight:bold;">X</span>
		</div>
	</div>
</div>
	
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