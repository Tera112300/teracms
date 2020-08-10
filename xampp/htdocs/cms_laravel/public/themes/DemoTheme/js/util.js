(function($) {

	var nav_btn = ".btn_nav";
	var sp_nav = ".sp_nav";

	$(function() {

		var is_mobile =false;
		var is_smp =false;
		var is_retina =false;
		var is_ie =false;
		
		var ua = navigator.userAgent.toLowerCase();


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


		$(".js_toolbar_even").on("click",function(){
			$(this).next(".js_toolbar").slideToggle();
			$(".js_user_even +.js_user").slideUp();
		});
		
		$(".js_user_even").on("click",function(){
			$(this).next(".js_user").slideToggle();
			$(".js_toolbar_even + .js_toolbar").slideUp();
		});
		var gnavi_clone = $(".gnavi").clone();
		var headerOffsetTop = $(".gnavi_wrap").offset().top;
		$("#clone_header").append(gnavi_clone);
		$(window).on("scroll",function(){
			if ($(this).scrollTop() > headerOffsetTop) {
				$("#clone_header").addClass('on');
			  } else {
				$("#clone_header").removeClass('on');
			  }
		});

		// var gnavi_width = $(".gnavi").width();
		// var gnavi_eq = $(".gnavi > li").length;
		// $(".gnavi_wrap").css({"max-width":gnavi_width * gnavi_eq}).children(".gnavi").css({"display":"flex"});
		
		if ( ua.indexOf('iphone') > 0 || ua.indexOf('ipad') > 0 || ua.indexOf('ipod') > 0 || ua.indexOf('android') > 0) { 
			is_mobile =true;
			$("body").addClass("mobile");
		}
		if ( ua.indexOf('iphone') > 0 || ua.indexOf('android') > 0) { 
			is_smp =true;
			$("body").addClass("smp");
		}
		if ( window.devicePixelRatio >= 2) { 
			is_retina =true;
			$("body").addClass("retina");
		}
		if ( ua.indexOf('trident') > 0) { 
			is_ie =true;
			$("body").addClass("ie");
		}
		
		//IE スクロールをスムーズに
		
		 var wd = 0;
		 var csp = 0;
		
		 if(is_ie) {
			 $('body').on("mousewheel", function () {
				 event.preventDefault(false);
				 wd = wd+event.wheelDelta;
				 csp = window.pageYOffset;
				 console.log("wd:"+wd+" csp:"+csp);
				 $("html,body").stop().animate({scrollTop:csp - wd},{duration:150,complete:function(){
					 wd = 0;
					 csp = 0;
				 }
				 });
				
			 });
		 }			

		//selflink
		
		$("a").each(function(){
			var urlLink = location.href;
			var lower_nolink = $(this).data("lowernolink");
			if(urlLink.substr( urlLink.length-1) ==="/" ){
				//urlLink = urlLink+"index.html";
				urlLink = urlLink;
			}
			var tgLink = $(this).prop("href");
			
			if ( tgLink === urlLink ) {
				$(this).addClass("cr");
				
			} else if (0 <= urlLink.search(tgLink)) {
				
				if(lower_nolink != true){
					$(this).addClass("cr");

				}
				
			}
		});	

		//nav:

		$(document).on("click",nav_btn,function() {
			$(nav_btn).toggleClass("opened");
			$(sp_nav).stop().slideToggle('slow');
			$("body").toggleClass("nav_open");
			if($(nav_btn).hasClass("opened")){
				//console.log("クラス");
				$("header .gnavi a").on("click",function(){
					$(nav_btn).removeClass("opened");
			$(sp_nav).attr("style", "");
			$("body").removeClass("nav_open");
				});
			}
		});

		$(window).on("resize",function(){
			$(nav_btn).removeClass("opened");
			$(sp_nav).attr("style", "");
			$("body").removeClass("nav_open");
		});

		//ロールオーバー
				
		$(".fadeimg, .gnavi>li img").each(function() {
			$(this).wrap("<span class='fadeimg_wrap'></span>");
			var This = $(this);
			var Parent = $(this).parent("span.fadeimg_wrap");
			$(this).addClass("off");
			Parent.append(Parent.find("img.off").clone(true).removeClass("off").addClass("on"));
			var onsrc =  Parent.find("img.on").attr("src").replace(new RegExp('(_on)?(\.gif|\.jpg|\.png)$'), "_on$2");
			Parent.find("img.on").attr("src", onsrc);
		});

		//スクロール処理
				
		$(window).on("scroll load", function(){
			var scr = $(this).scrollTop();
			$("*[data-scrollbreak]").each(function(){
				var scr_break = $(this).data("scrollbreak");
				if(String(scr_break).indexOf("%") != -1){
					scr_break = parseInt(scr_break) / 100 * $(window).height();
				}
				if(scr > scr_break){
					$(this).addClass("scrolled");
				}else{
					$(this).removeClass("scrolled");
				}
			});
		});

		//ページ内リンクはするするスクロール
		
		$("a[href^='#']").click(function(){
			var Hash = $(this.hash);
			var HashOffset = $(Hash).offset().top;
			$("html,body").animate({scrollTop: HashOffset}, 500);
			return false;
		});
		
		//popup

		$(document).on("click","a.popup",function(){
				window.open(this.href,'null','scrollbars=yes,resizable=yes,width=750,height=800');
				return false;
		});
		$(document).on("click","a.popup_map",function(){
				window.open(this.href,'null','scrollbars=yes,resizable=yes,width=750,height=800');
				return false;
		});

		//rwdImageMaps
		$('img[usemap]').rwdImageMaps();

		//is_retina
		if (is_retina) { 
			$("img.2x").each(function() {
				$(this).attr("srcset",$(this).attr("src").replace(new RegExp('(@2x)?(\.gif|\.jpg|\.png)$'), "@2x$2") +" 2x");
			});
		}
					
					

		
	});

	 
	
})(jQuery);	