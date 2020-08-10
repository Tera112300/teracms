@extends('layouts.admin_common.parent')
@section('inner_css')
<link href="{{asset('css/admin/theme/index.css')}}" rel="stylesheet">
@endsection

@section('content')
<section class="content">
<h3 class="mb-0">{{$title}}</h3>
<div class="row" id="themes">
  @foreach ($themes_files as $themes_file)
  @if (!preg_match('/^(\.|\.\.)$/', $themes_file) && !preg_match('/(.*)(?:\.([^.]+$))/',$themes_file))
  <div class="col-xl-3 col-md-4 col-sm-6 mt-4">
    <div class="theme_item  @if(!empty($theme_first->cms_name) && $theme_first->cms_name == $themes_file)active @endif">
      <p class="mb-0">
        @if (file_exists(public_path().'/themes/'.$themes_file.'/screenshot.png'))
        <img src="{{asset('themes').'/'.$themes_file.'/screenshot.png'}}" alt="" class="object_cover" data-height="0.75" width="1200" height="900">
        @else
        <img src="{{asset('images/admin/noimage_1200x900.png')}}" alt="" class="object_cover" data-height="0.75" width="1200" height="900">
        @endif
      </p>
      <div class="theme_btn">
      <div class="in_l"><p class="title mb-0">{{$themes_file}}</p></div>
      @if(!empty($theme_first->cms_name) && $theme_first->cms_name == $themes_file)
      <div class="in_r"><a href="{{url('cms-admin/bloginfo/mainimg')}}" class="btn btn-block btn-default">カスタマイズ</a></div>
      @else
      <div class="in_r"><a href="{{url('cms-admin/theme').'/?stylesheet='.$themes_file}}" class="btn btn-block btn-default">有効化</a></div>
      @endif
      </div>
    </div>
  </div>
        @endif
@endforeach
</div>


</section>



<!-- /.modal -->
@endsection
@section('inner_js')
@endsection