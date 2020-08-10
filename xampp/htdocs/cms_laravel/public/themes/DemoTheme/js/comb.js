/*	parallax



************************/



(function($) {
	$(window).on("load",function(){

		var comb = ".comb";

		var view_num = 1.1;



		var wy = $(window).scrollTop();

		_view_comb_open(wy);



		$(window).on('resize', function (e) {

			var wy = $(window).scrollTop();

			_view_comb_open(wy);

		});



		$(window).on("scroll", function(){

			var y = $(this).scrollTop();

			 _view_comb_open(y);

		});



		function _view_comb_open(y) {



			var wh = $(window).height();			

			$("body").find(comb).each(function(){

				var comb_t = $(this).offset().top - ( y + parseInt( wh / view_num ) );

				if ( comb_t <= 0 ) {

					if ( !($(this).hasClass("on")) ) {

						$(this).addClass("on");

					}

				}

			});

			

			
		}


});
	

})(jQuery);









