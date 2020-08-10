@extends('layouts.admin_common.parent')
@section('inner_css')
<link href="{{asset('css/summernote-bs4.css')}}" rel="stylesheet">
<link href="{{asset('css/post/edit.css')}}" rel="stylesheet">
<link href="{{asset('css/contact.css')}}" rel="stylesheet">
<link href="{{asset('css/content_layout.css')}}" rel="stylesheet">
@endsection

@section('content')
<section class="content">
        <div class="row">
          <div class="col-md-8">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="basic-addon1">タイトル</span>
                </div>
              <input type="text" class="form-control @if($errors->has('fixed_title')) is-invalid @endif" placeholder="Title" aria-label="Username" aria-describedby="basic-addon1" name="fixed_title" value="{{old('fixed_title')}}" required  form="post_form">
                <div class="invalid-feedback">
                  @foreach ($errors->get('fixed_title') as $error)
                  {{ $error }}<br>
                  @endforeach
                </div>
              </div>
        <textarea class="form-control" id="detail" rows="5" name="fixed_content"  form="post_form">
          {{old('fixed_content')}}
             </textarea>
             <div class="card card-default collapse_block">
                <div class="card-header">
                  <h3 class="card-title">
                    <i class="fas fa-quote-right"></i>
                    抜粋<small>この記事の簡潔な説明</small>
                    <i class="fa fa-angle-down js_as"></i>
                  </h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body" id="upload_post">
                  <div class="callout callout-info">
                    <div class="form-group">
                        <label>抜粋文</label>
                        <textarea class="form-control @if($errors->has('fixed_excerpt')) is-invalid @endif" rows="3" placeholder="抜粋文をご入力下さい" name="fixed_excerpt"  form="post_form">{{old('fixed_excerpt')}}</textarea>
                        <div class="invalid-feedback">
                          @foreach ($errors->get('fixed_excerpt') as $error)
                          {{ $error }}<br>
                          @endforeach
                        </div>
                      </div>
                  </div>
                </div>
                <!-- /.card-body -->
              </div>
          </div>
          <div class="col-md-4">
            <form action="{{url()->current()}}" method="POST" enctype="multipart/form-data" id="post_form" class="pb-5">
              {{ csrf_field() }}
            <div class="card card-default collapse_block">
                <div class="card-header">
                  <h3 class="card-title">
                    <i class="fas fa-pencil-alt"></i>
                    投稿詳細
                    <i class="fa fa-angle-down js_as"></i>
                  </h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body" id="upload_post">
                  <div class="callout callout-info">
                    
                    
                    <div class="form-group">
                      <label>スラッグ</label>
                      <div id="slug_wrap">
                        <input type="text" class="form-control js_slug_input  @if($errors->has('fixed_url')) is-invalid @endif" placeholder="slug" name="fixed_url" value="{{old('fixed_url')}}" required>
                        <div class="invalid-feedback">
                          @foreach ($errors->get('fixed_url') as $error)
                          {{ $error }}<br>
                          @endforeach
                        </div>
                        <p class="font-weight-bold mb-0 mt-3">保存時表示URL</p>
                        {{-- <p class="permalink"><a href="{{url('/')}}" rel="external noreferrer noopener" target="_blank" class="js_slug_link">{{url('/').'/'}}</a></p> --}}
                        <p class="permalink js_slug_link" data-link="{{url('/').'/'}}">{{url('/').'/'.old('fixed_url')}}</p>
                      </div>
                      </div>
                      
                      <div class="form-group">
                        <label>投稿者</label>
                        <select class="form-control" name="fixed_user">
                         @foreach ($users->get() as $user)
                         @if (Auth::user()->id == $user->id)
                         <option value="{{$user->id}}" {{old('fixed_user',$user->id) == $user->id ? 'selected' : ''}}>{{$user->name}}</option>
                         @else
                         <option value="{{$user->id}}" @if(old('fixed_user')== $user->id) selected  @endif>{{$user->name}}</option>
                         @endif
                         @endforeach
                        </select>

                        <div class="@if($errors->has('fixed_user')) is-invalid @endif"></div>
                          <div class="invalid-feedback">
                            @foreach ($errors->get('fixed_user') as $error)
                            {{ $error }}<br>
                            @endforeach
                          </div>
                      </div>

                      <div class="form-group">
                        <label>投稿ステータス</label>
                        <select class="form-control" name="fixed_status">
                          @if (old('fixed_name') == "公開")
                          <option value="非公開">非公開</option>
                          <option selected value="公開">公開</option>
                          @else
                          <option selected value="非公開">非公開</option>
                          <option value="公開">公開</option>
                          @endif
                        </select>
                      </div>
                  </div>
                </div>
                <!-- /.card-body -->
              </div>

            <div class="card card-default collapse_block">
                <div class="card-header">
                  <h3 class="card-title">
                    <i class="fas fa-file-image"></i>
                    アイキャッチ画像
                    <i class="fa fa-angle-down js_as"></i>
                  </h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body" id="upload_post">
                  
                  <div class="callout callout-info">
                    <div class="form-group">
                        <label for="exampleInputFile">画像アップロード</label>
                        <div class="input-group">
                          <div class="custom-file">
                            <input type="hidden" class="form-control d-none" value="" name="fixed_guid_hidden">
                            <input type="file" class="custom-file-input @if($errors->has('fixed_guid')) is-invalid @endif" id="myImage" accept="image/png,image/jpeg,image/gif" name="fixed_guid">
                            <label class="custom-file-label" for="exampleInputFile">アップロードする。</label>
                          </div>
                          
                          {{-- <div class="input-group-append">
                            <span class="input-group-text" id="">Upload</span>
                          </div> --}}
                        </div>
                        
                        <div class="@if($errors->has('fixed_guid')) is-invalid @endif"></div>
                          <div class="invalid-feedback">
                            @foreach ($errors->get('fixed_guid') as $error)
                            {{ $error }}<br>
                            @endforeach
                          </div>
                      </div>
                      <div class="preview_frame">
                        <p class="text-center mb-0"><img id="preview" src="{{asset('images/admin/dummy.jpg')}}" alt="" data-dummy="{{asset('images/admin/dummy.jpg')}}"></p>
                      <p class="remove_catching d-none mt-3">アイキャッチ画像を削除する</p>
                      </div>
                  </div>
                </div>
                <!-- /.card-body -->
              </div>

              <div class="card card-default collapse_block">
                <div class="card-header">
                  <h3 class="card-title">
                   
                    <i class="fas fa-search-plus"></i>
                    SEO内容
                    <i class="fa fa-angle-down js_as"></i>
                  </h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body" id="upload_post">
                  
                  <div class="callout callout-info">
                    <div class="form-group">
                      <label>seo タイトル</label>
                      <input type="text" class="form-control" placeholder="title" name="seo_title" value="{{old('seo_title')}}">
                    </div>
                    <div class="form-group">
                      <label>meta 説明</label>
                      <textarea class="form-control" rows="3" placeholder="description" name="meta_description">{{old('meta_description')}}</textarea>
                    </div>

                    <div class="form-group">
                      <label>meta キーワード</label>
                      <textarea class="form-control" rows="3" placeholder="keyword" name="meta_keywords">{{old('meta_keywords')}}</textarea>
                    </div>
                   
                  </div>
                </div>
                
                <!-- /.card-body -->
              </div>
              <div class="text-right"><button class="btn btn-primary btn_sp_size" id="create" type="button">保存</button></div>
            </form>
          </div>
      </div>
      

</section>


@endsection
@section('inner_js')
<script src="{{asset('js/summernote-bs4.min.js')}}"></script>
<script src="{{asset('js/summernote-cleaner.js')}}"></script>
<script src="{{asset('js/summernote-ja-JP.min.js')}}"></script>
<script src="{{asset('js/note_edit.js')}}"></script>
<script src="{{asset('js/admin/fixed/index.js')}}"></script>
@endsection