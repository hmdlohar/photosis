<?php
require_once "header.php";

if(isset($_GET['user_photo'])){
  echo "<script>window.user_photo={$_GET['user_photo']};</script>";
}
else{
  echo "<script>window.user_photo=-1;</script>";
}
?>

<link rel="stylesheet" type="text/css" href="vendor/color-picker/spectrum.css">
<!-- Page Content -->
<div class="container-flued ieditor-workspace">
	<!--inner menu-->
	<div class="row">
		<div class="col-lg-1">
				<div class="container  "  style="">
			
					<form onsubmit="return false" class="form-inline" style="padding:10px;">
						<div class="row "style="margin-left:26px; background-color:#17a2b8">
						<div style="" class="row-lg-5.5">
							<button type="button"data-toggle="tooltip" data-placement="top" title="" data-original-title="Upload Photo"  id="btnFileUpload" class="btn btn-success" style="background-color:black;"><i class="fa fa-upload"></i></button>
								<input type="file" name="myFile" style="display: none" id="inputFileUpload">
							<div class="btn btn-success" onclick="actionDownload()" style="background-color:black;"data-toggle="tooltip" data-placement="top" title="" data-original-title="Download Photo" ><i class="fa fa-download"></i><small class="d-none d-sm-inline"></small></div>
							<div class="btn btn-success" onclick="actionWrite()" style="background-color:black;"data-toggle="tooltip" data-placement="top" title="" data-original-title="Save Photo" ><i class="fa fa-save"></i><small class="d-none d-sm-inline"></small></div>
						</div>				
					<fieldset id="svgControls" style=""class="row-lg-2.5">
							<button class="btn btn-sm btn-secondary" onclick="ie.selectedMoveTop()" data-toggle="tooltip" data-placement="top" title="" data-original-title="Move upward" style=""><img src="img/bring-front.png" height="20px;" ></button>
							<button class="btn btn-sm btn-secondary" onclick="ie.selectedMoveBottom()" data-toggle="tooltip" data-placement="top" title="" data-original-title="Move downward" style=""><img src="img/send-backward.png" height="20px;" ></button>
							<button class="btn btn-secondary" onclick="ie.deleteSelected()" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete" style=""><i class="fa fa-trash"></i></button>
							
						</fieldset>
						<fieldset id="" style="" class="row-lg-4.1">
							<div class="btn btn-info" onclick="actionCrop()" style="background-color:black;"data-toggle="tooltip" data-placement="top" title="" data-original-title="Crop Photo" ><i class="fa fa-crop"></i><small class="d-none d-sm-block"></small></div>
							<div class="btn btn-info" onclick="actionResize()" style="background-color:black;"data-toggle="tooltip" data-placement="top" title="" data-original-title="Resize Photo" ><i class="fa fa-expand-arrows-alt"></i><small class="d-none d-sm-block"></small></div>
							<div class="btn  btn-info"  onclick="showClipartModal()" style="background-color:black;"data-toggle="tooltip" data-placement="top" title="" data-original-title="Add Clip Arts" ><i class="fa fa-asterisk"></i><small class="d-none d-sm-block"></small></div>
							<div class="btn  btn-info" onclick="showFrameModal()" style="background-color:black;"data-toggle="tooltip" data-placement="top" title="" data-original-title="Add Frames" ><i class="far fa-square"></i><small class="d-none d-sm-block"></small></div>
							<div class="btn btn-info" onclick="actionText()" style="background-color:black;"data-toggle="tooltip" data-placement="top" title="" data-original-title="Add Text" ><i class="fa fa-font"></i><small class="d-none d-sm-block"></small></div>
						</fieldset>
						</div>
					<form>
			</div>
		</div>
		
	<!--main area-->
		<div class="col-lg-10">
			<div class="row">	
				<div class="col-md-12 "style="">
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
		</div>
		
	</div>
	<br>
	
	
	
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
                </div>
                <div class="modal-footer">
					<button class="btn btn-primary" id="btnCropNow"style="background-color:blue;margin-right:300px;">Crop</button>
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
          </div>
          <div class="modal-footer">
			  <button class="btn btn-primary" id="btnResizeNow"style="background-color:blue;margin-right:300px;">Resize</button>
        		<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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
  					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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
  				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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
        
  					<span style="font-weight:bold;">Pick Color:</span>
  					<input type='text' id="fullColorPicker"  />
            <hr/>
      			<span style="font-weight:bold;">Pick Font:</span>
      			<select class="form-control" style="" id="fontPicker" onchange="ie.setSelectedFont(this.value)">
      				<option value="Arial" style="font-family: arial; font-size:14pt;">Arial</option>
      				<option value="Calibri" style="font-family: Calibri; font-size:14pt;">Calibri</option>
      				<option value="Cambria" style="font-family: Cambria; font-size:14pt;">Cambria</option>
      				<option value="Candara" style="font-family: Candara; font-size:14pt;">Candara</option>
      				<option value="Impact" style="font-family: Impact; font-size:14pt;">Impact</option>
      				<option value="Lucida Console" style="font-family: Lucida Console; font-size:14pt;">Lucida Console</option>
      				<option value="Mangal" style="font-family: Mangal; font-size:14pt;">Mangal</option>
      				<option value="Copperplate Gothic" style="font-family: Copperplate Gothic; font-size:14pt;">Copperplate Gothic</option>
      				<option value="Courier New" style="font-family: Courier New; font-size:14pt;">Courier New</option>
      				<option value="Georgia" style="font-family: Georgia; font-size:14pt;">Georgia</option>
      				<option value="Gill Sans" style="font-family: Gill Sans; font-size:14pt;">Gill Sans</option>
      				<option value="Arial Black" style="font-family: Arial Black; font-size:14pt;">Arial Black</option>
      				<option value="Comic Sans MS" style="font-family: Comic Sans MS; font-size:14pt;">Comic Sans MS</option>
      				<option value="Courier New" style="font-family: Courier New; font-size:14pt;">Courier New</option>
      				<option value="Georgia" style="font-family: Georgia; font-size:14pt;">Georgia</option>
      				<option value="Lucida Console" style="font-family: Lucida Console; font-size:14pt;">Lucida Console</option>
      				<option value="Times New Roman" style="font-family: Times New Roman; font-size:14pt;">Times New Roman</option>
      				<option value="Verdana" style="font-family: Verdana; font-size:14pt;">Verdana</option>
      				<option value="Geneva" style="font-family: Geneva; font-size:14pt;">Geneva</option>
      			</select>
          
        <div class="row">
            <div class="col">
            <br />
                
            </div>
        </div>
      </div>
        <div class="modal-footer">
			<button class="btn btn-primary" id="btnTextNow"style="margin-right:300px;background-color:blue;" >Add Text</button>
                <button class="btn btn-primary" data-dismiss="modal" style="margin-right:300px;background-color:blue;"  id="btnTextCancel" style="display:none">Apply</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
		  
  <!---Write modal-->
  <div class="modal fade "  id="writeModel" role="dialog">
    <div class="modal-dialog ">
      <div class="modal-content ">
        <div class="modal-header "style="background:#007bff;">
          
          <h4 class="modal-title " style="color:white;" >Write Something...</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body" id="Div3">
          <div class="">
        		<h2>Photo's Name</h2>
        		<input maxlength="25" type="text" style="width:450px; margin-top:05px; margin-bottom:0.5px; margin-bottom:20px" class="form-control" id="userPhotoName" value="Name of photo"><hr>
        		<h2>Photo's Story</h2>
        		<textarea maxlength="1000"style="width:450px; margin-top:05px;" class="form-control" id="userPhotoDesc" placeholder="Story of photo"></textarea>
          </div>
          <div class="row">
              <div class="col">
              <br />
                  <button class="btn btn-primary" id="btnWriteNow" onclick="funct()" style="background-color:blue;margin-right:300px;">POST</button>
              </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button " class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
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
		
	});
}

function funct(){
	$("#writeModel").modal("hide");
	}
</script>

<?php
require_once "footer.php";
?>
