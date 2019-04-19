<?php
require "../dbfiles/db.php";
require "header.php";
$start=0;
$count=20;
if(isset($_GET['start'])){
	$start=$_GET['start'];
}
if(isset($_GET['count'])){
	$count=$_GET['count'];
}
$total_items=sql_query("select count(id) as total from user_photos")[0]['total'];
?>

		<main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
    

          <h2>Users Photos
			
          </h2>

          <div class="table-responsive">
            <table class="table table-striped table-sm">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Name</th>
                  <th>Username</th>
                  <th>Image</th>
                  <th width="20%">Action</th>
                </tr>
              </thead>

              <tbody>
              	<?php 
              	$allCliparts=sql_query("select id,name,(select name from users where id=user_photos.user_id) as username from user_photos limit {$start} ,{$count}");
              	foreach ($allCliparts as $key => $value) {
              		echo "<tr>
		                  <td>{$value['id']}</td>
		                  <td>{$value['name']}</td>
		                  <td>{$value['username']}</td>
		                  <td><img src='../user_photos/png/{$value['id']}.png' style='width:100px;'></td>
		                  <td>";
		                  ?>
		                  <a class="btn-sm btn-primary" href="view_photo.php?show_photo=<?php echo $value['id']; ?> ">View</a>
		                  <a class="btn-sm btn-danger" href="db_model.php?delete_user_photo=1&id=<?php echo $value['id']; ?>" >Delete</a>
		                  <?php
		                  echo "</td>
		                </tr>";
              	}
              ?>
                
                
              </tbody>
            </table>
          </div>

          <ul class="pagination pagination-sm">
			<li class="page-item"><a class="page-link" href="?start=<?php echo ($start-20 < 0)?0:$start-20; ?>">Previous</a></li>
		  
				<?php 
					for($i=0;$i<$total_items;$i+=20){
						$st=$i;
						//$ed=$i+20;
						$cnt=$i/20;
						if($start/20 == $cnt){
							echo "<li class='page-item active'><a class='page-link' href='?start={$st}'>{$cnt}</a></li>";
						}
						else{
							echo "<li class='page-item'><a class='page-link' href='?start={$st}'>{$cnt}</a></li>";
						}
						
					}
				?>
			<li class="page-item"><a class="page-link" href="?start=<?php echo ($start > $total_items)?$start:$start+20; ?>">Next</a></li>
		</ul>
        </main>


<?php 
require "footer.php";
?>
