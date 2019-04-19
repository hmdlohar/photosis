<?php 
require "header.php";
?>

<?php 
	if(isset($_POST['contact'])){
		$name=$_POST['name'];
		$email=$_POST['email'];
		$subject=$_POST['subject'];
		$message=$_POST['message'];
		$query="insert into contact_messages (name,email,subject,message) values ('{$name}','{$email}','{$subject}','{$message}')";
		$res=sql_nonquery($query);
		if(!$res){
			echo "Problem in submiting your message.";
		}
		else{
			echo "<h2>Your Message were Posted Successfully. Thank you for contacting Us. We will get back to you as soon as possible.</h2>";
		return;
		}
		
	}	
?>

<div class="container">
	
	<!-- Page Heading/Breadcrumbs -->
	<h1 class="mt-4 mb-4">Contact iEdit
	</h1>

	<ol class="breadcrumb">
		<li class="breadcrumb-item">
			<a href="index.php">Home</a>
		</li>
		<li class="breadcrumb-item active">Contact</li>
	</ol>
	  
	<!-- Content -->
	<div class="row">
		<div class="col-lg-6">
			<img class="img-fluid rounded mb-4" src="img/editor1.jpg" alt="contact us">
		</div>
		<div class="col-lg-6">
         <form id="contactForm" action="" method="POST">

                <!--Grid row-->
                <div class="row">

                    <!--Grid column-->
                    <div class="col-md-6">
                        <div class="md-form mb-0">
                            <label for="name" class="">Your name</label>
                            <input type="text" id="name" name="name" class="form-control">
                        </div>
                    </div>
                    <!--Grid column-->

                    <!--Grid column-->
                    <div class="col-md-6">
                        <div class="md-form mb-0">
                            <label for="email" class="">Your email</label>
                            <input type="text" id="email" name="email" class="form-control">
                        </div>
                    </div>
                    <!--Grid column-->

                </div>
                <!--Grid row-->

                <!--Grid row-->
                <div class="row">
                    <div class="col-md-12">
                        <div class="md-form mb-0">
                        	<label for="subject" class="">Subject</label>
                            <input type="text" id="subject" name="subject" class="form-control">
                            
                        </div>
                    </div>
                </div>
                <!--Grid row-->

                <!--Grid row-->
                <div class="row">

                    <!--Grid column-->
                    <div class="col-md-12">

                        <div class="md-form">
                        	<label for="message">Your message</label>
                            <textarea type="text" id="message" name="message" rows="2" class="form-control md-textarea"></textarea>
                            
                        </div>

                    </div>
                </div>
                <!--Grid row--><br>
				<div class="text-center text-md-left">
                <input type="submit" class="btn btn-primary" name="contact" value="send">
                <input type="reset" class="btn btn-secondary" name="contact" value="cancel">
            </div>
            </form>
			<div class="status"></div>
		</div>
	</div>
      <!-- /.row -->
	   <div class="text-center row">
		<div class="col-md-4">
			<i class="fa fa-phone mt-4 fa-2x"></i>
            <p>+91 7048 816 998</p>
		</div>
        <div class="col-md-4">
			<i class="fa fa-envelope mt-4 fa-2x"></i>
			<p>contact@photOsis.com</p>
		</div>
        <div class="col-md-4" style="margin-top:26px">
			<i class="fa fa-map-marker fa-2x"></i>
            <p>Surat- 394210, Gujarat, India</p>
		</div>
               
            
        </div>
</div>

<?php 
require "footer.php";
?>

<script type="text/javascript">
$(document).ready(function(){
	$("#contactForm").validate({
		rules:{
			name: "required",
			email:{
				email:true,
				required: true
			},
			subject: {
				required:true
			},
			message:"required"
		},
		messages:{
			name: "Enter Name",
			email: {
				required: "Email is Required",
				email: "Enter Proper Email"
			},
			subject: {
				required:'Subject is Required'
			},
			message:"Message is Required"
		}
	});
});
</script>