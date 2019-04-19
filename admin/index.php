<?php
require "../dbfiles/db.php";
require "header.php";
$total_users=sql_query("select count(id) as total from users")[0]['total'];
$total_user_photos=sql_query("select count(id) as total from user_photos")[0]['total'];
$total_user_likes=sql_query("select count(*) as total from likes")[0]['total'];
$total_user_comments=sql_query("select count(id) as total from comments")[0]['total'];
?>

	
	<main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4"> 
		<div class="container">
			<div class="row">
				<div class="col-3">
					<div class="card text-white bg-primary mb-3" style="">
					  <div class="card-header">Total Users</div>
					  <div class="card-body">
					    <span style="font-size:50px;color:green;"><a style="text-decoration:none;" href="users.php" class="text-white"><?php echo $total_users; ?></a></span>
					  </div>
					</div>  
				</div>

				<div class="col-3">
					<div class="card text-white bg-success mb-3" style="">
					  <div class="card-header">Photos Edited By Users</div>
					  <div class="card-body">
					    <span style="font-size:50px;color:green;"><a  style="text-decoration:none;" href="user_photos.php" class="text-white"><?php echo $total_user_photos; ?></a></span>
					  </div>
					</div>   
				</div>
				<div class="col-3">
					<div class="card text-white bg-warning mb-3" style="">
					  <div class="card-header">Likes By Users</div>
					  <div class="card-body">
					    <span style="font-size:50px;color:green;"><a  style="text-decoration:none;" href="likes.php" class="text-white"><?php echo $total_user_likes; ?></a></span>
					  </div>
					</div>   
				</div>
				<div class="col-3">
					<div class="card text-white bg-info mb-3" style="">
					  <div class="card-header">Comments By Users</div>
					  <div class="card-body">
					    <span style="font-size:50px;color:green;"><a  style="text-decoration:none;" href="comments.php" class="text-white"><?php echo $total_user_comments; ?></a></span>
					  </div>
					</div>   
				</div>
			</div>
			<div class="row">
				<div class="col">
					<div class="card border-info">
						<div class="card-header bg-info text-white">User's Activity</div>
						<div class="card-body">
							<div id="linechart_material"></div>  
						</div>
					</div>			
				</div>
			</div>
		</div>
		
    </main>
    <script type="text/javascript" src="../vendor/charts/loader.js"></script>
    <script type="text/javascript">
    	
    google.charts.load('current', {'packages':['line']});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {

      var data = new google.visualization.DataTable();
      data.addColumn('number', 'Day');
      data.addColumn('number', 'Likes');
      data.addColumn('number', 'Comments');
      data.addColumn('number', 'Photos');

      data.addRows([
        [1,  37.8, 80.8, 41.8],
        [2,  30.9, 69.5, 32.4],
        [3,  25.4,   57, 25.7],
        [4,  11.7, 18.8, 10.5],
        [5,  11.9, 17.6, 10.4],
        [6,   8.8, 13.6,  7.7],
        [7,   7.6, 12.3,  9.6],
        [8,  12.3, 29.2, 10.6],
        [9,  16.9, 42.9, 14.8],
        [10, 12.8, 30.9, 11.6],
        [11,  5.3,  7.9,  4.7],
        [12,  6.6,  8.4,  5.2],
        [13,  4.8,  6.3,  3.6],
        [14,  4.2,  6.2,  3.4]
      ]);

      var options = {
        chart: {
          title: 'Likes, Comments and Photos',
          subtitle: ''
        },
        width: 900,
        height: 500
      };

      var chart = new google.charts.Line(document.getElementById('linechart_material'));

      chart.draw(data, google.charts.Line.convertOptions(options));
    }
    </script>


<?php 
require "footer.php";
?>
