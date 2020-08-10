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
               
                
                <input type="text" class="form-control @if($errors->has('post_title')) is-invalid @endif" placeholder="Title" aria-label="Username" aria-describedby="basic-addon1" value="{{$posts_id->post_title}}" name="post_title" form="post_form" required>
                <div class="invalid-feedback">
                  @foreach ($errors->get('post_title') as $error)
                  {{ $error }}<br>
                  @endforeach
                </div>
              </div>
        <textarea class="form-control" id="detail" rows="5" name="post_content" form="post_form">{{$posts_id->post_content}}</textarea>
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
                        <textarea class="form-control @if($errors->has('post_excerpt')) is-invalid @endif" rows="3" placeholder="抜粋文をご入力下さい" name="post_excerpt" form="post_form">{{$posts_id->post_excerpt}}</textarea>
                        <div class="invalid-feedback">
                          @foreach ($errors->get('post_excerpt') as $error)
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
            <form action="{{url('cms-admin/post/edit/'.$posts_id->id)}}" method="post" enctype="multipart/form-data" id="post_form" class="pb-5">
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
                      <label>カテゴリー</label>
                      <div class="custom-control custom-radio">
                        <input class="custom-control-input @if($errors->has('category')) is-invalid @endif" type="radio" id="category_checked" name="category" value="未分類" {{ old('category','未分類') == '未分類' ? 'checked' : '' }}>
                        <label for="category_checked" class="custom-control-label">未分類</label>
                      </div>
                      @foreach ($categories as $category)
                      <div class="custom-control custom-radio">
                        @if ($posts_id->category == $category->name_category)
                        <input class="custom-control-input @if($errors->has('category')) is-invalid @endif" type="radio" id="category{{$loop->index}}" name="category" value="{{$category->name_category}}" checked>
                        @else
                        <input class="custom-control-input @if($errors->has('category')) is-invalid @endif" type="radio" id="category{{$loop->index}}" name="category" value="{{$category->name_category}}" {{ old('category') == $category->name_category ? 'checked' : ''}}>
                        @endif
                      
                      <label for="category{{$loop->index}}" class="custom-control-label">{{$category->name_category}}</label>
                      </div>
                      @endforeach
                      <div class="is-invalid"></div>
                      <div class="invalid-feedback">
                        @foreach ($errors->get('category') as $error)
                        {{ $error }}<br>
                        @endforeach
                      </div>
                    <p class="font_samll_txt mt-2"><a href="{{url('cms-admin/post/category/')}}" class="text-primary">新規カテゴリーを追加</a></p>
                    </div>
                    
                    <div class="form-group">
                        <label>投稿タグ</label>
                        <div class="tags_wrap">
                          <div class="tags">
                            @php($array_names = explode(",",$posts_id->post_name))
                            @foreach ($array_names as $array_name)
                            @if ($loop->last)
                            @else
                            <div class="tag_list">{{$array_name}}<span class="remove"></span></div>
                            @endif
                         
                            @endforeach
                            
                          </div>
                          <input type="text" class="tag-input">
                          <input type="hidden" class="tag_hidden" name="post_name" value="{{$posts_id->post_name}}">
                        </div>

                        {{-- <input type="text" class="form-control" placeholder="tag" value="{{$posts_id->post_name}}" name="post_name"> --}}
                        
                        <p class="font_samll_txt mt-2">半角コンマまたはエンターキーで区切ります。</p>
                      </div>
                    {{-- <p class="font-weight-bold mb-2">作成者:{{$users_id->name}}</p> --}}
                    
                    <div class="form-group">
                      <label>投稿者</label>
                      <select class="form-control" name="post_user">
                       @foreach ($users->get() as $user)
                       @if ($posts_id->post_user == $user->id)
                       <option value="{{$user->id}}" {{old('post_user',$user->id) == $user->id ? 'selected' : ''}}>{{$user->name}}</option>
                       @else
                       <option value="{{$user->id}}" @if(old('post_user')== $user->id) selected  @endif>{{$user->name}}</option>
                       @endif
                       @endforeach
                      </select>
                      <div class="@if($errors->has('post_user')) is-invalid @endif"></div>
                          <div class="invalid-feedback">
                            @foreach ($errors->get('post_user') as $error)
                            {{ $error }}<br>
                            @endforeach
                          </div>
                    </div>

                      <p class="font-weight-bold mb-0">パーマリンク</p>
                      <p class="permalink"><a href="{{url('blog/?p='.$posts_id->id)}}" rel="external noreferrer noopener" target="_blank">{{url('blog/?p='.$posts_id->id)}}</a></p>
                      <div class="form-group">
                        <label>投稿ステータス</label>
                        
                        <select class="form-control" name="post_status">
                         
                          @if ($posts_id->post_status == "非公開" )
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
                            @if($posts_id->post_guid)
                          <input type="hidden" class="form-control d-none @if($errors->has('post_guid')) is-invalid @endif" value="{{$posts_id->post_guid}}" name="post_guid_hidden">
                          {{-- dbで画像が設定されている時に更新回避用input --}}
                          {{-- @else
                          <input type="text" class="form-control d-none" value="" name="post_guid_hidden"> --}}
                            @endif
                            <input type="file" class="custom-file-input" id="myImage" accept="image/png,image/jpeg,image/gif" name="post_guid">
                            <label class="custom-file-label" for="exampleInputFile">アップロードする。</label>
                          </div>
                          {{-- <div class="input-group-append">
                            <span class="input-group-text" id="">Upload</span>
                          </div> --}}
                        </div>
                        <div class="@if($errors->has('post_guid')) is-invalid @endif"></div>
                          <div class="invalid-feedback">
                            @foreach ($errors->get('post_guid') as $error)
                            {{ $error }}<br>
                            @endforeach
                          </div>
                      </div>
                      <div class="preview_frame">
                        @if($posts_id->post_guid)

                        <p class="text-center mb-0"><img src="{{asset('upload/'.$posts_id->post_guid)}}" alt="" id="preview" data-dummy="{{asset('images/admin/dummy.jpg')}}"></p>
                        
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
                      <input type="text" class="form-control" placeholder="title" value="{{$posts_id->seo_title}}" name="seo_title">
                    </div>
                    <div class="form-group">
                      <label>meta 説明</label>
                      <textarea class="form-control" rows="3" placeholder="description" name="meta_description">{{$posts_id->meta_description}}</textarea>
                    </div>

                    <div class="form-group">
                      <label>meta キーワード</label>
                      <textarea class="form-control" rows="3" placeholder="keyword" name="meta_keywords">{{$posts_id->meta_keywords}}</textarea>
                    </div>
                  </div>
                </div>
                
                <!-- /.card-body -->
              </div>
              <div class="text-right"><button class="btn btn-primary btn_sp_size" id="create">保存</button></div>
              {{-- <div class="text-right"><input type="submit" value="送信する" class="btn btn-primary btn_sp_size"></div> --}}
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

@endsection