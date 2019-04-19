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
$total_items=sql_query("select count(id) as total from users")[0]['total'];
?>

		<main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
    

          <h2>Users
			<button class="btn btn-sm btn-primary float-right " onclick="location.href='add_user.php'">Add User</button>
          </h2>

          <div class="table-responsive">
            <div class="table table-responsive">
            <table class="table table-striped table-sm">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>No. of Photos</th>
                  
                </tr>
              </thead>

              <tbody>
              	<?php 
              	$allCliparts=sql_query("select id,name,email,(select count(id) from user_photos where user_id=users.id) as total_photos from users limit {$start} ,{$count}");
              	foreach ($allCliparts as $key => $value) {
              		echo "<tr>
		                  <td>{$value['id']}</td>
		                  <td>{$value['name']}</td>
		                  <td>{$value['email']}</td>
		                  <td>{$value['total_photos']}</td>
		                  <td><button class='btn btn-sm  float-right ' style='background-color:#0b2f56;color:white;' onclick='loc({$value['id']})'>View User</button></td>
		                  
		                  <td>";
		                  ?>
		                 
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
<script>
function loc(id){
location.href="view_user.php?show_user="+id+"";
}
</script>
