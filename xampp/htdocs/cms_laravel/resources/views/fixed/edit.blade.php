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
          <div class="col-xl-8">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="basic-addon1">タイトル</span>
                </div>
                <input type="text" class="form-control @if($errors->has('fixed_title')) is-invalid @endif" placeholder="Title" aria-label="Username" aria-describedby="basic-addon1" value="{{$fixeds_id->fixed_title}}" name="fixed_title" form="post_form" required>
                <div class="invalid-feedback">
                  @foreach ($errors->get('fixed_title') as $error)
                  {{ $error }}<br>
                  @endforeach
                </div>
              </div>
        <textarea class="form-control" id="detail" rows="5" name="fixed_content" form="post_form">{{$fixeds_id->fixed_content}}</textarea>
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
                        <textarea class="form-control @if($errors->has('fixed_excerpt')) is-invalid @endif" rows="3" placeholder="抜粋文をご入力下さい" name="fixed_excerpt" form="post_form">{{$fixeds_id->fixed_excerpt}}</textarea>
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
          <div class="col-xl-4">
            <form action="{{url('cms-admin/fixed/edit/'.$fixeds_id->id)}}" method="post" enctype="multipart/form-data" id="post_form">
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
                        <input type="text" class="form-control js_slug_input  @if($errors->has('fixed_url')) is-invalid @endif" placeholder="slug" name="fixed_url" value="{{$fixeds_id->fixed_url}}" required>
                        <div class="invalid-feedback">
                          @foreach ($errors->get('fixed_url') as $error)
                          {{ $error }}<br>
                          @endforeach
                        </div>
                        <p class="font-weight-bold mb-0 mt-3">表示URL</p>
                      <p class="permalink"><a href="{{url($fixeds_id->fixed_url).'/'}}" rel="external noreferrer noopener" target="_blank" class="js_slug_link" data-link="{{url('/').'/'}}">{{url($fixeds_id->fixed_url).'/'}}</a></p>
                       
                      </div>
                    </div>
                    
                    {{-- <p class="font-weight-bold mb-2">作成者:{{$users_id->name}}</p> --}}

                    
                    <div class="form-group">
                      <label>投稿者</label>
                      <select class="form-control" name="fixed_user">
                       @foreach ($users->get() as $user)
                       @if ($fixeds_id->fixed_user == $user->id)
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
                         
                          @if ($fixeds_id->fixed_status == "非公開" )
                          <option selected value="非公開">非公開</option>
                          <option value="公開">公開</option>
                          @else
                          <option value="非公開">非公開</option>
                          <option selected value="公開">公開</option>
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
                            @if($fixeds_id->fixed_guid)
                          <input type="hidden" class="form-control d-none @if($errors->has('fixed_guid')) is-invalid @endif" value="{{$fixeds_id->fixed_guid}}" name="fixed_guid_hidden">
                          {{-- dbで画像が設定されている時に更新回避用input --}}
                          {{-- @else
                          <input type="text" class="form-control d-none" value="" name="fixed_guid_hidden"> --}}
                            @endif
                            <input type="file" class="custom-file-input" id="myImage" accept="image/png,image/jpeg,image/gif" name="fixed_guid">
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
                        @if($fixeds_id->fixed_guid)

                        <p class="text-center mb-0"><img src="{{asset('upload/'.$fixeds_id->fixed_guid)}}" alt="" id="preview" data-dummy="{{asset('images/admin/dummy.jpg')}}"></p>
                        
                        <p class="remove_catching mt-3 d-none d-inline-block">アイキャッチ画像を削除する</p>
                        @else
                        <p class="text-center mb-0"><img id="preview" src="{{asset('images/admin/dummy.jpg')}}" alt="" data-dummy="{{asset('images/admin/dummy.jpg')}}"></p>
                        <p class="remove_catching d-none mt-3">アイキャッチ画像を削除する</p>
                        
                        
                        @endif
                        
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
                      <input type="text" class="form-control" placeholder="title" value="{{$fixeds_id->seo_title}}" name="seo_title">
                    </div>
                    <div class="form-group">
                      <label>meta 説明</label>
                      <textarea class="form-control" rows="3" placeholder="description" name="meta_description">{{$fixeds_id->meta_description}}</textarea>
                    </div>

                    <div class="form-group">
                      <label>meta キーワード</label>
                      <textarea class="form-control" rows="3" placeholder="keyword" name="meta_keywords">{{$fixeds_id->meta_keywords}}</textarea>
                    </div>
                  </div>
                </div>
                
                <!-- /.card-body -->
              </div>
              <div class="text-right"><button class="btn btn-primary btn_sp_size" id="create" type="button">保存</button></div>
            </form>
          </div>
      </div>
      {{-- <div class="text-right"><button class="btn btn-primary btn_sp_size" id="create" type="button">保存</button></div> --}}
      
    

</section>


@endsection
@section('inner_js')

<script src="{{asset('js/summernote-bs4.min.js')}}"></script>
<script src="{{asset('js/summernote-cleaner.js')}}"></script>
<script src="{{asset('js/summernote-ja-JP.min.js')}}"></script>
<script src="{{asset('js/note_edit.js')}}"></script>
<script src="{{asset('js/admin/fixed/index.js')}}"></script>

@endsection