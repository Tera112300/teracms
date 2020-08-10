@extends('layouts.admin_common.parent')
@section('inner_css')

<link href="{{asset('css/user/edit.css')}}" rel="stylesheet">
<style>
  .avatar_wrap .avatar_img #preview{
    font-family: 'object-fit: cover;';
  }
</style>
@endsection

@section('content')
<section class="content">
<form action="{{url('cms-admin/user/create/')}}" method="post" enctype="multipart/form-data" id="post_form" class="pb-5">
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
           

            <div class="input-group mb-4">
              <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1">ユーザー名</span>
              </div>
              <input type="text" class="form-control @if($errors->has('name')) is-invalid @endif" placeholder="name" aria-label="Username" aria-describedby="basic-addon1" value="{{old('name')}}" name="name">
              <div class="invalid-feedback">
                @foreach ($errors->get('name') as $error)
                {{ $error }}<br>
                @endforeach
              </div>
              
            </div>
           

            <div class="input-group mb-4">
              <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1">メールアドレス</span>
              </div>
              <input type="email" class="form-control @if($errors->has('email')) is-invalid @endif" placeholder="email" aria-label="Username" aria-describedby="basic-addon1" value="{{old('email')}}" name="email">
              
              <div class="invalid-feedback">
                @foreach ($errors->get('email') as $error)
                {{ $error }}<br>
                @endforeach
              </div>
            </div>


            <div class="input-group mb-4">
              <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1">パスワード</span>
              </div>
              <input type="password" class="form-control @if($errors->has('password')) is-invalid @endif" placeholder="password" aria-label="Username" aria-describedby="basic-addon1" value="{{old('password')}}" name="password">
              
              <div class="invalid-feedback">
                @foreach ($errors->get('password') as $error)
                {{ $error }}<br>
                @endforeach
              </div>
            </div>

            

            <div class="input-group mb-4">
              <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1">確認用パスワード</span>
              </div>
              <input type="password" class="form-control" placeholder="password" aria-label="Username" aria-describedby="basic-addon1" value="{{old('password_confirmation')}}" name="password_confirmation">
            </div>

            <div class="form-group mb-4">
              <label>権限グループ</label>
              <select class="form-control" name="user_status">
                <option value="投稿者" selected @if(old('user_status')=='投稿者') selected  @endif>投稿者</option>
                <option value="管理者" @if(old('user_status')=='管理者') selected  @endif>管理者</option>
              </select>

              <div class="@if($errors->has('user_status')) is-invalid @endif"></div>
                          <div class="invalid-feedback">
                            @foreach ($errors->get('user_status') as $error)
                            {{ $error }}<br>
                            @endforeach
                          </div>
            </div>


            <div class="clearfix avatar_wrap">
              <div class="avatar_input">
                <div class="form-group">
                  <label for="exampleInputFile">サムネイルアップロード<span class="small_txt">※正方形でトリミングされます</span></label>
                  
                  <div class="input-group">
                    <div class="custom-file">
                      <input type="hidden" class="form-control d-none" value="" name="user_img_hidden">
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
                    <p class="remove_catching d-none mt-2">サムネイル画像を削除する</p>
                </div>
              </div>
              <div class="avatar_img">
                <div class="preview_frame">
                  <p class="mb-0"><img id="preview" src="{{asset('images/admin/user.jpg')}}" alt="" data-dummy="{{asset('images/admin/user.jpg')}}"></p>
                
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
<script src="{{asset('js/user/avatar_img.js')}}"></script>
@endsection