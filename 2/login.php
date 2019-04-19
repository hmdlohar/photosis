<?php 

require "header.php";
?>
<br>

<div class="container">
	<h1 class="mt-4 mb-3" style="font-weight:bold;">Login to iEdit
        <small></small>
      </h1>
	<div class="row">
        <div class="col-lg-8 mb-4">
          <form id="formLogin" method="POST">
            <div class="control-group form-group">
              <div class="controls">
                <label style="font-weight:bold;">Username:</label>
                <input type="text" class="form-control" name="username">
                
              </div>
            </div>
            <div class="control-group form-group">
              <div class="controls">
                <label style="font-weight:bold;">Password:</label>
                <input type="password" class="form-control" name="password">
              </div>
            </div>
            
            
            <!-- For success/fail messages -->
            <button type="submit" class="btn 
			btn-primary">Login</button>
            <button type="cancel" class="btn btn-secondary">Cancel</button>
          </form>
        </div>   
	</div>
</div>
<br><br>

<?php 
require "footer.php";
?>
<script type="text/javascript" src="js/jquery.validate.min.js"></script>
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
				url: "dataProvider.php",
				type:"POST",
				data:{
					login: "true",
					username: frm.elements.username.value,
					password: frm.elements.password.value
				},
				success:function(data){
					if(data=="success"){
						notie.alert({text: "Successfully Logged In.....",type:1});
						window.location.assign("my-gallery.php");
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