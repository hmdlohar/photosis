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
$total_items=sql_query("select count(id) as total from assets where type='clipart'")[0]['total'];

?>

		<main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
    	<?php 
    	
    		if(isset($_GET['error'])){
    			echo '<div class="alert alert-danger">Error:'.$_GET['error'].'</div>';
    		}
    	?>

          <h2>Cliparts
			<a class="btn btn-sm btn-primary float-right " href="clipart_add.php" >Add Cliparts</a>
          </h2>

          <div class="table table-responsive">
            <table class="table table-striped table-sm">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Name</th>
                  <th>Image</th>
                  <th width="20%">Action</th>
                </tr>
              </thead>

              <tbody>
              	<?php 
              	//echo "select * from assets where type='clipart' limit {$start} {$count}";
              	$allCliparts=sql_query("select * from assets where type='clipart' limit {$start} ,{$count}");
              	foreach ($allCliparts as $key => $value) {
              		echo "<tr>
		                  <td>{$value['id']}</td>
		                  <td>{$value['name']}</td>
		                  <td><img src='../assets/{$value['id']}.png' style='width:100px;'></td>
		                  <td>";
		                  ?>
		                  <a class="btn-sm btn-primary" href="clipart_update.php?id=<?php echo $value['id']; ?>&name=<?php echo $value['name']; ?>">Update</a>
		                  <a class="btn-sm btn-danger" href="db_model.php?delete_assets=1&id=<?php echo $value['id']; ?>" >Delete</a>
		                  <?php
		                  echo "</td>
		                </tr>";
              	}
              ?>
                
                
              </tbody>
            </table>
          </div> <!-- Table Div ends -->
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

</script>