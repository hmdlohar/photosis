<?php 
session_start();
if(isset($_SESSION['adminLogged'])){
	header("Location: index.php");
}
if(isset($_GET['adminLogout'])){
	session_destroy();
}

?>
<!doctype html>
<html lang="en">
	
	<script src="../js/notie.min.js"></script>
	
	
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../../../favicon.ico">
<link href="../css/notie.min.css" rel="stylesheet">
    <title>Admin-Photosis</title>

    <!-- Bootstrap core CSS -->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="dashboard.css" rel="stylesheet">
    <style type="text/css">
    	body#LoginForm{ background-image:url("https://hdwallsource.com/img/2014/9/blur-26347-27038-hd-wallpapers.jpg"); background-repeat:no-repeat; background-position:center; background-size:cover; padding:10px;}

.form-heading { color:red; font-size:23px;}
.panel h2{ color:#444444; font-size:18px; margin:0 0 8px 0;}
.panel p { color:#777777; font-size:14px; margin-bottom:30px; line-height:24px;}
.login-form .form-control {
  background: #f7f7f7 none repeat scroll 0 0;
  border: 1px solid #d4d4d4;
  border-radius: 4px;
  font-size: 14px;
  height: 50px;
  line-height: 50px;
}
.main-div {
  background: #ffffff none repeat scroll 0 0;
  border-radius: 2px;
  margin: 10px auto 30px;
  max-width: 38%;
  padding: 50px 70px 70px 71px;
}

.login-form .form-group {
  margin-bottom:10px;
}
.login-form{ text-align:center;}
.forgot a {
  color: #777777;
  font-size: 14px;
  text-decoration: underline;
}
.login-form  .btn.btn-primary {
  background: #f0ad4e none repeat scroll 0 0;
  border-color: #f0ad4e;
  color: #ffffff;
  font-size: 14px;
  width: 100%;
  height: 50px;
  line-height: 50px;
  padding: 0;
}
.forgot {
  text-align: left; margin-bottom:30px;
}
.botto-text {
  color: #ffffff;
  font-size: 14px;
  margin: auto;
}
.login-form .btn.btn-primary.reset {
  background: #ff9900 none repeat scroll 0 0;
}
.back { text-align: left; margin-top:10px;}
.back a {color: #444444; font-size: 13px;text-decoration: none;}

    </style>
  </head>
<body id="LoginForm">
<div class="container">

<div class="login-form">
<div class="main-div">
    <div class="panel">
   <h2>Admin Login</h2>
   <p>Please enter admin username and password</p>
   </div>
    <form id="formLogin" method="POST">
				<div class="control-group form-group">
				  <div class="controls">
					<label style="font-weight:bold; color:">Username:</label>
					<input type="text" class="form-control" name="username">
					
				  </div>
				</div>
				<div class="control-group form-group">
				  <div class="controls">
					<label style="font-weight:bold; color:">Password:</label>
					<input type="password" class="form-control" name="password">
				  </div>
				</div>
				<!-- For success/fail messages -->
				<button type="submit" class="btn btn-primary" style="background-color:blue;width:100px;">Login</button>
				<button type="cancel" class="btn btn-secondary"style="width:100px;height:50px;">Cancel</button>
			  </form>
    </div>

</div></div></div>


</body>

	<script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>
    
	<script src="../js/notie.min.js"></script>
<script type="text/javascript" src="../js/jquery.validate.min.js"></script>
<script type="text/javascript">
	
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
				url: "db_model.php",
				type:"POST",
				data:{
					login: "true",
					username: frm.elements.username.value,
					password: frm.elements.password.value
				},
				success:function(data){
					if(data=="success"){						
						notie.alert({text: "Successfully Logged In....",type:1});
						setTimeout(function(){
							window.location.assign("index.php");
						},1000);
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
							console.log(data);
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

  
</html>
