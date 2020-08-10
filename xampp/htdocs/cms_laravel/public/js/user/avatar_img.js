$(function(){
	  $('#myImage').on('change',function(e){
		var reader = new FileReader();
		reader.onload = function(e){
			$('#preview').attr('src',e.target.result);
			objectFitImages();
		}
		reader.readAsDataURL(e.target.files[0]);
		$(this).next('.custom-file-label').text(e.target.files[0].name);
		$(this).prev("input[name='user_img_hidden']").attr("value",e.target.files[0].name);//create時のために追加
		$(".remove_catching").addClass("d-inline-block");
	  });

	  $(".remove_catching").on("click",function(){
		  var data_dummy =  $("#preview").data("dummy");
		  $("#preview").attr("src",data_dummy);
		  $("#myImage").prev("input[name='user_img_hidden']").attr("value",""); //dbで画像が設定されている時に更新回避用input
		  $("#myImage").next("label").text("アップロードする。");
		  $(this).removeClass("d-inline-block");
	  });
});