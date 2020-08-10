$(function(){
	var form_url = $("#form").attr("action");
	// input
	$('#form').submit(function (event) {
		form_url = $("#form").attr("action");
		var formData = $('#form').serialize();
		var $modal_contact = $("#modal_contact");
		var js_txt;
		$("#form")[0].reset();
		$modal_contact.addClass("modal_on");
		$modal_contact.find(".btn,.close").on("click",function(){
		$modal_contact.removeClass("modal_on");
		});
        $.ajax({
          url: form_url,
          data: formData,
          type: "POST",
          dataType: "xml",
          statusCode: {
			
            0: function () {
			//js_txt= "お問い合わせありがとうございました。";
			  //window.location.href = "thanks.html";
			  //$modal_contact.find("#js_txt").text(js_txt);
            },
            200: function () {
				js_txt = "送信失敗しました。お手数ですが、お時間を改めてご入力下さい。";
				$modal_contact.find("#js_txt").text(js_txt);
            }
          }
		});
		
		
        event.preventDefault();
      });
});












