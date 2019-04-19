function iEditor(currSvg){
	var snap=Snap(currSvg);
	var rectAdiVar=null;
	window.sn=snap;
	var config={addSvgSize: 200};
	var svgs=[];
	var selectedSvg=null;
	var resizing=false;
	var rotating=false;
	var mouseMoveElement=document;
	var elementSeleccted=function(){}
	var svgFrame=null;
	document.onmouseup=clearMoving;
	currSvg.onclick=currSvgClick;
	document.onkeypress=svgKeyPress;
	//getSetFrameElement();


	function getSetFrameElement(){
		if(mainSvg.getElementById("svgFrame")){
			svgFrame=mainSvg.getElementById("svgFrame");
		}
		else{
			var f=snap.image("",0,0,"100%","100%");
			f.attr({
				id:"svgFrame"
			});
			svgFrame=f.node;
		}
	}
	function createDivRect(x,y,height,width,isText){
		var rectXY=toRectXY(x,y);
		var rect=document.createElement("div");
		var lineRect=document.createElement("div");
		var roundRectAdi=document.createElement("div");
		var textRectAdi=document.createElement("input");
		rect.id="rectAdi";
		lineRect.id="linerectAdi";
		roundRectAdi.id="roundRectAdi";
		textRectAdi.id="textRectAdi";
		lineRect.style="background-color:#000000;height:10px;width:10px;position:absolute;bottom:-10px;right:-10px;cursor:nwse-resize";
		rect.style="height: "+width+"px;width: "+height+"px;position: absolute;top: "+rectXY.y+"px;left:"+rectXY.x+"px;border: 1px solid blue;background-color:rgba(255,255,255,0.1)";
		roundRectAdi.style="background-color:#000000;height:10px;width:10px;position:absolute; right:-15px; top:49%;cursor:grabbing;border-radius:10px;";
		textRectAdi.style="position:absolute; top:-26px;";
		rect.appendChild(lineRect);
		if(isText){
			rect.appendChild(textRectAdi);
		}
		rect.appendChild(roundRectAdi);
		//console.log(rect.style);
		currSvg.parentElement.appendChild(rect);
		return rect;
	}
	function moveRect(x,y){
		var t=toRectXY(x,y);
		rectAdiVar.style.left=(rectAdiVar.offsetLeft+x)+"px";
		rectAdiVar.style.top=(rectAdiVar.offsetTop+y)+"px";
	}
	function moveRectTo(x,y){
		var t=toRectXY(x,y);
		rectAdiVar.style.left=(t.x)+"px";
		rectAdiVar.style.top=(t.y)+"px";
	}
	function resizeRect(height,width){
		$(rectAdiVar).height($(rectAdiVar).height()+height);
		$(rectAdiVar).width($(rectAdiVar).width()+width);
	}
	function resizeRectTo(height,width){
		$(rectAdiVar).height(height);
		$(rectAdiVar).width(width);
	}
	function toRectXY(ax,ay){
		//var pos=currSvg.getBoundingClientRect();
		var cx=editArea.offsetLeft+5;
		var cy=editArea.offsetTop+20;
		return {x: cx +ax,y: cy+ay};
	}
	function clearMoving(){
		this.onmousemove=null;
		resizing=false;
		rotating=false;
		mouseMoveElement.onmousemove=null;
		mouseMoveElement=document;
	}
	function clearAllMouseEvents(){
		for(svg of svgs){
			svg.onmousedown=null;
		}
		currSvg.onmousemove=null;
	}
	function setAllMouseEvents(){
		for(svg of svgs){
			svg.onmousedown=svgClick;
			
			//svg.onmouseenter=svgClick;
		}
	}
	function borderStroke(val){
        return (currSvg.viewBox.baseVal.height/500) * val;
    }
    function toViewBox(unit){
    	return unit;
        return Math.ceil(currSvg.viewBox.baseVal.height*unit/currSvg.height.baseVal.value);
    }
    function getCenter(){
    	var cy=((selectedSvg.height.baseVal.value/2) + selectedSvg.y.baseVal.value);
    	var cx=((selectedSvg.width.baseVal.value/2) + selectedSvg.x.baseVal.value);
    	return{x: cx, y: cy};
    }
    function angle(cx, cy, ex, ey) {
	  var dy = ey - cy;
	  var dx = ex - cx;
	  var theta = Math.atan2(dy, dx); // range (-PI, PI]
	  theta *= 180 / Math.PI; // rads to degs, range (-180, 180]
	  if (theta < 0) theta = 360 + theta; // range [0, 360)
	  return theta;
	}
	function currSvgClick(){
    	$(rectAdiVar).remove();
    	selectedSvg=null;
    	//textToolbar.disabled=false;
    	currSvg.parentElement.removeAttribute("contenteditable");
    	elementSeleccted(null);
    }
    function svgKeyPress(e){
    	console.log("to",e);
    	if(e.charCode==127){
    		$(selectedSvg).remove();
    		currSvgClick();
    	}
    }
    function svgClick(e){
    	window.ee=e;
    	window.th=this;
    	selectedSvg=this;
    	var isText=false;
    	if(selectedSvg.getAttribute("data-type")!= "25"){
    		//textToolbar.disabled=true;
    	}
    	else{
    		//textToolbar.disabled=false;
    		isText=true;
    		//currSvg.parentElement.setAttribute("contenteditable","");
    	}
    	//selectedSvg.onmouseup=clearMoving;

        if($(this).find("#rectAdi").length==0){
        	//console.log("do");
        	if(rectAdiVar){
        		$(rectAdiVar).remove();
        	}
            rectAdiVar=createDivRect(this.x.baseVal.value,this.y.baseVal.value,this.width.baseVal.value,this.height.baseVal.value,isText);
            if(selectedSvg.rt){
            	//console.log("tt");
            	rectAdiVar.style.transform="rotate("+selectedSvg.rt+"deg)";
            }


            linerectAdi=$(rectAdiVar).find("#linerectAdi")[0];
            roundRectAdi=$(rectAdiVar).find("#roundRectAdi")[0];
            linerectAdi.onmousedown=function(){
            	resizing=true;
            }
            roundRectAdi.onmousedown=function(){
            	rotating=true;
            	mouseMoveElement=currSvg;
            }
            if(isText){
            	var textRectAdi=$(rectAdiVar).find("#textRectAdi")[0];
            	textRectAdi.oninput=textRectAdiInputEvent;
				var t=$(selectedSvg).find("text");
    			textRectAdi.value=t.text();
            }
            rectAdiVar.onmousedown=rectAdiMouseDown;
            elementSeleccted(selectedSvg);
        }
        //currSvg.onmousemove=svgMouseMove;
    }
    function rectAdiMouseDown(e){
    	e.stopPropagation();
    	selectedSvg.focus();
    	mouseMoveElement.onmousemove=svgMouseMove;
    }
    function textRectAdiInputEvent(e){
    	iEditor.prototype.setSelectedText(this.value);
    }
    function svgMouseMove(e){
    	var xNow=toViewBox(e.movementX);
    	var yNow=toViewBox(e.movementY);
    	//console.log(e);
    	window.ee=e;
    	var c=getCenter();
    	//console.log(rectAdiVar);
        if(resizing){
            selectedSvg.height.baseVal.value+=yNow;
            selectedSvg.width.baseVal.value+=xNow;
            resizeRectTo(selectedSvg.height.baseVal.value,selectedSvg.width.baseVal.value);
            if(selectedSvg.rt){
            	selectedSvg.parentElement.setAttribute("transform","rotate("+selectedSvg.rt+","+c.x+","+c.y+")");
            }
        }
        else if(rotating){
        	var c=getCenter();
        	//console.log("deg",angle(c.x,c.y,e.offsetX,e.offsetY));
        	var cx=editArea.offsetLeft;
    		var cy=editArea.offsetTop;
        	var rt=Math.ceil(angle(c.x,c.y,e.offsetX ,e.offsetY));
        	iEditor.prototype.rotateSelected(rt);
        }
        else{
        	//console.log(toViewBox(e.movementX) + " "+ e.movementX);
            selectedSvg.x.baseVal.value+= Math.ceil(xNow);
            selectedSvg.y.baseVal.value+= Math.ceil(yNow);
            moveRectTo(selectedSvg.x.baseVal.value,selectedSvg.y.baseVal.value);
            if(selectedSvg.rt){
            	selectedSvg.parentElement.setAttribute("transform","rotate("+selectedSvg.rt+","+c.x+","+c.y+")");
            }
        }
    }

	iEditor.prototype.setOnElementSelected=function(func){
		elementSeleccted=func;
	}
	iEditor.prototype.setFrameSrc=function(imgSrc){
		if(!svgFrame){
			svgFrame=mainSvg.getElementById("svgFrame");
			
		}
		Snap(svgFrame).attr({href:imgSrc});
	}

	iEditor.prototype.addBackgroundImg=function(src,height,width){
		$(currSvg).data("loaded","1");
        window.te=snap.image(src,0,0,width,height);
		snap.attr({viewBox:"0 0 "+width+" "+height,height:height,width:width});
		getSetFrameElement();
	}
    iEditor.prototype.addImg=function(src,height,width){
		var g=Snap(currSvg).g();
        var te=snap.image(src,0,0,width,height);
    	g.node.appendChild(te)
		svgs.push(te);
		setAllMouseEvents();
	}
	iEditor.prototype.addSvg=function(svg){
    	svg.removeAttribute("id");
    	svg.removeAttribute("xmlns");
    	svg.setAttribute("preserveAspectRatio","none");
    	var g=Snap(currSvg).g();
    	g.node.appendChild(svg)
		svgs.push(svg);
		setAllMouseEvents();
    }
	iEditor.prototype.addText1=function(text){
		
		var cSvg=snap.svg(400,400,50,50,0,0,500,60);
		window.txt=cSvg.text(0,45,text).attr({"font-size":"50","id":"txtAdi","font-family":"LKLUG"});
		txt.node.style.cursor="pointer";
		cSvg.node.width.baseVal.value=txt.getBBox().width;
		cSvg.node.height.baseVal.value=txt.getBBox().height;
		cSvg.attr({viewBox: "0 0 "+txt.getBBox().width+" 60","preserveAspectRatio":"none","data-type":"25"});
		svgs.push(cSvg.node);
		//setAllMouseEvents();
	}



	iEditor.prototype.allSvgs=function(){
		return svgs;
	}
	iEditor.prototype.deleteSelected=function(){
		if(selectedSvg){
			selectedSvg.remove();
		}
		currSvgClick();
	}
	iEditor.prototype.selected=function(){
		return selectedSvg;
	}	
	iEditor.prototype.selectedMoveTop=function(){
		if(selectedSvg){
			if($(currSvg).children("g").length >1){
				if($(selectedSvg).parent().next("g").length == 1){
					$(selectedSvg).parent().next("g").after($(selectedSvg).parent());
				}
			}
		}
	}	
	iEditor.prototype.selectedMoveBottom=function(){
		if(selectedSvg){
			if($(currSvg).children("g").length >1){
				if($(selectedSvg).parent().prev("g").length == 1){
					$(selectedSvg).parent().prev("g").before($(selectedSvg).parent());
				}
			}
		}
	}
	iEditor.prototype.rectAdiVar=function(){
		return rectAdiVar;
	}
	
    iEditor.prototype.addSvgData=function(svgData){
    	var temp=document.createElement("div");
    	temp.innerHTML=svgData;
    	var svg=temp.getElementsByTagName("svg")[0];
    	svg.removeAttribute("id");
    	svg.removeAttribute("xmlns");
    	svg.setAttribute("preserveAspectRatio","none");
    	var g=Snap(currSvg).g();
    	g.node.appendChild(svg)
		//currSvg.appendChild(svg);
		svgs.push(svg);
		setAllMouseEvents();
    }
    iEditor.prototype.clearEvents=function(){
    	clearAllMouseEvents();
    }
    iEditor.prototype.setEvents=function(){
    	setAllMouseEvents();
    }
    iEditor.prototype.rotateSelected=function(deg){
    	if(!rectAdi){
    		return;
    	}
    	var c=getCenter();
    	rectAdi.style.transform="rotate("+deg+"deg)";
    	selectedSvg.parentElement.setAttribute("transform","rotate("+deg+","+c.x+","+c.y+")");
    	selectedSvg.rt=deg;
    }
    iEditor.prototype.setSelectedText=function(text){
    	var t=$(selectedSvg).find("text");
    	t.text(text);
    	setTimeout(function(){
    		var tp=t.parent()[0];
    		tp.width.baseVal.value=t[0].getBBox().width;
    		t.parent().attr({viewBox: "0 0 "+t[0].getBBox().width+" 60"});
    		resizeRectTo(selectedSvg.height.baseVal.value,selectedSvg.width.baseVal.value);
    	},100);
    }
    iEditor.prototype.addText=function(text){
    	var g=Snap(currSvg).g();
    	var cSvg=g.svg(0,0,50,50,0,0,500,60);
    	window.txt=cSvg.text(0,45,text).attr({"font-size":"50","id":"txtAdi","font-family":"LKLUG"});
    	txt.node.style.cursor="pointer";
    	cSvg.node.width.baseVal.value=txt.getBBox().width;
    	cSvg.node.height.baseVal.value=txt.getBBox().height;
    	cSvg.attr({viewBox: "0 0 "+txt.getBBox().width+" 60","preserveAspectRatio":"none","data-type":"25"});
		svgs.push(cSvg.node);
		setAllMouseEvents();
    }
    iEditor.prototype.addTextAsDiv=function(text){
    	var txt=document.createElementNS("http://www.w3.org/2000/svg","foreignObject");
    	txt.id="tAdi";
    	var txtDiv=document.createElement("div");
    	txtDiv.setAttribute("contenteditable","");
    	txtDiv.style.fontSize="50px";
    	txtDiv.innerHTML=text;
    	txt.appendChild(txtDiv);
    	var g=Snap(currSvg).g();
    	//var cSvg=g.svg(400,400,50,50,0,0,500,60);
    	//window.txt=cSvg.text(0,45,text).attr({"font-size":"50","id":"txtAdi","font-family":"LKLUG"});
    	//cSvg.node.appendChild(txt);
    	txt.style.cursor="pointer";
    	//cSvg.node.width.baseVal.value=txt.getBBox().width;
    	//cSvg.node.height.baseVal.value=txt.getBBox().height;
    	//cSvg.attr({viewBox: "0 0 "+txt.getBBox().width+" 60","preserveAspectRatio":"none","data-type":"25"});
    	Snap(txt).attr({x:400,y:400,height:50,width:100});
    	g.node.appendChild(txt);
		svgs.push(txt);
		setAllMouseEvents();
    }
    iEditor.prototype.setSelectedFont=function(fontName){
    	var t=Snap($(selectedSvg).find("text")[0]);
    	t.attr("font-family", fontName);
    	setTimeout(function(){
    		t.parent().attr({viewBox: "0 0 "+t.getBBox().width+" 60"});
    	},100);
    }
    iEditor.prototype.setOpacity=function(per){
    	Snap(selectedSvg).attr("opacity",per/100);
    }    
    iEditor.prototype.getOpacity=function(){
    	return Snap(selectedSvg).attr("opacity")*100;
    }
    iEditor.prototype.setSelectedColor=function(cl){
    	var t=$(selectedSvg).find("text").attr("fill", cl);

    }
    iEditor.prototype.makeCopy=function(){
    	if(selectedSvg){
    		window.t=selectedSvg.cloneNode(true);
    		iEditor.prototype.addSvg(t);
    		selectedSvg.x.baseVal.value+= 20;
            selectedSvg.y.baseVal.value+= 20;
    	}
    }
    
}

function getPngFromSvg(currSvg,h,w,onDone){
	var newSvg=currSvg.cloneNode(true);
	var pngCanvas=document.createElement("canvas");
	window.can=pngCanvas;
	newSvg.setAttribute("height",h+"px");
	newSvg.setAttribute("width",w+"px");
	pngCanvas.setAttribute("height",h+"px");
	pngCanvas.setAttribute("width",w+"px");
	var svgString = new XMLSerializer().serializeToString(newSvg);
    var ctx = pngCanvas.getContext("2d");
    var DOMURL = self.URL || self.webkitURL || self;
    var img = new Image();
    var svg = new Blob([svgString], {type: "image/svg+xml;charset=utf-8"});
    var url = DOMURL.createObjectURL(svg);
    img.src = url;
    img.onload=function(){
    	ctx.drawImage(img, 0, 0);
    	var png = pngCanvas.toDataURL("image/png");
    	DOMURL.revokeObjectURL(url);
    	onDone(png);
    }
}

function triggerDownload (imgURI,name) {
    var evt = new MouseEvent('click', {
        view: window,
        bubbles: false,
        cancelable: true
    });

    var a = document.createElement('a');
    a.setAttribute('download', name+'.png');
    a.setAttribute('href', imgURI);
    a.setAttribute('target', '_blank');
    a.dispatchEvent(evt);
}
