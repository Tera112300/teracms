$(function(){
	$(".tags_wrap").each(function(){
		var $tag_hidden = $(this).find(".tag_hidden");
		var $tags = $(this).find(".tags");
		$(this).on("click",function(){
			$(this).find(".tag-input").focus();
		});

		$(this).find(".tag-input").on("keyup",function(){
			var input_decision = $(this).val();
			
			 //最後のvalの文字が「,」かつ最初の1文字目ではない時実行
			//var str;
			
			for(var i = 1; i < 100; i++){
				if(input_decision.charAt(i) == ","){
					$(this).val(input_decision.slice(i + 1));
				 }

				if(input_decision.charAt(i) == "," && input_decision.length != 1){
					//console.log(input_decision.slice(0,-1));
					var input_decision_val = $tag_hidden.val();

					$tag_hidden.val(input_decision_val+input_decision.slice(0,i+1));
					$tags.append("<div class='tag_list'>" + input_decision.slice(0,i) + "<span class='remove'></span></div>");


					str = (input_decision_val+input_decision).split(',');
					str = str.filter(function (x, i, self) {
						//console.log(self.indexOf(x));
						if(self.indexOf(x) !== i){
							console.log("重複");
							$tags.find(".tag_list:last-child").remove();

							var all_value = "";
							$tag_hidden.val("");
							$tags.find(".tag_list").each(function(){
								all_value += $(this).text() + ",";
							});
							$tag_hidden.val(all_value);
						}
						//x文字列
						return self.indexOf(x) === i;
					});
				 }
			 }
			
			 if(input_decision.slice(-1) == ","){
				$(this).val("");
			 }
			
		
		});
		$(this).find(".tag-input").on("paste",function(){
			return false;
		});
		
		
		
		$(this).find(".tag-input").on("keydown",function(e){
			var input_decision = $(this).val();
			//8 backspace keycode
			if(e.keyCode == 8 && input_decision == ""){
				$tags.find(".tag_list:last-child").remove();
				var all_value = "";
			$tag_hidden.val("");
				$tags.find(".tag_list").each(function(){
					all_value += $(this).text() + ",";
				});
				$tag_hidden.val(all_value);
			}
		});
		
		$(document).on("click",".tags_wrap .tags .remove",function(){
			//$(this).parent(".tag_list").remove();
			//console.log("test");
			var all_value = "";
			$tag_hidden.val("");
			$(this).parent().remove();
			$tags.find(".tag_list").each(function(){
				all_value += $(this).text() + ",";
			});
			$tag_hidden.val(all_value);
		});


	});
	
	$('#detail').summernote({
		height: 920,
		///fontNames: ["YuGothic", "Yu Gothic", "Hiragino Kaku Gothic Pro", "Meiryo", "sans-serif", "Arial", "Arial Black", "Comic Sans MS", "Courier New", "Helvetica Neue", "Helvetica", "Impact", "Lucida Grande", "Tahoma", "Times New Roman", "Verdana"],
		lang: "ja-JP",
		
		codemirror: {
			mode: 'text/html',
			htmlMode: true,
			lineNumbers: true,
			theme: 'monokai'
		  },
		  cleaner:{
			action: 'paste', // both|button|paste 'button' only cleans via toolbar button, 'paste' only clean when pasting content, both does both options.
			notStyle: 'position:absolute;top:0;left:0;right:0', // Position of Notification
			keepHtml: false, // Remove all Html formats
			keepOnlyTags: ['<p>', '<br>', '<ul>', '<li>', '<b>', '<strong>','<i>', '<a>','<form>','<table>','<tr>','<th>','<td>','<input>','<textarea>'], // If keepHtml is true, remove all tags except these
			keepClasses: false, // Remove Classes
			badTags: ['style', 'script', 'applet', 'embed', 'noframes', 'noscript', 'html'], // Remove full tags with contents
			badAttributes: ['style', 'start'], // Remove attributes from remaining tags
			limitChars: false, // 0/false|# 0/false disables option
			limitDisplay: 'both', // text|html|both
			limitStop: false // true/false
	  },
		callbacks: {
		  onImageUpload: function (files) {
			data = new FormData();
			console.log(files[0]);
			data.append("files", files[0]);
			$.ajax({
			  data: data,
			  type: "POST",
			  url: "/cms_laravel/cms-admin/post/upload_img", // httaccessでpublicなくしているjs側ではpublic必要
			  cache: false,
			  contentType: false,
			  processData: false,
			  headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
			}).done(function (url) {
				//console.log(url);
				$('#detail').summernote('insertImage', "/cms_laravel/public/upload/"+ url); /// httaccessでpublicなくしているjs側ではpublic必要
			  //alert_dom.prependTo('#wrap');
			  // ...
			});
		  },
		  onChange: function() {
			$(".note-video-clip").each(function(){
				$(this).parent("p").addClass("video_wrap");
			});
			// $(".table-bordered").each(function(){
			// 	//存在しなかった場合0
			// 	if($(this).parent("div.table-responsive").length == 0){
			// 		$(this).wrap("<div class='table-responsive'></div>");
			// 	}
			// });
		}
		}
	  });
	  $('#myImage').on('change',function(e){
		var reader = new FileReader();
		reader.onload = function(e){
			$('#preview').attr('src',e.target.result);
		}
		reader.readAsDataURL(e.target.files[0]);
		$(this).next('.custom-file-label').text(e.target.files[0].name);
		$(this).prev("input").attr("value",e.target.files[0].name);//create時のために追加
		$(".remove_catching").addClass("d-inline-block");
	  });

	  $(".collapse_block").each(function(){
		  var $card_header = $(this).children(".card-header");
		  var $card_body = $(this).children(".card-body");
		  $card_header.on("click",function(){
			$card_body.slideToggle();
			$card_header.find(".js_as").toggleClass("on");
		  });
	  });

	  $(".remove_catching").on("click",function(){
		  var data_dummy =  $("#preview").data("dummy");
		  $("#preview").attr("src",data_dummy);
		  $("#myImage").prev("input").attr("value",""); //dbで画像が設定されている時に更新回避用input
		  $("#myImage").next("label").text("アップロードする。");
		  $(this).removeClass("d-inline-block");
	  });

	 
	  



	  var js_slug_link = $("#slug_wrap .js_slug_link").data('link');
	  $("#slug_wrap .js_slug_input").on("keyup paste cut",function(e){
		var input_val = $(this).val();
		$("#slug_wrap .js_slug_link").text(js_slug_link + input_val);
	  
		$(this).val(input_val.replace(/\//g, ''));
		$("#slug_wrap .js_slug_link").text(js_slug_link + input_val.replace(/\//g, ''));
	  });


	  var ua = navigator.userAgent.toLowerCase();
	  $("#create").on("click",function(){
		var input_val = $("#slug_wrap .js_slug_input").val();
		if(input_val.slice(-1) == "/"){
		  $("#slug_wrap .js_slug_input").val(input_val.slice(0,-1));
		  $("#slug_wrap .js_slug_link").text(js_slug_link + input_val.slice(0,-1));
		}
		
		if (ua.indexOf('trident') > 0) { 
			$('#post_form').append($('input[name="post_title"]').attr('form','post_form'));
			$('#post_form').append($('input[name="post_excerpt"]').attr('form','post_form'));
			$('#post_form').append($('textarea[name="post_content"]').attr('form','post_form'));
		}
		
		
		$('#post_form').submit();
	  });


	  $("#form").submit(function(){
		  alert("管理画面からは送信できません");
		return false;
	  });


	  //input_tag_js
	  
	//  $("#tag-input").on("keyup",function(e){
	// 	 //console.log(e);
	// 	 var input_decision = $(this).val();
		
	// 	 if(input_decision.slice(-1) == ","){
	// 		$(this).val("");
	// 	 }
	// 	 //最後のvalの文字が「,」かつ最初の1文字目ではない時実行
	// 	 if(input_decision.slice(-1) == "," && input_decision.length != 1){
	// 		//console.log(input_decision.slice(0,-1));
	// 		var input_decision_val = $("#tag_hidden").val();
	// 		$("#tag_hidden").val(input_decision_val+input_decision);
	// 		$("#tags").append("<div class='tag_list'>" + input_decision.slice(0,-1) + "　<span class='remove'>☓</span></div>");
	// 	 }
	//  });
	
	

	 
	 //input_tag_js
});