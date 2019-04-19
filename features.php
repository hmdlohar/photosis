<?php 
require "header.php";
if(isset($_SESSION['userLogged']))
{
	$path="ieditor.php";
}
else{
	$path="login.php";
}
?>
<style>
	.cardheader{
		background-color: #8e9a99; 
		color: white;
		}
		.cardfooter{
			background-color:#dfe6e6;
		}
</style>
<div class="container">

	<!-- Page Heading/Breadcrumbs -->
      <h1 class="my-4"style="font-weight:bold; color:#2d2756;">Features of photOsis</h1>
	  
	   <ol class="breadcrumb"style="background-color:#404042">
        <li class="breadcrumb-item">
          <a href="index.php"style="color:white">Home</a>
        </li>
        <li class="breadcrumb-item active"style="color:white">Features</li>
      </ol>

      <!-- Marketing Icons Section -->
      <div class="row">
        <div class="col-lg-4 mb-4">
          <div class="card h-100">
            <h4 class="card-header cardheader" >Crop/Resize Images</h4>
            <div class="card-body">
              <p class="card-text">Crop and resize your photos easily without any loading time. </p>
            </div>
            <div class="card-footer cardfooter">
              <a href=<?php echo $path;?> class="btn btn-primary " style="background-color:blue">Let's photOsis</a>
            </div>
          </div>
        </div>
		
        <div class="col-lg-4 mb-4">
          <div class="card h-100">
            <h4 class="card-header cardheader">Glorify image</h4>
            <div class="card-body">
              <p class="card-text">Glorify image by applying different effects on image like changing seturation, greyscale, blur etc...</p>
            </div> 
            <div class="card-footer cardfooter">
              <a href=<?php echo $path;?> class="btn btn-primary" style="background-color:blue">Let's photOsis</a>
            </div>
          </div>
        </div>
		
        <div class="col-lg-4 mb-4">
          <div class="card h-100">
            <h4 class="card-header cardheader">Add Clipart</h4>
            <div class="card-body">
              <p class="card-text">You can add interesting clipart from our clipart gallery where you can find lot of freely available clipart. </p>
            </div>
            <div class="card-footer cardfooter">
              <a href=<?php echo $path;?> class="btn btn-primary" style="background-color:blue">Let's photOsis</a>
            </div>
          </div>
        </div>
		
        <div class="col-lg-4 mb-4">
          <div class="card h-100">
            <h4 class="card-header cardheader">Add Text</h4>
            <div class="card-body">
              <p class="card-text">You can add interesting clipart from our clipart gallery where you can find lot of freely available clipart. </p>
            </div>
            <div class="card-footer cardfooter">
              <a href=<?php echo $path;?> class="btn btn-primary" style="background-color:blue">Let's photOsis</a>
            </div>
          </div>
        </div>
		
        <div class="col-lg-4 mb-4">
          <div class="card h-100">
            <h4 class="card-header cardheader">Add Frames</h4>
            <div class="card-body">
              <p class="card-text">You can add interesting clipart from our clipart gallery where you can find lot of freely available clipart. </p>
            </div>
            <div class="card-footer cardfooter">
              <a href=<?php echo $path;?> class="btn btn-primary" style="background-color:blue">Let's photOsis</a>
            </div>
          </div>
        </div>
		
		<div class="col-lg-4 mb-4">
          <div class="card h-100">
            <h4 class="card-header cardheader">Download/Save Image</h4>
            <div class="card-body">
              <p class="card-text">You can easily download or save your photos for future use. </p>
            </div>
            <div class="card-footer cardfooter">
              <a href=<?php echo $path;?> class="btn btn-primary" style="background-color:blue">Let's photOsis</a>
            </div>
          </div>
        </div>
		
      </div>
      <!-- /.row -->
</div>
      
<?php 
require "footer.php";
?>
