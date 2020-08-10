@extends('layouts.admin_common.parent')
@section('inner_css')

<link href="{{asset('css/user/edit.css')}}" rel="stylesheet">
@endsection

@section('content')
<section class="content">
<form action="{{url('cms-admin/user/edit/'.$users_id->id)}}" method="post" enctype="multipart/form-data" id="post_form" class="pb-5">
      {{ csrf_field() }}
      <div class="card card-default">
        <div class="card-header">
          <h3 class="card-title">
            <i class="fas fa-user"></i>
            {{$title}}
          </h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          
          <div class="callout callout-info">
           

            <div class="input-group mb-2">
              <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1">ユーザー名</span>
              </div>
              <input type="text" class="form-control" placeholder="name" aria-label="Username" aria-describedby="basic-addon1" value="{{$users_id->name}}" name="name" disabled>
              
              
            </div>
            <p class="mb-3 user_name_txt">ユーザー名は変更できません。</p>
            
            <div class="input-group mb-4">
              <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1">メールアドレス</span>
              </div>
              <input type="email" class="form-control @if($errors->has('email')) is-invalid @endif" placeholder="email" aria-label="Username" aria-describedby="basic-addon1" value="{{$users_id->email}}" name="email">
              
              <div class="invalid-feedback">
                @foreach ($errors->get('email') as $error)
                {{ $error }}<br>
                @endforeach
              </div>
            </div>

            <div class="input-group mb-4">
              <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1">新しいパスワード</span>
              </div>
              
              <input type="text" class="form-control d-none password_input @if($errors->has('password')) is-invalid @endif" placeholder="password" aria-label="Username" aria-describedby="basic-addon1" value="" name="password">
              
              <ul class="password_list_js d-none">
                <li><div class="btn btn-primary hidden_btn btn_sp_size">非表示</div></li>
                <li><div class="btn btn-primary cancel_btn btn_sp_size">キャンセル</div></li>
              </ul>
              
              <div class="btn btn-primary btn_sp_size" id="js_btn_password">生成する</div>
              <div class="@if($errors->has('password')) is-invalid @endif"></div>
              <div class="invalid-feedback">
                @foreach ($errors->get('password') as $error)
                {{ $error }}<br>
                @endforeach
              </div>
            </div>
           
            
            @if (Auth::user()->user_status != "投稿者" and Auth::user()->id != $users_id->id)
            <div class="form-group mb-4">
              <label>権限グループ</label>
              <select class="form-control" name="user_status">
                @if ($users_id->user_status == "投稿者" )
                <option value="投稿者" selected>投稿者</option>
                <option value="管理者">管理者</option>
                @else
                <option value="投稿者">投稿者</option>
                <option value="管理者" selected>管理者</option>
                @endif
              </select>
              
              <div class="@if($errors->has('user_status')) is-invalid @endif"></div>
                          <div class="invalid-feedback">
                            @foreach ($errors->get('user_status') as $error)
                            {{ $error }}<br>
                            @endforeach
                          </div>
            </div>
            @endif
            

            <div class="clearfix avatar_wrap">
              <div class="avatar_input">
                <div class="form-group">
                  <label for="exampleInputFile">サムネイルアップロード<span class="small_txt">※正方形でトリミングされます</span></label>
                  
                  <div class="input-group">
                    <div class="custom-file">
                      <input type="hidden" class="form-control d-none @if($errors->has('user_img')) is-invalid @endif" value="{{$users_id->user_img}}" name="user_img_hidden">
                      <input type="file" class="custom-file-input @if($errors->has('user_img')) is-invalid @endif" id="myImage" accept="image/png,image/jpeg,image/gif" name="user_img">
                      <label class="custom-file-label" for="exampleInputFile">アップロードする。</label>
                    </div>
                  </div>
                  <div class="@if($errors->has('user_img')) is-invalid @endif"></div>
                    <div class="invalid-feedback">
                      @foreach ($errors->get('user_img') as $error)
                      {{ $error }}<br>
                      @endforeach
                    </div>

                    <p class="remove_catching d-none mt-2 @if($users_id->user_img) d-inline-block @endif">サムネイル画像を削除する</p>
                </div>
              </div>
              <div class="avatar_img">
                <div class="preview_frame">
                  @if($users_id->user_img)
                  <p class="mb-0"><img id="preview" src="{{asset('upload/users/'.$users_id->user_img)}}" alt="" data-dummy="{{asset('images/admin/user.jpg')}}"></p>
                  @else
                  <p class="mb-0"><img id="preview" src="{{asset('images/admin/user.jpg')}}" alt="" data-dummy="{{asset('images/admin/user.jpg')}}"></p>
                  @endif
                </div>
              </div>
            </div>

          </div>
          
          
        </div>
        <!-- /.card-body -->
      </div>
      <div class="text-right"><button class="btn btn-primary btn_sp_size" id="create">保存</button></div>
    </form>

</section>


@endsection
@section('inner_js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/object-fit-images/3.2.4/ofi.min.js"></script>
<script src="{{asset('js/user/password.js')}}"></script>
<script src="{{asset('js/user/avatar_img.js')}}"></script>
<script>
  objectFitImages();
</script>
@endsection