$(function(){
  $("#google_edit .tab_wrap .tab_nav > li:not(:active)").on("click",function(){
    var index_li = $(this).index();
    var $tab_content = $(this).parents(".tab_wrap").children(".tab_content");
    $(this).addClass("active").siblings("li").removeClass("active");
    $tab_content.children("li").eq(index_li).addClass("active").siblings("li").removeClass("active");
  });
  $("#google_edit #google_action").on("keyup",function(){
    var $google_action_val = $(this).val().trim();
    $("#google_edit .form_top .action_url").text($google_action_val);
  });
});