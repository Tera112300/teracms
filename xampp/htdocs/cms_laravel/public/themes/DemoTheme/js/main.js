$(function () {
  
  main_img($("#main .main_slider img"));
  main_img($("#main_on_img img"));
  $('#main .main_slider').slick({
    speed: 1000,
    dots: true,
    appendArrows: $('#arrows'),
	 responsive: [
      {
        breakpoint: 640,
      },
	 ],
  });
	
	$('#main .main_slider').on('breakpoint', function (event, slick, breakpoint) {
		var main_width = $("#main .main_slider img").width();
		if(breakpoint == 640){
			
		   $("#main .main_slider img").height(main_width * 0.9);
		   }else{
			   $("#main .main_slider img").height(main_width * 0.4);
		   }
    //$("#main .main_slider img").height(main_width * 0.9);
  });
  
  $(window).on("load resize", function () {
    main_img($("#main .main_slider img"));
    main_img($("#main_on_img img"));
  });
  function main_img($target){
    var ww = $(window).width();
    if (ww <= 640) {
      var main_width = $target.width();
      $target.height(main_width * 0.9);
    } else {
		var main_width = $target.width();
    $target.height(main_width * 0.4);
    }
  }


});
