<?php
require "../dbfiles/db.php";
$start=0;
$count=20;
if(isset($_GET['show_user'])){
	$id=$_GET['show_user'];
	$res=sql_query("select * from admin where id={$id}");

	$profilePicPath="../user_pics/emptyProfile.png";
	if(is_file("../user_pics/{$id}.png")){
		$profilePicPath="../user_pics/{$id}.png";
	}

	//print_r($res[0]['dob']);
}
else{
	header("Location: admin.php");
	exit;
}
require "header.php";

?>
<script src="../js/jquery.js"></script>
<script src="../js/allOfPhotosis.js"></script>
<main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
	<div class="row">
    <div class="col-8" style="margin-top:20px">
				 <form action="" id="profileForm">
				  	<table class="table">
				  		<tr>
				  			<td>Name:</td>
				  			<td>
				  				<input type="text" class="form-control" value="<?php echo $res[0]['name']; ?>"name="name">
				  				<input type="hidden" class="form-control" value="<?php echo $res[0]['id']; ?>"name="adminId">
				  			</td>
				  		</tr>
						<tr>
				  			<td>Email:</td>
				  			<td><input type="text" class="form-control"  value="<?php echo  $res[0]['email']; ?>" name="email"></td>
				  		</tr>
						<tr>
				  			<td>Date of Birth:</td>
				  			<td><input type="text" class="form-control"  value="<?php echo $res[0]['dob']; ?>" name="dob"></td>
				  		</tr>
						<tr>
				  			<td>Username:</td>
				  			<td><input type="text" class="form-control"  value="<?php echo $res[0]['username'] ?>" name="username"></td>
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
				  			<td><input type="submit" style="background-color:blue;"class="btn btn-primary" value="Update Profile Info"></td>
				  		</tr>
				  		
				  	</table>
				  </form>
				 </div>
			<div class="col-3">
			
			</div>
		</div>
</main>


<?php 
require "footer.php";
?>
<script type="text/javascript" src="../js/jquery.validate.min.js"></script>
<script>
var profileForm=document.getElementById("profileForm");
$(document).on('loginInfoFetched', function(e, eventInfo) { 
	if(window.userData.logged){
		profileForm.name.value=userData.name;
		profileForm.email.value=userData.email;
		profileForm.username.value=userData.username;
	}
	else{
		$('#loginModel').modal({backdrop: 'static', keyboard: false}); 
		$('#loginModel').find(".close").hide(); 
		$('#loginModel').modal("show"); 
	}
});
$(document).ready(function(){
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
				url: "db_model.php",
				type:"POST",
				data:{
					viewAdmin: "true",
					name: frm.elements.name.value,
					email: frm.elements.email.value,
					username: frm.elements.username.value,
					gender: frm.elements.gender.value,
					dob: frm.elements.dob.value,
					adminId: frm.elements.adminId.value
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
			//notie.alert({text: "here to submit form"});
		}
		
		return false;
	});	
});
</script>
