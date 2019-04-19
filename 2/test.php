<script type="text/javascript" src="js/jquery.js"></script>
<div>
	<label for="files" class="btn">Select Image</label>
	<label id="files" style="visibility:hidden" type="file">
</div>
<script>
$("#files").change(function(){
	filename=this.files[0].name
	console.log(filename);
});
</script>

