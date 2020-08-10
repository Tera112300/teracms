$(function(){
	var select_clone = $(".user_select").html();
	var action =$("#modal-danger #js_form").attr("action");
	$(".js_form_delete").each(function(){
		$(this).on("click",function(){
			var data_id = $(this).data("id");
			//console.log(data_id);
			$("#modal-danger #js_form").attr("action",action + "/" + data_id);
			$(".user_select option").eq(data_id).hide();
			$(".user_select option").remove();
			$(".user_select").append(select_clone);
			$(".user_select option").each(function(index){
				if($(this).data("id") == data_id){
					$(this).remove();
				}
			});
			//console.log($(".user_select option").eq(0).remove());
			
		});
	});
	
    //bootstrap 閉じるイベント
    // $("#modal-danger").on("hide.bs.modal",function(){
	// 	$(".user_select option").remove();
	//   });
});