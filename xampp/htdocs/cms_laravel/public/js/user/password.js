$(function(){
	var $password_list_js = $(".password_list_js");
	var $password_input = $(".password_input");
	$("#js_btn_password").on("click",function(){
		$(this).addClass("d-none");
		$password_list_js.addClass("d-inline-block");
		$password_input.addClass("d-inline-block").val(getRndStr());
	});
	$password_list_js.find(".hidden_btn").on("click",function(){
		if($password_input.attr("type") == "text"){
			$password_input.attr("type","password");
			$(this).text("表示");
		}else{
			$password_input.attr("type","text");
			$(this).text("非表示");
		}
	});
	$password_list_js.find(".cancel_btn").on("click",function(){
		$password_list_js.removeClass("d-inline-block");
		$password_input.removeClass("d-inline-block").val("");
		$("#js_btn_password").removeClass("d-none");
	});

	//パスワード自動生成
	function getRndStr(){
		//使用文字の定義
		var str = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!#$%&=~/*-+";
	  
		//桁数の定義
		var len = 15;
	  
		//ランダムな文字列の生成
		var result = "";
		for(var i=0;i<len;i++){
		  result += str.charAt(Math.floor(Math.random() * str.length));
		}
		return result;
	  }

});