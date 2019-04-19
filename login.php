<?php 
require "header.php";
?>
<style type="text/css">

#img1{
	height:100%;
	width:100%;
	position:absolute;
	filter:blur(12px);
}
#img2{
	height:100%;
	width:100%;
	position:absolute;
	clip-path: url(#clipping);
	
}
	
</style>
<br>
<body>

<img id="img1" src="img/hoverEffect2.webp">
<img id="img2" src="img/hoverEffect2.webp">


	
<div class="container "><br>
	<div style="margin:auto;background:rgba(0,0,0,0.2)" class="col-6 rounded" ><br>
		<h1 class="mt-5 mb-3" style="font-weight:bold; color:#FFFFFF;">Login to photOsis
		  </h1>
		<div class="row">
			<div class="col-lg-12 mb-4">
			  <form id="formLogin" method="POST">
				<div class="control-group form-group">
				  <div class="controls">
					<label style="font-weight:bold; color:#FFFFFF;">Username:</label>
					<input type="text" class="form-control" name="username">
					
				  </div>
				</div>
				<div class="control-group form-group">
				  <div class="controls">
					<label style="font-weight:bold; color:#FFFFFF;">Password:</label>
					<input type="password" class="form-control" name="password">
				  </div>
				</div>
				
				
				<!-- For success/fail messages -->
				<button type="submit" class="btn btn-primary" style="background-color:blue">Login</button>
				<button type="cancel" class="btn btn-secondary">Cancel</button>
			  </form>
			</div>   
		</div>
	</div>
	</div>
<br><br>
<svg>
  <defs>
    <clipPath id="clipping">
      <circle id="circle" cx="284" cy="213" r="70" />
    </clipPath>
  </defs>
</svg>
</body>

<?php 
require "footer.php";
?>
<script type="text/javascript" src="js/jquery.validate.min.js"></script>
<script type="text/javascript">
	clip=document.getElementById("circle");
	document.body.onmousemove=function(e){
		window.e=e;
		console.log(e);
		clip.setAttribute("cx",e.pageX);
		clip.setAttribute("cy",e.pageY - 80);
	}
$(document).ready(function(){
	$("#formLogin").validate({
		rules:{
			username: {
				required:true,
				minlength: 8,
				maxlength: 16
			},
			password:{
				required: true,
				minlength: 8,
				maxlength: 16
			}

		},
		messages:{
			username: {
				required:'Username is Required',
				minlength: "Username must be atleast 8 characters",
				maxlength: "Username must be atmost 16 characters"
			},
			password:{
				required: "Password is Required",
				minlength: "Password must be atleast 8 characters",
				maxlength: "Password must be atmost 16 characters"
			}
		}
	});//then y using form if we are using ajax??
	$("#formLogin").submit(function(){
		var frm=this;	
		if($("#formLogin").valid()){
			$.ajax({
				url: "dataProvider.php",
				type:"POST",
				data:{
					login: "true",
					username: frm.elements.username.value,
					password: frm.elements.password.value
				},
				success:function(data){
					if(data=="register2" || data=="my-gallery"){
						
						notie.alert({text: "Successfully Logged In....",type:2});
						setTimeout(function(){
						},1000);
						//window.rrs=JSON.parse(data);
						if(data=="my-gallery"){
							window.location.assign("my-gallery.php");}
						else if(data=="register2"){
							window.location.assign("register2.php");}
					}
					else{
						if(data=="userNotFound"){
							notie.alert({text: "Username does not exist.",type:3});
						}
						else if(data=="passwordDoNotMatch"){
							notie.alert({text: "You have entered wrong password. ",type:3});
						}
						else{
							notie.alert({text: "Unexpected Error.",type:3});
						}
					}
				},
				error:function(err){
					console.log(err);
					return;
					console.log(err.responseText);
				}
			});			
		}
		return false;
	});
});

</script>
