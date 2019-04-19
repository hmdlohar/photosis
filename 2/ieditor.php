<?php
require_once "header.php";
?>

<link rel="stylesheet" type="text/css" href="vendor/color-picker/spectrum.css">
<!-- Page Content -->
<div class="container-flued ieditor-workspace">
	<!--inner menu-->
	<div class="row">
		<div class="container bg-info">
			
				<form onsubmit="return false" class="form-inline" style="padding:10px;">
					
					<div style="">
						<button type="button" id="btnFileUpload" class="btn ">Upload File</button>
						<form id="frmFileUpload" action="fileUpload.php" method="POST" enctype="multipart/form-data">
							<input type="file" name="pdfFile" style="display: none" id="inputFileUpload">
						</form>
						<input type="text" class="form-control" id="userPhotoName" value="Name of photo">
						<div class="btn btn-success" onclick="actionDownload()"><i class="fa fa-download"></i><small class="d-none d-sm-inline"><?php echo ' download';?></small></div>
						<div class="btn btn-success" onclick="actionSave()"><i class="fa fa-save"></i><small class="d-none d-sm-inline"><?php echo ' save';?></small></div>
					</div>					
					<fieldset id="svgControls" disabled="" style="margin-right:30px">
						<button class="btn btn-secondary" onclick="ie.selectedMoveTop()" data-toggle="tooltip" data-placement="top" title="" data-original-title="Move upward" style="margin-left: 20px;"><img src="img/bring-front.png" height="20px;" ></button>
						<button class="btn btn-secondary" onclick="ie.selectedMoveBottom()" data-toggle="tooltip" data-placement="top" title="" data-original-title="Move downward" style="margin-left: 20px;"><img src="img/send-backward.png" height="20px;" ></button>
						<button class="btn btn-secondary" onclick="ie.deleteSelected()" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete" style="margin-left: 20px;"><i class="fa fa-trash"></i></button>
						
					</fieldset>
					<fieldset id="" >
						<div class="btn btn-info" onclick="actionCrop()"><i class="fa fa-crop"></i><small class="d-none d-sm-block">Crop</small></div>
						<div class="btn btn-info" onclick="actionResize()"><i class="fa fa-expand-arrows-alt"></i><small class="d-none d-sm-block">Resize</small></div>
						<div class="btn  btn-info" data-toggle="modal" data-target="#clipartModel"><i class="fa fa-asterisk"></i><small class="d-none d-sm-block">Clip Art</small></div>
						<div class="btn  btn-info" data-toggle="modal" data-target="#frameModel"><i class="far fa-square"></i><small class="d-none d-sm-block">Frame</small></div>
						<div class="btn btn-info" onclick="actionText()"><i class="fa fa-font"></i><small class="d-none d-sm-block">Add Text</small></div>
					</fieldset>
					
					 input file,undo, redo, refresh, full screen
				<form>
		</div>
	</div>
	<br>
	
	<!--main area-->
	<div class="row">	
		<div class="col-md-12 col-xs-12">
			<div class="edit-area" id="editArea">
				<div class="upload-btn">
					<input type="file" class="form-control" id="uploadPhoto" style="display: none">
				</div>
				<svg id="mainSvg"  style="border:0px solid red"  preserveAspectRatio="none">
					
				</svg>
			</div>			
		</div>
		<div class="side-panel" id="sidePanel">
			<div class="effect-area">
			</div>
		</div>
	</div>
	
	<!--features-->
	
	<!---modals-->
	<!---crop modal-->
          <div class="modal fade" id="cropModel" role="dialog">
            <div class="modal-dialog">
    
              <!-- modal content-->
              <div class="modal-content">
                  <div class="modal-header"style="background:#007bff;">
                  
                  <h4 class="modal-title" style="color:white;" >Crop</h4>
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body" id="Div3">
                     <h2>set values:</h2>
                    <div class="row">
                        <div class="col-6">
                            <input class="form-control" type="number" id="cropX1"  placeholder="Top Left"/> 
                        </div>
                         <div class="col-6">
                            <input class="form-control" type="number" id="cropY1"  placeholder="Top Right" />
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-6">
                            <input class="form-control" type="number" id="cropX2"  placeholder="Bottom Left" /> 
                        </div>
                         <div class="col-6">
                            <input class="form-control" type="number" id="cropY2"   placeholder="Bottom Right"/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                        <br />
                            <button class="btn btn-primary" id="btnCropNow">Crop</button>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Submit</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
              </div>
      
            </div>
          </div>
	
	<!---resize  modal-->
	<div class="modal fade" id="resizeModel" role="dialog">
      <div class="modal-dialog" >
    
              <!-- modal content-->
              <div class="modal-content">
                <div class="modal-header"style="background:#007bff;">
                  
                  <h4 class="modal-title" style="color:white;" >Resize</h4>
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body" >
                    <h2>Old Height x Width:</h2>
                    <div class="row">
                        <div class="col-6">
                            <input class="form-control" type="number" id="oldHeight" /> 
                        </div>
                         <div class="col-6">
                            <input class="form-control" type="number" id="oldWidth" />
                        </div>
                    </div>
                    <h2>new Height x Width:</h2>
                    <div class="row">
                        <div class="col-6">
                            <input class="form-control" type="number" id="newHeight" /> 
                        </div>
                         <div class="col-6">
                            <input class="form-control" type="number" id="newWidth" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                        <br />
                            <button class="btn btn-primary" id="btnResizeNow">Resize</button>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Submit</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
              </div>
      
            </div>
          </div>
          
		   <!-- clipart modal -->
          <div class="modal fade" id="clipartModel" role="dialog"  style="width:100%;height:95%;">
            <div class="modal-dialog" style="max-width:100%;text-align:center;height:100%;">
    
              <!-- modal content-->
              <div class="modal-content" style="height:100%;">
                <div class="modal-header"style="background:#007bff;">
                  
                  <h4 class="modal-title" style="color:white;" >Clip Art</h4>
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body" id="clipartBody" >
                  
                </div>
                <div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Submit</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
              </div>
      
            </div>
          </div>
		  
	<div class="modal fade" id="frameModel" role="dialog" style="width:100%; height:95%;">
		<div class="modal-dialog" style="max-width:100%;text-align:center;height:100%;">
    
			<!-- modal content-->
            <div class="modal-content" style="height:100%;">
				<div class="modal-header"style="background:#007bff;">
                  <h4 class="modal-title" style="color:white;" >Frames</h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				<div class="modal-body" id="frameBody">
                </div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Submit</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
            </div>
      </div>
    </div>
	
	
	
	<!---add text modal-->
          <div class="modal fade" id="addTextModel" role="dialog">
            <div class="modal-dialog">
    
              <!-- modal content-->
              <div class="modal-content">
                  <div class="modal-header"style="background:#007bff;">
                  
                  <h4 class="modal-title" style="color:white;" >Add Text</h4>
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body" id="Div3">
                    <h4 style="font-weight:bold;">Add Your Text:</h4>
					<input class="form-control" id="text"  placeholder="Add your text here"/> <hr>
                    <div class="row">
                        <div class="col-6">
							<form onsubmit="return false" class="form-inline" style="padding:10px;">
								<span style="font-weight:bold;">Pick Color:</span>
								<input type='text' id="fullColorPicker"  /><hr>					
							</form>
                        </div>
                         <div class="col-6">
							<form onsubmit="return false" class="form-inline" style="padding:10px;">
								<span style="font-weight:bold;">Pick Font:</span>
								<select class="form-control" style="" id="fontPicker" onchange="ie.setSelectedFont(this.value)">
									<option value="Arial">Arial</option>
									<option value="Arial Black">Arial Black</option>
									<option value="Comic Sans MS">Comic Sans MS</option>
									<option value="Courier New">Courier New</option>
									<option value="Georgia">Georgia</option>
									<option value="Lucida Console">Lucida Console</option>
									<option value="Times New Roman">Times New Roman</option>
									<option value="Verdana">Verdana</option>
									<option value="Geneva">Geneva</option>
								</select>
							
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-6">
                            <input class="form-control" type="number" id="croApX2"  placeholder="Bottom Left" /> 
                        </div>
                         <div class="col-6">
                            <input class="form-control" type="number" id="croApY2"   placeholder="Bottom Right"/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                        <br />
                            <button class="btn btn-primary" id="btnTextNow">Add Text</button>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
              </div>
      </form>
            </div>
          </div>
		  
</div>

<!---javascript-->

<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="vendor/snap-svg/snap.svg.js"></script>
<script src="vendor/color-picker/spectrum.js"></script>

<script type="text/javascript">
$("#fullColorPicker").spectrum({
    color: "#ECC",
    showInput: true,
    className: "full-spectrum",
    showInitial: true,
    showPalette: true,
    showSelectionPalette: true,
    maxSelectionSize: 10,
    preferredFormat: "hex",
    localStorageKey: "spectrum.demo",
    move: function (color) {
        ie.setSelectedColor("#"+color.toHex());
    },
    show: function () {
    
    },
    beforeShow: function () {
    
    },
    hide: function () {
    
    },
    change: function() {
        
    },
    palette: [
        ["rgb(0, 0, 0)", "rgb(37, 37, 37)", "rgb(67, 67, 67)","rgb(88, 88, 88)","rgb(102, 102, 102)", "rgb(130, 130, 130)", "rgb(175, 175,175)",
        "rgb(204, 204, 204)", "rgb(217, 217, 217)", "rgb(232, 232, 232)","rgb(255, 255, 255)"],
        ["rgb(152, 0, 0)", "rgb(255, 0, 0)", "rgb(255, 153, 0)", "rgb(255, 255, 0)","rgb(67, 254, 120)", "rgb(0, 255, 0)",
        "rgb(0, 255, 255)", "rgb(74, 134, 232)", "rgb(0, 0, 255)", "rgb(153, 0, 255)", "rgb(255, 0, 255)"], 
        ["rgb(230, 184, 175)", "rgb(244, 204, 204)", "rgb(252, 229, 205)", "rgb(255, 242, 204)", "rgb(217, 234, 211)", 
        "rgb(208, 224, 227)", "rgb(201, 218, 248)", "rgb(207, 226, 243)", "rgb(217, 210, 233)", "rgb(234, 209, 220)", 
        "rgb(221, 126, 107)", "rgb(234, 153, 153)", "rgb(249, 203, 156)", "rgb(255, 229, 153)", "rgb(182, 215, 168)", 
        "rgb(162, 196, 201)", "rgb(164, 194, 244)", "rgb(159, 197, 232)", "rgb(180, 167, 214)", "rgb(213, 166, 189)", 
        "rgb(204, 65, 37)", "rgb(224, 102, 102)", "rgb(246, 178, 107)", "rgb(255, 217, 102)", "rgb(147, 196, 125)", 
        "rgb(118, 165, 175)", "rgb(109, 158, 235)", "rgb(111, 168, 220)", "rgb(142, 124, 195)", "rgb(194, 123, 160)",
        "rgb(166, 28, 0)", "rgb(204, 0, 0)", "rgb(230, 145, 56)", "rgb(241, 194, 50)", "rgb(106, 168, 79)",
        "rgb(69, 129, 142)", "rgb(60, 120, 216)", "rgb(61, 133, 198)", "rgb(103, 78, 167)", "rgb(166, 77, 121)",
        "rgb(91, 15, 0)", "rgb(102, 0, 0)", "rgb(120, 63, 4)", "rgb(127, 96, 0)", "rgb(39, 78, 19)", 
        "rgb(12, 52, 61)", "rgb(28, 69, 135)", "rgb(7, 55, 99)", "rgb(32, 18, 77)", "rgb(76, 17, 48)"],
		["rgb(225, 0, 0)", "rgb(255, 30, 0)", "rgb(255, 130, 0)", "rgb(255, 230, 0)","rgb(255, 0, 30)", "rgb(255, 0, 130)",
        "rgb(255, 0, 230)", "rgb(255, 130, 130)", "rgb(255, 230, 230)", "rgb(255, 130, 230)", "rgb(255, 230, 130)"],
    ]
});
</script>

<script src="js/ieditor-function.js"></script>
<script src="js/ieditor.js"></script>
<script type="text/javascript">

$(document).ready(function(){
	$("#btnFileUpload").click(fileUploadDialog);
});
function fileUploadDialog(){
	$("#uploadPhoto").click();
	$("#uploadPhoto").change(function(){
		var ex=this.value.split(".");
		var ext=ex[ex.length-1];
		console.log(ext);
		var extArr=['pdf'];
		if(extArr.indexOf(ext)==-1){
			console.log("no upload");
			//notie.alert({"text":"Please Upload valid pdf file. Currently we do not accept other formats. ",type:2});
			return;
		}

		$("#frmFileUpload").submit();
	});
}
</script>

<?php
require_once "footer.php";
?>