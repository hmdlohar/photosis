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
$total_items=sql_query("select count(user_id) as total from likes order by time")[0]['total'];
function convertDateToAgo1($date){
	 $dateNow = time();
	 $dateThen = strtotime($date);
	 
	 $dateDiffInSec = ( $dateNow -$dateThen) ;	
	//print_r($dateNow,$dateThen,$dateDiffInSec);
	if($dateDiffInSec < 8 ){
		return " Just Now";
	}
	else if($dateDiffInSec < 60 && $dateDiffInSec > 10){
		return floor($dateDiffInSec) . " Second Ago";
	}
	else if($dateDiffInSec > 60 && $dateDiffInSec < 3600){
		return floor($dateDiffInSec / 60) . " Minutes Ago";
	}
	else if($dateDiffInSec > 60 && $dateDiffInSec < (3600 * 24)){
		return floor(($dateDiffInSec / 60) /60) . " Hours Ago";
	}
	else if($dateDiffInSec > 3600 ){
		return floor($dateDiffInSec / 60 /60 /24) . " Days Ago";
	}
	return "wrong";
}
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
                  <th>Liked Photo</th>
                  <th>Uploaded By</th>
                  <th>Liked By</th>
                  <th>Date & Time</th>
                </tr>
              </thead>

              <tbody>
              	<?php 
              	$alllikes=sql_query("select  * from likes order  by time desc");
				foreach ($alllikes as $key => $value) {
					$ago=convertDateToAgo1($value['time']);
					$owner_name=sql_query('select  username as name from users where id='.$value["photo_owner_id"].' ');
					$user_name=sql_query('select  username as name from users where id='.$value["user_id"].' ');
              	echo '<tr>
		                  <td ><a href="view_photo.php?show_photo='.$value['photo_id'].'"><img  class="rounded-circle"style="height:45px;width:45px;margin:auto;" src="../user_photos/png/'.$value['photo_id'].'.png"></a></td>
		                  <td>
							<a style="text-decoration:none;" href="view_user.php?show_user='.$value['photo_owner_id'].'"><img  class="rounded-circle"style="height:45px;width:45px;margin:auto;margin-right:8px;" src="../user_pics/'.$value['photo_owner_id'].'.png">'.$owner_name[0]['name'].'</a></td>
		                  <td>
							<a style="text-decoration:none;" href="view_user.php?show_user='.$value['user_id'].'"><img  class="rounded-circle"style="height:45px;width:45px;margin:auto;margin-right:8px;" src="../user_pics/'.$value['user_id'].'.png">'.$user_name[0]['name'].'</a></td>
		                  <td>
							'.$ago.'
		                  </td>
		                  <td></td>
		                  <td>';
		                  ?>
						
		                  <?php
		                  echo '</td>
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
