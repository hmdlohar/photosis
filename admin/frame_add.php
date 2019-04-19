<?php
require "header.php";
?>

	<main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
		<form action="db_model.php" method="POST" enctype="multipart/form-data">
			<table class="table">
				<tr>
					<td>Name: </td>
					<td><input type="text" class="form-control" name="name"></td>
				</tr>
				<tr>
					<td>File: </td>
					<td>
						<input type="file" class="form-control" name="image">
					</td>
				</tr>
				<tr>
					<td></td>
					<input type="hidden" name="type" value="frame">
					<td><input type="submit" class="btn btn-primary" name="in_assets"></td>
				</tr>
			</table>
		</form>
    </main>


<?php 
require "footer.php";
?>