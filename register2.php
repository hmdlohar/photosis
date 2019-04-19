<?php 
require "header.php";



?>
<div class="container">
<div class="row" style="margin-top:20px;">
	<div class="col-5">
	<div class="card text-white bg-primary mb-3" style="">
			  <div class="card-header">Profile Picture<a href="my-gallery.php" style="color:white;text-decoration:none;cursor:pointer;margin:240px;">Save & Next</a></div>
			  <div class="card-body " style="background-color:#f7f7f7;">
			  	<h4 class="cart-title text-dark text-center" style="font-weight:bold; color:#17a2b8 ;"><?php $rs=sql_query("select username from users where id={$_SESSION['userLogged']}");echo $rs[0]['username'] ?></h4>
			    <img src="<?php echo $profilePicPath; ?>" id="imgProfilePic" class="img-fluid rounded-circle mx-auto d-block"style="border: 8px solid #bebebf;height:350px;;">
			    <br>
			    <form enctype="multipart/form-data" id="profilePicForm" method="POST">
			    	<label class="btn btn-info d-block" for="fileProfilePic" style="margin:auto">Change Profile Picture</label>
			   		<input type="file" style="display: none" name="img" id="fileProfilePic">
			   		<input type="hidden" name="updateProfilePic" value="true">
			    </form>
			   

			  </div>
			  
			</div></div>
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
	
	$("#btnEditProfile").click(function(){
		$("#profileForm").find("input, select").removeAttr("disabled","true");

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
			"addr-line1":"required",
			"addr-city":"required",
			"addr-state":"required",
			"addr-zip":{
				required :true,
				minlength: 6,
				maxlength: 6
			},
			"addr-country":"required",
		},
		messages:{
			name: "Enter Name",
			email: {
				required: "Email is Required",
				email: "Enter Proper Email"
			},
			username: {
				required:'Username is Required',
				minlength: "Username must be atleast 8 latters"
			},
			dob:"Please Select Date of birth",
			gender:"select gender",
			"addr-line1":"Enter Address line1",
			"addr-city":"Enter City",
			"addr-state":"Enter State",
			"addr-zip":{
				required:"Enter ZIP code",
				minlength:"ZIP code must be 6 character long",
				maxlength:"ZIP code must be 6 character long"
			},
			"addr-country":"Select Country "
		}
	});
	$("#profileForm").submit(function(){
		var frm=this;	
		if($("#profileForm").valid()){
			var addr={
				line1: frm.elements['addr-line1'].value,
				line2: frm.elements['addr-line2'].value,
				city: frm.elements['addr-city'].value,
				state: frm.elements['addr-state'].value,
				zip: frm.elements['addr-zip'].value,
				country: frm.elements['addr-country'].value,
			};

			$.ajax({
				url: "dataModel.php",
				type:"POST",
				data:{
					updateProfile: "true",
					name: frm.elements.name.value,
					email: frm.elements.email.value,
					username: frm.elements.username.value,
					gender: frm.elements.gender.value,
					dob: frm.elements.dob.value,
					address: JSON.stringify(addr),
				},
				success:function(data){
					console.log(data);
					if(data=="success"){
						notie.alert({text: "Profile Saved Successfully",type:1});
					}
					else{
						notie.alert({text: "Unexpected Error.",type:3});
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
	$.ajax({
		url: "dataProvider.php",
		type:"POST",
		data:{
			profileInfo: "true"
		},
		success:function(data){
			console.log(data);
			if(data!="profileNotFound"){
				var jData=JSON.parse(data);
				profileForm.dob.value=jData.dob;
				profileForm.gender.value=jData.gender;
				var addr=JSON.parse(jData.address);
				profileForm.elements['addr-line1'].value=addr.line1;
				profileForm.elements['addr-line2'].value=addr.line2;
				profileForm.elements['addr-city'].value=addr.city;
				profileForm.elements['addr-state'].value=addr.state;
				profileForm.elements['addr-zip'].value=addr.zip;
				profileForm.elements['addr-country'].value=addr.country;
			}
			
		},
		error:function(err){
			console.log(err.responseText);
		}
	});	
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
