$(function(){
	var action =$("#modal-danger #js_form").attr("action");
	$(".js_form_delete").each(function(){
		$(this).on("click",function(){
			var data_id = $(this).data("id");
			//console.log(data_id);
			$("#modal-danger #js_form").attr("action",action + "/" + data_id);
		});
	});
});