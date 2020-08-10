$(function(){
	$(".content_layout .table").each(function(){
		$(this).wrap("<div class='table-responsive'></div>");
	});
	// $(".note-video-clip").parent("p").addClass("video_wrap");
	// $(".content_layout h1,.content_layout h2,.content_layout h3,.content_layout h4,.content_layout h5,.content_layout h6").each(function(){
	// 	//var text_direction = $(this).attr('style','text-align');
	// 	var text_direction = $(this).css('text-align');
	// 	if(text_direction == "center"){
	// 		$(this).wrap("<div class='ta_c'></div>");
	// 	}else if(text_direction == "right"){
	// 		$(this).wrap("<div class='ta_r'></div>");
	// 	}
	// });
});