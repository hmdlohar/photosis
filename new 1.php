<?php 
require "header.php";
?>

    <header>
      <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
          <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner" role="listbox">
          <!-- Slide One - Set the background image for this slide in the line below -->
          <div class="carousel-item active" style="background-image: url('img/front_photo_3.png')">
            <div class="carousel-caption d-none d-md-block">
              <h3>Want to edit your Photos?</h3>
              <p>iEdit provide you facility to edit photos without installing any app on your device.</p>
            </div>
          </div>
          <!-- Slide Two - Set the background image for this slide in the line below -->
          <div class="carousel-item" style="background-image: url('img/front_photo_2.png')">
            <div class="carousel-caption d-none d-md-block">
              <h3>Drag and get started.</h3>
              <p>Just drag your photo to our <a href="ieditor.php">iEditor</a> and start editing it.</p>
            </div>
          </div>
          <!-- Slide Three - Set the background image for this slide in the line below 1900 x 1080 -->
          <div class="carousel-item" style="background-image: url('img/front_photo_1.png')">
            <div class="carousel-caption d-none d-md-block">
              <h3>Want some extra?</h3>
              <p>We provide you free clipart that you can add to your photos and make them funkey.</p>
            </div>
          </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>
    </header>

    <!-- Page Content -->
    <div class="container">

      <h1 class="my-4">Features of iEdit</h1>

      <!-- Marketing Icons Section -->
      <div class="row" >
        <div class="col-lg-4 mb-4">
          <div class="card h-100">
            <h4 class="card-header">Crop/Resize Images</h4>
            <div class="card-body">
              <p class="card-text">Crop and resize your photos easily without any loading time. </p>
            </div>
            <div class="card-footer">
              <a href="#" class="btn btn-primary">Get Started</a>
            </div>
          </div>
        </div>
        <div class="col-lg-4 mb-4">
          <div class="card h-100">
            <h4 class="card-header">Glorify image</h4>
            <div class="card-body">
              <p class="card-text">Glorify image by applying different effects on image like changing seturation, greyscale, blur etc...</p>
            </div>
            <div class="card-footer">
              <a href="#" class="btn btn-primary">Get Started</a>
            </div>
          </div>
        </div>
        <div class="col-lg-4 mb-4">
          <div class="card h-100">
            <h4 class="card-header">Add Clipart</h4>
            <div class="card-body">
              <p class="card-text">You can add interesting clipart from our clipart gallery where you can find lot of freely available clipart. </p>
            </div>
            <div class="card-footer">
              <a href="#" class="btn btn-primary">Get Started</a>
            </div>
          </div>
        </div>
      </div>
      <!-- /.row -->

      <!-- Portfolio Section -->
      <h2>User's picks</h2>

      <div class="row">
        <?php 
			$userPhotos=sql_query("select * from user_photos");
			foreach ($userPhotos as $key => $value) {
				echo '<div class="col-lg-4 col-sm-6 portfolio-item">
			          <div class="card h-100">
			            <a href="#"><img class="card-img-top" src="user_photos/png/'
			            .$value['id'].'.png" alt=""></a>
			            <div class="card-body">
			              <h4 class="card-title">
			                <a href="#">Image name1</a>
			              </h4>
			            </div>
			          </div>
			        </div>';
			}

		?>        
      </div>
      <!-- /.row -->

      <!-- Features Section -->
      <div class="row">
        <div class="col-lg-6">
          <h2>Try our first Edit with iEdit</h2>
          <p>iEdit include following features:</p>
          <ul>
            <li>Crop/Resize</li>
            <li>Image Effects</li>
            <li>Cliparts</li>
            <li>Frames</li>
            <li>Text</li>
          </ul>
          <p>Drag your image to right side section and get started with your first edit with iEdit</p>
        </div>
        <div class="col-lg-6">
          <img class="img-fluid rounded" src="img/editor1.jpg" alt="">
        </div>
      </div>
      <!-- /.row -->

      <hr>

      <!-- Call to Action Section -->
      <div class="row mb-4">
        <div class="col-md-8">
          <p></p>
        </div>
        <div class="col-md-4">
          <a class="btn btn-lg btn-secondary btn-block" href="ieditor.php">Open iEditor</a>
        </div>
      </div>

    </div>
    <!-- /.container -->

    <!-- Footer -->
<?php 
require "footer.php";
?>
