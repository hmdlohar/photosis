<?php 
require "header.php";
$profilePicPath="img/emptyProfile.png";
	if(isset($_SESSION['userLogged'])){
		if(is_file("user_pics/{$_SESSION['userLogged']}.png")){
			$profilePicPath="user_pics/{$_SESSION['userLogged']}.png";
		}
	}

?>
<style type="text/css">

#img1{
	-height:100%;
	width:100%;
	position:absolute;
	filter:blur(10px);
}
#img2{
	-height:100%;
	width:100%;
	position:absolute;
	clip-path: url(#clipping);
	
}
	
</style>
<body>

<img id="img1" src="img/hoverEffect/photo1.jpg">
<img id="img2" src="img/hoverEffect/photo1.jpg">

	
<div class="container"><br><br>
		<div style="margin:auto;background:rgba(0,0,0,0.2)"class="col-lg-7 mb-7 rounded" ><br>
			<h1 class="mt-4 mb-3" style="font-weight:bold; color:#FFFFFF;">Register on photOsis
		  </h1>
		<div class="row">
			<div class="col-lg-12 mb-4">
			  <form id="formRegister" method="POST">
				<div class="control-group form-group">
				  <div class="controls">
					<label style="color:#FFFFFF;">Your Name:</label>
					<input type="text" class="form-control"  name="name" >
					<p class="help-block"></p>
				  </div>
				</div>           
				<div class="control-group form-group">
				  <div class="controls">
					<label style="color:#FFFFFF;">Your Email:</label>
					<input type="text" class="form-control"  name="email">
					<p class="help-block"></p>
				  </div>
				</div>
				 <div class="control-group form-group">
				  <div class="controls">
					<label>Your Date of Birth:</label>
					<input type="date" class="form-control" name="dob">
					<p class="help-block"></p>
				  </div>
				</div>
				<div class="control-group form-group">
				  <div class="controls">
					<label>Your Gender:</label>
					<select name="gender" class="form-control">
										<option value="1">Male</option>
										<option value="2">Female</option>
									</select>
					<p class="help-block"></p>
				  </div>
				</div>
				<div class="control-group form-group">
				  <div class="controls">
					<label>Username:</label>
					<input type="text" class="form-control" name="username" >
					<p class="help-block"></p>
				  </div>
				</div>
				<div class="control-group form-group">
				  <div class="controls">
					<label>Password:</label>
					<input type="password" class="form-control" id="password" name="password">
				  </div>
				</div>            
				<div class="control-group form-group">
				  <div class="controls">
					<label>Retype Password:</label>
					<input type="password" class="form-control" name="repassword">
				  </div>
				</div>
				
				<button type="submit" class="btn btn-primary"style="background-color:blue;" >Register</button>
			  </form>
			</div>

		  </div>
		</div><br><br>
</div>

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
	$("#formRegister").validate({
		rules:{
			name: "required",
			dob:"required",
			gender:"required",
			email:{
				email:true,
				required: true
			},
			username: {
				required:true,
				minlength: 8
			},
			repassword:{
				required: true,
				minlength: 8,
				equalTo: "#password"
			},
			password:"required"
		},
		messages:{
			name: "Enter Name",
			dob:"Please Select Date of birth",
			gender:"select gender",
			email: {
				required: "Email is Required",
				email: "Enter Proper Email"
			},
			username: {
				required:'Username is Required',
				minlength: "Username must be atleast 8 latters"
			},
			repassword:{
				required: "Password is Required",
				minlength: "Password must be atleast 8 latters",
				equalTo: "Password and Retype password must match"
			},
			password:"Password is Required"
		}
	});
	$("#formRegister").submit(function(){
		var frm=this;	
		if($("#formRegister").valid()){
			$.ajax({
				url: "dataProvider.php",
				type:"POST",
				data:{
					register: "true",
					name: frm.elements.name.value,
					dob: frm.elements.dob.value,
					gender: frm.elements.gender.value,
					email: frm.elements.email.value,
					username: frm.elements.username.value,
					password: frm.elements.password.value
				},
				success:function(data){
					if(data=="success"){
						notie.alert({text: "You are registered. You will be redirect to login page",type:1});
						setTimeout(function(){
							window.location.assign("login.php");
						},1000);
					}
					else{
						if(data=="missingData"){
							notie.alert({text: "Please Fill up form properly",type:3});
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
			notie.alert({text: "here to submit form"});
		}
		
		return false;
	});
});
</script>
