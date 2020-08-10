$(function() {
    $("#google_edit .google_btn_list li").each(function(){
      $(this).on("click",function(){
        create_tag($(this),"text");
        create_tag($(this),"email");
        create_tag_textarea($(this));
      });
    });

    function create_tag($target,type){
      var data_tag = $target.data("tag");
      if(data_tag == type){
        //console.log("ok");
        var $modal = $("#modal-default");

        $modal.find(".modal-title").text("フォームタグ生成:" + $target.text());
        var append_tag = '<input type="'+data_tag+'"placeholder="" name=""></input>';
        $modal.find(".form_tr td").append(append_tag);
        var $form_tr = $modal.find(".form_tr");

        $modal.find("#disabled").val($form_tr.prop('outerHTML').trim());
        
        
       // var disabled_val = $modal.find("#disabled").val();

        
        //チェックボックス判定
        $modal.find("#customCheckbox1").on("click",function(){
          var $disabled_clone_tag;
          if ( $(this).prop('checked') == false ) {
            //未選択時
            $form_tr.find("input").removeAttr("required");
            $disabled_clone_tag = $form_tr.prop('outerHTML');
            $modal.find("#disabled").val($disabled_clone_tag);
          } else {
            $form_tr.find("input").attr("required","");
            $disabled_clone_tag = $form_tr.prop('outerHTML');
            $modal.find("#disabled").val($disabled_clone_tag);
          }
        });

        //タイトル判定
        $modal.find("#title_input").on("keyup",function(){
          var input_val = $(this).val();
          if(input_val != ""){
            $(this).removeClass("is-invalid");
          }
          $form_tr.children("th").text(input_val);
          $modal.find("#disabled").val($form_tr.prop('outerHTML').trim());
        });


        //デフォルト値判定
        $modal.find("#default_input").on("keyup",function(){
          var input_val = $(this).val();
          $form_tr.find("input").attr("placeholder",input_val);
          $modal.find("#disabled").val($form_tr.prop('outerHTML').trim());
        });

        //name属性設定
         
         $modal.find("#name_input").on("keyup",function(){
          var input_val = $(this).val();
          if(input_val != ""){
            $(this).removeClass("is-invalid");
          }
          $form_tr.find("input").attr("name",input_val);
          $modal.find("#disabled").val($form_tr.prop('outerHTML').trim());
        });
      }
    }

    function create_tag_textarea($target){
      var data_tag = $target.data("tag");
       if(data_tag == "textarea"){
        var $modal = $("#modal-default");

        $modal.find(".modal-title").text("フォームタグ生成:" + $target.text());
        var append_tag = '<textarea rows="4" name=""></textarea>';
        $modal.find(".form_tr td").append(append_tag);
        var $form_tr = $modal.find(".form_tr");

        $modal.find("#disabled").val($form_tr.prop('outerHTML').trim());

        
        //チェックボックス判定
        $modal.find("#customCheckbox1").on("click",function(){
          var $disabled_clone_tag;
          if ( $(this).prop('checked') == false ) {
            //未選択時
            $form_tr.find("textarea").removeAttr("required");
            $disabled_clone_tag = $form_tr.prop('outerHTML');
            $modal.find("#disabled").val($disabled_clone_tag);
          } else {
            $form_tr.find("textarea").attr("required","");
            $disabled_clone_tag = $form_tr.prop('outerHTML');
            $modal.find("#disabled").val($disabled_clone_tag);
          }
        });

        //タイトル判定
        $modal.find("#title_input").on("keyup",function(){
          var input_val = $(this).val();
          if(input_val != ""){
            $(this).removeClass("is-invalid");
          }
          $form_tr.children("th").text(input_val);
          $modal.find("#disabled").val($form_tr.prop('outerHTML').trim());
        });


        //デフォルト値判定
        $modal.find("#default_input").on("keyup",function(){
          var input_val = $(this).val();
          $form_tr.find("textarea").attr("placeholder",input_val);
          $modal.find("#disabled").val($form_tr.prop('outerHTML').trim());
        });

        //name属性設定
         $modal.find("#name_input").on("keyup",function(){
          var input_val = $(this).val();
          if(input_val != ""){
            $(this).removeClass("is-invalid");
          }
          $form_tr.find("textarea").attr("name",input_val);
          $modal.find("#disabled").val($form_tr.prop('outerHTML').trim());
        });
      }
    }

    $(".tag_append_btn").on("click",function(){
      var disabled_val = $("#disabled").val();
      disabled_val = jQuery( '<span/>' ).text(disabled_val).html();
      if($("#title_input").val() == ""){
        $("#title_input").addClass("is-invalid");
      }
      if($("#name_input").val() == ""){
        $("#name_input").addClass("is-invalid");
      }

      if($("#title_input").val() != "" && $("#name_input").val() != ""){
        $("#modal-default").modal('hide');
        //$("#google_edit .contenteditable_js").append('<br>'+disabled_val);
        $("#google_edit .contenteditable_js").append('<br>'+disabled_val);
        
        var hiddeen_val = $("#google_edit .hidden_textarea").val();
        $("#google_edit .hidden_textarea").val(hiddeen_val + '<br>'+ disabled_val);
      }
    });



    $(document).on("keydown",function(e){
      if(e.ctrlKey != true){
        if (e.keyCode != 65 && e.target.className === "wrap_contenteditable") {
          e.preventDefault();
        }
      }
    });

    
    
    $("#google_edit .contenteditable_js").on("mousedown",function(){
      $("#google_edit .wrap_contenteditable").attr("contenteditable","false").addClass("on");
    });
    $("#google_edit .contenteditable_js").on("blur",function(){
     //console.log("test");
     $("#google_edit .hidden_textarea").val($(this).html());
     $("#google_edit .wrap_contenteditable").attr("contenteditable","true").removeClass("on");
    });
    // $("#google_edit .contenteditable_js").on("keydown",function(e){
    //  //ctrl + aのとき true
    //   if(e.ctrlKey){
    //     if(e.keyCode === 65){
    //       $("#google_edit .wrap_contenteditable").attr("contenteditable","true");
    //     }
    //   }
    // });

    

    $("#google_edit .wrap_contenteditable").on("focus",function(e){
      //e.target.blur();
      e.target.blur();
     });

    $(".form_tag_clipboard").hover(function(){
      $(this).parent("#clipboard-target").addClass("on_hover");
    },function(){
      $(this).parent("#clipboard-target").removeClass("on_hover");
    });

    


    //bootstrap 閉じるイベント
    $("#modal-default").on("hide.bs.modal",function(){
      var $modal = $("#modal-default");
      $modal.find("#disabled").val('');
      $modal.find(".form_tr th").empty();
      $modal.find(".form_tr td").empty();
      $modal.find(".modal_table input").val("");
      $modal.find("#customCheckbox1").prop('checked', false);
      $("#title_input").removeClass("is-invalid");
      $("#name_input").removeClass("is-invalid");
    });


    //js側バリデーション
    $("#htmlform").validate({
      errorElement:'span', // 指定しない場合のデフォルトは「label」
      ignore: "", //display noneしているときも許可
      //ルールの設定
      rules: {
        form_title: {
              required: true
          },
          action: {
            required: true,
            url:true
        }
      },

      //エラーメッセージの設定
      messages: {
        form_title: {
              required: 'タイトルは必須です'
          },
          action: {
            required: '送信先は必須です',
            url: '送信先を正確に入力してください'
        }
      },
      //エラーメッセージの表示場所を設定
        errorPlacement: function (err, elem) {
          // err.appendTo($('p'));
          // console.log(elem);
           // err.appendTo($('p')); //p要素を指定
           if($(elem).attr('name') === 'form_title'){
            $(elem).addClass("is-invalid").next(".invalid-feedback").append(err);
          }
           if($(elem).attr('name') === 'action'){
             $("#google_edit .tab_wrap .tab_nav > li:nth-child(2)").addClass("active").siblings("li").removeClass("active");
             $("#google_edit .tab_wrap .tab_content > li:nth-child(2)").addClass("active").siblings("li").removeClass("active");
            $(elem).addClass("is-invalid");
            $(".js_invalid_action").addClass("is-invalid").next(".invalid-feedback").append(err);
          }
        },
        success: function(err, elem) {
          if($(elem).attr('name') === 'form_title'){
            $(elem).removeClass("is-invalid").next(".invalid-feedback").empty();
          }
          if($(elem).attr('name') === 'action'){
            $(elem).removeClass("is-invalid").next(".invalid-feedback");
            $(".js_invalid_action").removeClass("is-invalid").next(".invalid-feedback").empty();
          }
        }
});


  });