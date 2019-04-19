function writeComment(element,photo_id)
{
	var comment=$(element).siblings("input").val();
	if(comment.length == 0)	
		notie.alert({text: "Please Write some Comment...",type:3});
	else{
	$.ajax({
			url: "dataProvider.php",
			type: "POST",
			data:{
				doComment: true,
				comment : comment,
				photo_id: photo_id
			},
			success: function(data){
				if(data != "error")
				{
					window.comments=JSON.parse(data);
					var rootGallery = $(element).parentsUntil(".gallery");
					var name =rootGallery.find(".card-img-top")[0].click();
					// $("#imagePopup").show(500);
					// $("#imgPopup")[0].src = "user_photos/png/"+photo_id+".png";
					// $("#username").empty();
					// $("#photoname").empty();
					// $("#photodescription").empty();
					// $("#username").innerText=comments[0].uname;
					// $("#photoname").innerText=comments[0].pname;
					// $("#photodescription").innerText=comments[0].description;
					// for(c of comments){
					// 	$("#comment_area").append("<div style='border:2px solid #dedede;' class='rounded'><span style='font-size:20px'class='text-info'>"+c.username+"</span><div style='border:2px solid #dedede'>"+c.comment+"<span style='float:right'>qqq</span></div></div>");
					// }
				}
			},
			error: function(err){
				console.log(err);
			}
		});
	}
}

function loadCommentForOnePhoto(photoId){
	$.ajax({
			url: "dataProvider.php",
			type: "POST",
			data:{
				getCommentsForPhoto: true,
				photoId :photoId 
			},
			success: function(data){
				if(data != "error")
				{
					window.comments=JSON.parse(data);
					$("#imagePopup").show(500);
				
					$("#comment_area").empty();
					for(var commentIndex in comments){
						var comment = comments[commentIndex];
						$("#comment_area").append("<div style='border:2px solid #dedede;' class='rounded'><span style='font-size:20px'class='text-info'>"+comment.username+"</span><div style='border:2px solid #dedede'>"+comment.comment+"<span style='float:right'>"+convertDateToAgo(comment.time)+"</span></div></div>");
					}
				}
			},
			error: function(err){
				console.log(err);
			}
		});
	
}

function convertDateToAgo(date){
	var dateNow = new Date();
	var dateThen = new Date(date);
	var dateDiffInSec = ( dateNow.getTime() -dateThen.getTime()) / 1000;	
	console.log(dateNow,dateThen,dateDiffInSec);
	if(dateDiffInSec < 8 ){
		return " Just Now";
	}
	else if(dateDiffInSec < 60 && dateDiffInSec > 10){
		return Math.floor(dateDiffInSec) + " Second Ago";
	}
	else if(dateDiffInSec > 60 && dateDiffInSec < 3600){
		return Math.floor(dateDiffInSec / 60) + " Minutes Ago";
	}
	else if(dateDiffInSec > 60 && dateDiffInSec < (3600 * 24)){
		return Math.floor((dateDiffInSec / 60) /60) + " Hours Ago";
	}
	else if(dateDiffInSec > 3600 ){
		return Math.floor(dateDiffInSec / 60 /60 /24) + " Days Ago";
	}
	return "wrong";
}

function writeComment1(element,photo_id)
{
	var comment=comment_input_div.value;
	if(comment.length == 0)	
		notie.alert({text: "Please Write some Comment...",type:3});
	else{
	$.ajax({
			url: "dataProvider.php",
			type: "POST",
			data:{
				doComment: true,
				comment : comment,
				photo_id: photo_id
			},
			success: function(data){
				if(data != "error")
				{
					window.comments=JSON.parse(data);
					var rootGallery = $(element).parentsUntil(".gallery");
					//var name =rootGallery.find(".card-img-top")[0].click();
					$("img[data-id="+photo_id+"]")[0].click();
					comment_input_div.value="";
				}
			},
			error: function(err){
				console.log(err);
			}
		});
	}
}
