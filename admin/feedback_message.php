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
$total_items=sql_query("select count(id) as total from contact_messages")[0]['total'];
?>

		<main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
    	<?php 
    		if(isset($_GET['error'])){
    			echo '<div class="alert alert-danger">Error:'.$_GET['error'].'</div>';
    		}
    	?>

          <h2>Likes</h2>

          <div class="table table-responsive">
            <table class="table table-striped table-sm">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Subject</th>
                  <th>Message</th>
                </tr>
              </thead>

              <tbody>
              	<?php 
              	$message=sql_query("select * from contact_messages");
				foreach ($message as $key => $value) {
              	echo '<tr>
		                  <td style="width:100px;font-weight:bold">'.$value['id'].'</td>
		                  <td style="width:100px;color:#036b7b;font-weight:bold;">'.$value['name'].'</td>
		                  <td style="width:150px;color:#0aada5; font-weight:bold;">'.$value['email'].'</td>
		                  <td style="width:100px;color:#042c69; font-weight:bold;">'.$value['subject'].'</td>
		                  <td style="width:250px;font-weight:bold">'.$value['message'].'</td>
		                  </tr>';
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

</script>
