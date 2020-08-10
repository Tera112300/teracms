$(function(){

  function up_img(img_name) {
    $("<div>", {
      class: 'col-xl-2 col-md-3 col-sm-4 col-6 upload_wrap',
      html: '<p class="mb-0 upload_img"><img src="' + img_name + '" alt="" class="object_cover"><button type="button" class="close js_delete" aria-label="Close"><span aria-hidden="true">×</span></button></p>'
    }).appendTo("#main_upload");
    $(".object_cover").each(function(){
			var object_width = $(this).width();
			
			$(this).height(object_width);
		});
  }

  function up_input(value_img) {
    $("<input>", {
      type: 'hidden',
      // name: 'main[]',
      name: 'main[]',
      value: value_img
    }).appendTo("#file_hidden");
  }

  //ファイル名から拡張子を取得する関数
function getExt(filename)
{
	var pos = filename.lastIndexOf('.');
	if (pos === -1) return '';
	return filename.slice(pos + 1);
}

  //アップロードを許可する拡張子
var allow_exts = new Array('jpg', 'jpeg', 'png');

//アップロード予定のファイル名の拡張子が許可されているか確認する関数
function checkExt(filename)
{
	//比較のため小文字にする
	var ext = getExt(filename).toLowerCase();
	//許可する拡張子の一覧(allow_exts)から対象の拡張子があるか確認する
	if (allow_exts.indexOf(ext) === -1) return false;
	return true;
}


  $('#file').on('change',function(e){
		var reader = new FileReader();
    reader.readAsDataURL(e.target.files[0]);

    //拡張子が画像なら送る
    if(checkExt(e.target.files[0].name) == true){
      $("#largeFile").removeClass("is-invalid");
      reader.onload = function(e){
        objectFitImages();
        up_img(e.target.result);
      }
      data = new FormData();
			data.append("files", e.target.files[0]);
			$.ajax({
			  data: data,
			  type: "POST",
			  url: "/cms_laravel/cms-admin/bloginfo/mainimg/tmp_file", // httaccessでpublicなくしているjs側ではpublic必要
			  cache: false,
			  contentType: false,
			  processData: false,
			  headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
			}).done(function (url) {
        up_input(url);
        // console.log(url);
      });
    }else{
      $("#largeFile").addClass("is-invalid").next(".invalid-feedback").text("画像をアップロードして下さい。");
    }
    $(this).val('');
    });
    $("#main_upload .js_delete").each(function(){
      $(document).on("click", "#main_upload .js_delete", function(){
        $(".hidden_js").remove(); //最初にhtmlに入れていないとjsで操作できなくなるため入れているが eq順番合わせのため削除
        var $parents = $(this).parents(".upload_wrap");
        //index番号に合わせてeqで隠しinputも削除
        $("#file_hidden input").eq($parents.index()).remove();
        //$('input[type=file]').val('');
        $parents.remove();
      });
    });

    $("#main_upload .ajax_delete").each(function(){
      $(this).on("click",function(){
        var data_id = $(this).data("id");
      //   data = new FormData();
			// data.append("delete", data_id);
        $.ajax({
        //data: {'post_data_1':data_id},
			  type: "POST",
			  url: "/cms_laravel/cms-admin/bloginfo/mainimg/delete"+data_id,
			  cache: false,
			  contentType: false,
			  processData: false,
			  headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
        });
      });
    });
});