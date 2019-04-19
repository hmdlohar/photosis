<?php 
require "header.php";
	$profilePicPath="img/emptyProfile.png";
	if(isLogged())
	{
		if(is_file("user_pics/{$_SESSION['userLogged']}.png"))
		{
			$profilePicPath="user_pics/{$_SESSION['userLogged']}.png";
		}
	}
$rs=sql_query("select * from users where id={$_SESSION['userLogged']}");
?>

<div class="container mt-4"style="height:550px;">
	<div class="row">
		<div class="col-md-3">
			<div class="card text-white bg-primary mb-3" style="">
			  <div class="card-header">Profile Picture</div>
			  <div class="card-body bg-white">
			  	<h4 class="cart-title text-dark text-center" style="font-weight:bold; color:#17a2b8 ;"><?php echo $rs[0]['username'] ?></h4>
			    <img src="<?php echo $profilePicPath; ?>" id="imgProfilePic" class="img-fluid rounded-circle mx-auto d-block" style="border:8px solid #bebebf">
			    <br>
			    <form enctype="multipart/form-data" id="profilePicForm" method="POST">
			    	<label class="btn btn-info d-block" for="fileProfilePic" style="margin:auto">Change Profile Picture</label>
			   		<input type="file" style="display: none" name="img" id="fileProfilePic">
			   		<input type="hidden" name="updateProfilePic" value="true">
			    </form>
			   

			  </div>
			  
			</div>
		</div>
		<div class="col-md-9">
			<div class="card border-primary mb-3" style="">
			  <div class="card-header">Profile Details
				<div class="float-right">					
					<button class="btn btn-info" id="btnEditProfile"style="margin-right:10px;">Edit Profile</button>
					<button class="btn btn-info" id="btnChangePassword" style="">Change Password</button>
				</div>
			  </div>
			  <div class="card-body">
			    <h4 class="card-title"></h4>
			    
				  <form action="" id="profileForm">
				  	<table class="table">
				  		
				  		<tr>
				  			<td>Name:</td>
				  			<td><input type="text" class="form-control" value="<?php echo $rs[0]['name'] ?>"name="name"></td>
				  		</tr>
						<tr>
				  			<td>Username:</td>
				  			<td><input type="text" disabled="" class="form-control"  value="<?php echo $rs[0]['username'] ?>" name="username"></td>
				  		</tr>
						<tr>
				  			<td>Email:</td>
				  			<td><input type="text" class="form-control"  value="<?php echo $rs[0]['email'] ?>" name="email"></td>
				  		</tr>
						<tr>
				  			<td>Date of Birth:</td>
				  			<td><input type="text" class="form-control"  value="<?php echo $rs[0]['dob'] ?>" name="dob"></td>
				  		</tr>
						<tr>
				  			<td>Gender:</td>
				  			<td>
				  				<select name="gender" class="form-control">
				  					<option value="male">Male</option>
				  					<option value="female">Female</option>
				  				</select>
				  				
				  			</td>
				  		</tr>
				  			
				  		<tr>
				  			<td></td>
				  			<td><input type="submit" style="background-color:blue;"class="btn btn-primary" value="save Profile Info"></td>
				  		</tr>
				  		
				  	</table>
				  </form>
				  
				  <form action="" id="passwordForm">
				  	<table class="table">
				  		
				  		<tr>
				  			<td>Old Password:</td>
				  			<td><input type="password" class="form-control" name="oldPassword"></td>
				  		</tr>
						<tr>
				  			<td>New Password:</td>
				  			<td><input type="password"  class="form-control"id="password"   name="password"></td>
				  		</tr>
						<tr>
				  			<td>Retype New Password:</td>
				  			<td><input type="password" class="form-control"  name="repassword"></td>
				  		</tr>						  			
				  		<tr>
				  			<td></td>
				  			<td><input type="submit" style="background-color:blue;"class="btn btn-primary" value="Change Password"></td>
				  		</tr>
				  		
				  	</table>
				  </form>

			  </div>
			</div>
		</div>
	</div>
</div>
<?php 
require "footer.php";
?>
<script type="text/javascript" src="js/jquery.validate.min.js"></script>
<script type="text/javascript">
var profileForm=document.getElementById("profileForm");
$(document).on('loginInfoFetched', function(e, eventInfo) { 
	if(window.userData.logged){
		profileForm.name.value=userData.name;
		profileForm.email.value=userData.email;
		profileForm.username.value=userData.username;
		loadUserProfile();
	}
	else{
		$('#loginModel').modal({backdrop: 'static', keyboard: false}); 
		$('#loginModel').find(".close").hide(); 
		$('#loginModel').modal("show"); 
	}
});

$(document).ready(function(){
	$("#profileForm").find("input, select").attr("disabled","true");
	$("#passwordForm").hide();
	
	$("#btnEditProfile").click(function(){
		$("#profileForm").find("input, select").removeAttr("disabled","true");
		$("#profileForm").show();
		$("#passwordForm").hide();

	});
	$("#btnChangePassword").click(function(){
		$("#profileForm").hide();
		$("#passwordForm").show();

	});
	$("#fileProfilePic").change(updateProfilePicture);
	loadUserProfile();
	$("#profileForm").validate({
		rules:{
			name: "required",
			email:{
				email:true,
				required: true
			},
			username: {
				required:true,
				minlength: 8
			},
			dob:"required",
			gender:"required",
			repassword:{
				required: true,
				minlength: 8,
				equalTo: "#password"
			},
			password:"required",
			oldPassword:"required"
		},
		messages:{
			name: "Enter Name",
			email: {
				required: "Email is Required",
				email: "Enter Proper Email"
			},
			repassword:{
				required: "Password is Required",
				minlength: "Password must be atleast 8 latters",
				equalTo: "Password and Retype password must match"
			},
			password:"Password is Required",
			username: {
				required:'Username is Required',
				minlength: "Username must be atleast 8 latters"
			},
			dob:"Please Select Date of birth",
			gender:"select gender"
		}
	});	
	$("#profileForm").submit(function(){
		var frm=this;	
		if($("#profileForm").valid()){
			$.ajax({
				url: "dataProvider.php",
				type:"POST",
				data:{
					updateProfile: "true",
					name: frm.elements.name.value,
					email: frm.elements.email.value,
					username: frm.elements.username.value,
					gender: frm.elements.gender.value,
					dob: frm.elements.dob.value
				},
				success:function(data){
					console.log(data);
					if(data=="success"){
						notie.alert({text: "Profile Saved Successfully",type:1});
					}
					else{
						if(data=="missingData"){
							notie.alert({text: "Some Information is missing.",type:2});
						}
						else if(data="problemInserting"){
							notie.alert({text: "Profile Not Updated.",type:3});
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
	
	$("#passwordForm").validate({
		rules:{
			repassword:{
				required: true,
				minlength: 8,
				equalTo: "#password"
			},
			password:{
				required: true,
				minlength: 8
			},
			oldPassword:{
				required: true,
				minlength: 8
			}
		},
		messages:{
			repassword:{
				required: "Password is Required",
				minlength: "Password must be atleast 8 latters",
				equalTo: "Password and Retype password must match"
			},
			password:{
				required:"Password is Required",
				minlength: "Password must be atleast 8 latters",
			},
			oldPassword:{
				required:"Password is Required",
				minlength: "Password must be atleast 8 latters",
			}
		}
	});
	
	$("#passwordForm").submit(function(){
		var frm=this;	
		if($("#passwordForm").valid()){
			$.ajax({
				url: "dataProvider.php",
				type:"POST",
				data:{
					updatePassword: "true",
					op: frm.elements.oldPassword.value,
					p: frm.elements.password.value
				},
				success:function(data){
					console.log(data);
					if(data=="success"){
						notie.alert({text: "Password Updated Successfully",type:1});
					}
					else	if(data=="error"){
							notie.alert({text: "Unexpected Error Occured.",type:3});
						}
					else	if(data=="passwordInAccurate"){
							notie.alert({text: "Old Password is not accurate.",type:3});
						}
					else	if(data=="missingData"){
							notie.alert({text: "Information Missing.",type:2});
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
function loadUserProfile(){
		
}
function updateProfilePicture(){
	var t=this.value.split(".");
	var ext=t[t.length-1];
	var allowedExt=['jpg','png','jpeg','bmp'];
	if(allowedExt.indexOf(ext)==-1){
		notie.alert({text: "Please Upload PNG,JPG,JPEG or BMP image",type:3});
		return;
	}
	var r=new FileReader();
	r.readAsDataURL(this.files[0]);
	r.onload=function(d){
		var img=document.getElementById("imgProfilePic");
		img.src=d.target.result;
		$.ajax({
			url: "dataProvider.php",
			type:"POST",
			processData: false,
			contentType: false,
			data:new FormData($("#profilePicForm")[0]),
			success:function(data){		
				console.log(data);
			},
			error:function(err){
				console.log(err.responseText);
			}
		});	
	}
}
</script>
