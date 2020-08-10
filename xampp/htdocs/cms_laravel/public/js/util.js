$(function(){
	
	//ダウンロード属性ie対応
	var ua = navigator.userAgent.toLowerCase();
	if (ua.indexOf('trident') > 0) { 
		$("a[download]").on("click",function(e){
			e.preventDefault();
			var a_href = $(this).attr("href");
			var a_download = $(this).attr("download");
			var xhr = new XMLHttpRequest();
			xhr.open('GET', a_href);
			xhr.responseType = 'blob';
			xhr.onloadend = function() {
			if(xhr.status !== 200) return;
			window.navigator.msSaveBlob(xhr.response, a_download);
		}
		xhr.send();
		});
	}
	
	$("a").each(function(){
		var urlLink = location.href;

		var lower_nolink = $(this).data("lowernolink");
		if(urlLink.substr( urlLink.length-1) ==="/" ){
			urlLink = urlLink+"index.html";
		}
		var tgLink = $(this).prop("href");
		if ( tgLink === urlLink ) {
			$(this).addClass("active");
		} else if (0 <= urlLink.search(tgLink)) {
			if(lower_nolink != true){
				$(this).addClass("active");
			}
			//$(this).addClass("active");
		}
	});
	
	$(window).on("load resize",function(){
		$(".object_cover").each(function(){
			var data_height = $(this).data("height");
			var object_width = $(this).width();
			//データheight属性がなければ通常処理
			
			if(data_height == undefined){
				$(this).height(object_width);
			}else{
				
				$(this).height(object_width * data_height);
			}
			
			
		});
	});
});