<?php
require "../dbfiles/db.php";
require "header.php";

?>

<div class="container"><br><br>
		<div style="margin:auto;background:rgba(0,0,0,0.2)"class="col-lg-7 mb-7 rounded" ><br>
			<h1 class="mt-4 mb-3" style="font-weight:bold; color:#370640;">Add User
		  </h1>
		<div class="row">
			<div class="col-lg-12 mb-4">
			  <form id="formRegister" method="POST">
				<div class="control-group form-group">
				  <div class="controls">
					<label style="font-weight:bold; color:#370640;">Your Name:</label>
					<input type="text" class="form-control"  name="name" >
					<p style="color:#ff1b1b;" class="help-block"></p>
				  </div>
				</div>           
				<div class="control-group form-group">
				  <div class="controls">
					<label style="font-weight:bold; color:#370640;">Your Email:</label>
					<input type="text" class="form-control"  name="email">
					<p class="help-block"></p>
				  </div>
				</div>
				 <div class="control-group form-group">
				  <div class="controls">
					<label style="font-weight:bold; color:#370640;">Your Date of Birth:</label>
					<input type="date" class="form-control" name="dob">
					<p class="help-block"></p>
				  </div>
				</div>
				<div class="control-group form-group">
				  <div class="controls">
					<label style="font-weight:bold; color:#370640;">Your Gender:</label>
					<select name="gender" class="form-control">
										<option value="1">Male</option>
										<option value="2">Female</option>
									</select>
					<p class="help-block"></p>
				  </div>
				</div>
				<div class="control-group form-group">
				  <div class="controls">
					<label style="font-weight:bold; color:#370640;">Username:</label>
					<input type="text" class="form-control" name="username" >
					<p class="help-block"></p>
				  </div>
				</div>
				<div class="control-group form-group">
				  <div class="controls">
					<label style="font-weight:bold; color:#370640;">Password:</label>
					<input type="password" class="form-control" id="password" name="password">
				  </div>
				</div>            
				<div class="control-group form-group">
				  <div class="controls">
					<label style="font-weight:bold; color:#370640;">Retype Password:</label>
					<input type="password" class="form-control" name="repassword">
				  </div>
				</div>
				
				<button type="submit" class="btn btn-primary"style="background-color:blue;" >Register</button>
			  </form>
			</div>

		  </div>
		</div><br><br>
</div>
<?php 
require "footer.php";
?>
<script type="text/javascript" src="../js/jquery.validate.min.js"></script>
<<script type="text/javascript">
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
				url: "db_model.php",
				type:"POST",
				data:{
					add_user: "true",
					name: frm.elements.name.value,
					dob: frm.elements.dob.value,
					gender: frm.elements.gender.value,
					email: frm.elements.email.value,
					username: frm.elements.username.value,
					password: frm.elements.password.value
				},
				success:function(data){
					if(data=="success"){
						notie.alert({text: "Admin are registered.",type:1});
						setTimeout(function(){
							window.location.assign("index.php");
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

