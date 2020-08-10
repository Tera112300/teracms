@extends('layouts.admin_common.parent')
@section('inner_css')
<link rel="stylesheet" href="{{asset('css/admin/google_edit.css')}}">
@endsection

@section('content')
<section class="content">
  <form action="{{url()->current()}}" method="POST" id="htmlform">
  <div class="ttl_wrap">
    <h3 class="mb-3 form_ttl">{{$title}}</h3>
    <div class="document_box">
      <div class="left">
        <i class="fas fa-file-pdf"></i>
      </div>
      <div class="right">
        <p class="mb-1">htmlタグを作成後コピーして、投稿、固定ページに内容にペーストしてください。保存することで後から編集することも可能。使い方はダウンロードリンク参照。</p>
      <p class="download_link"><a href="{{asset('images/pdf/form.pdf')}}" download="form.pdf">PDFダウンロード</a></p>
      </div>
    </div>
    <div class="input-group mb-2">
      <div class="input-group-prepend">
        <span class="input-group-text" id="basic-addon1">タイトル</span>
      </div>
    <input type="text" class="form-control @if($errors->has('form_title')) is-invalid @endif" placeholder="Title" aria-label="Username" aria-describedby="basic-addon1" name="form_title" value="{{old('form_title')}}">
    <div class="invalid-feedback">
      @foreach ($errors->get('form_title') as $error)
      {{ $error }}<br>
      @endforeach
    </div>

    </div>
    
  </div>
 

  <div id="google_edit">
   
      {{ csrf_field() }}
    <div class="tab_wrap">
      <ul class="tab_nav">
        <li class="active">フォーム</li>
        <li class="">メール送信先設定</li>
      </ul>
      <ol class="tab_content">
        <li class="active">
          <p class="ttl">フォーム</p>
          <p class="read">フォームのテンプレートをここで編集できます。</p>
          <ul class="google_btn_list">
            <li data-toggle="modal" data-target="#modal-default" data-tag="text">テキスト</li>
            <li data-toggle="modal" data-target="#modal-default" data-tag="email">Email</li>
            <li data-toggle="modal" data-target="#modal-default" data-tag="textarea">テキストエリア</li>
            <li class="btn-clipboard" data-clipboard-target="#clipboard-target">コピー</li>
            {{-- <li data-toggle="modal" data-target="#modal-default" data-tag="textarea">テキストエリア</li> --}}
          </ul>
          <div contenteditable="true" class="wrap_contenteditable" id="clipboard-target">
            <span contenteditable="false"></span>
            <span contenteditable="false" class="form_tag_clipboard form_top" data-clipboard-target="#clipboard-target">&lt;form action="<span class="action_url"></span>" id="form"&gt;<span>&lt;table class="form_table" method="POST" &gt;</span></span>
            <div class="contenteditable_js" contenteditable="true">{!! old('html_tag') !!}</div>
            <span contenteditable="false" class="form_tag_clipboard form_bottom" data-clipboard-target="#clipboard-target"><span>&lt;/table&gt;<br>&lt;p class="submit"&gt;&lt;span&gt;&lt;input type="submit" value="送信する"&gt;&lt;/span&gt;&lt;/p&gt;</span>&lt;/form&gt;</span>
            <span contenteditable="false"></span>
          </div>
          <textarea class="hidden_textarea" name="html_tag"></textarea>
        </li>
        <li class="">
          <p class="ttl">メール送信先設定</p>
          <p class="read">メールの送信先をここで編集できます。</p>
          <table class="mail_table">
            <tr>
              <th><label for="google_action">送信先(GoogleFormのaction属性)</label></th>
              <td>
                <input type="url" class="form-control @if($errors->has('action')) is-invalid @endif" id="google_action" placeholder="送信先" name="action" value="{{old('action')}}">
                
              </td>
            </tr>
          </table>
          <div class="js_invalid_action @if($errors->has('action')) is-invalid @endif"></div>
          <div class="invalid-feedback">
            @foreach ($errors->get('action') as $error)
            {{ $error }}<br>
            @endforeach
          </div>
        </li>
      </ol>
    </div>
    <div class="text-left"><button class="btn btn-primary btn_sp_size" id="create">保存</button></div>
  
    </div>
  </form>
</section>


<div class="modal fade post_delete" id="modal-default">
 
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title"></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table class="modal_table">
          <tr>
            <th>項目タイプ</th>
            <td><div class="form-group">
              <div class="custom-control custom-checkbox">
                <input class="custom-control-input" type="checkbox" id="customCheckbox1" value="option1" name="required">
                <label for="customCheckbox1" class="custom-control-label">必須項目</label>
              </div>
            </div></td>
          </tr>
          <tr>
            <th>タイトル</th>
            <td><div class="form-group">
              <input type="text" class="form-control" id="title_input" placeholder="タイトルをご入力下さい。">
              <div class="invalid-feedback">
                タイトルは必須です<br>
              </div>
            </div></td>
          </tr>
          <tr>
            <th>デフォルト値</th>
            <td><div class="form-group">
              <input type="text" class="form-control" id="default_input" placeholder="デフォルト値をご入力下さい。">
            </div></td>
          </tr>
          <tr>
            <th>name属性</th>
            <td><div class="form-group">
              <input type="text" class="form-control" id="name_input" placeholder="Google formのname属性をご入力下さい。">
              <div class="invalid-feedback">
                name属性は必須です<br>
              </div>
            </div></td>
          </tr>
        </table>
      </div>
      
      <div class="modal-footer justify-content-between insert_box">
        <input type="text" class="form-control" placeholder="表示するhtmlタグ" disabled="" id="disabled">
        <table class="d-none">
          <tr class="form_tr"><th></th><td></td></tr>
        </table>
       
        
          <button class="btn btn-primary tag_append_btn">タグを挿入する</button>
          {{-- <p class="btn btn-primary tag_append_btn">タグを挿入する</p> --}}
        
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>




<!-- /.modal -->
@endsection
@section('inner_js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.6/clipboard.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.min.js"></script>
<script src="{{asset('js/admin/google_edit.js')}}"></script>
<script src="{{asset('js/admin/tab_nav.js')}}"></script>
<script>
  var clipboard = new ClipboardJS('.btn-clipboard');
  var tag_clipboard = new ClipboardJS('.form_tag_clipboard');
/* コピーが成功した時の処理 */
clipboard.on('success', function(e) {
  $('.btn-clipboard').addClass("on").delay(900).queue(function () {
    $(this).removeClass("on").dequeue();
  });
});
tag_clipboard.on('success', function(e) {
  $('.wrap_contenteditable').addClass("on_clipboard").delay(900).queue(function () {
    $(this).removeClass("on_clipboard").dequeue();
  });
});
</script>
@endsection