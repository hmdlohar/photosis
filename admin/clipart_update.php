<?php
if(isset($_GET['id'])){
	$id=$_GET['id'];
	$name=$_GET['name'];
}
else{
	header("Location: cliparts.php");
}
require "header.php";

?>

	<main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
		<form action="db_model.php" method="POST" enctype="multipart/form-data">
			<table class="table">
				<tr>
					<td>Name: </td>
					<td><input type="text" class="form-control" name="name" value='<?php echo $name; ?>'></td>
				</tr>
				<tr>
					<td>File: </td>
					<td>
						<img src="../assets/<?php echo $id; ?>.png" id="assetImage" height=200 width=200>
						<br>
						Change Image<input type="file" class="form-control" id="assetImageInput" name="image">
					</td>
				</tr>
				<tr>
					<td></td>
					<input type="hidden" name="type" value="clipart">
					<input type="hidden" name="id" value="<?php echo $id; ?>">
					<td><input type="submit" class="btn btn-primary" name="update_assets" value="update"></td>
				</tr>
			</table>
		</form>
    </main>


<?php 
require "footer.php";
?>
<script type="text/javascript">
$(document).ready(function(){
	$("#assetImageInput").change(onUploadPhoto);
});
function onUploadPhoto(){
	var r=new FileReader();
	r.readAsDataURL(this.files[0]);
	$(this).hide();
	r.onload=function(d){
		var img=document.createElement("img");
		img.src=d.target.result;
		$("#assetImage")[0].src=d.target.result;
	}
}	
</script>