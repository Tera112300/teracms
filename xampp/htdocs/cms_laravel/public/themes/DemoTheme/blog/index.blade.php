@extends('DemoTheme.Templates.main')
@section('inner_css')
<link href="{{asset('themes/DemoTheme/css/contact.css')}}" rel="stylesheet">
@endsection

@section('content')

@php
    use Carbon\Carbon; //日付操作
@endphp
  <div id="container" class="mt40">
   
    <section class="blog mb90 mb60_sp">
      @if (!empty($data_search) || !empty($data_tag) || !empty($data_cat) || !empty($data_author) || !empty($data_picker))
      {{-- <div class="search_wrap comb comb_bottom"><h3 class="global_ttl mb30">検索結果：{{$data_search}}</h3></div> --}}
      <div class="search_wrap comb comb_bottom"><h3 class="global_ttl mb30">{{$current}}</h3></div>
      @else
      <h3 class="global_ttl mb30 comb comb_bottom">ブログ</h3>
      @endif
     @if ($posts_paginate->count() == 0)
         <p class="ta_c comb comb_bottom">見つかりませんでした。</p>
     @endif
      <ul class="blog_list clearfix mb45 mb30_sp">
        @foreach ($posts_paginate as $post)
        <li class="comb comb_bottom">
        <a href="{{url('blog/?p='.$post->id)}}">
          <div class="bg">
            @if ($post->post_guid != '')
            <div class="bg_inner" style="background-image: url({{asset('upload/'.$post->post_guid)}})"></div>
            @else
            <div class="bg_inner" style="background-image: url({{asset('themes/DemoTheme/images/top/blog01.jpg')}})"></div>
            @endif
            <h3>{{$post->category}}</h3>
          </div>
        <h4>@if ($post->post_status == "非公開")非公開：@endif{{$post->post_title}}</h4>
        <p class="read">{{$post->post_excerpt}}</p>
        <p class="data_time"><i class="far fa-clock mr2"></i>{{(new Carbon($post->updated_at))->format('Y年m月d日')}}</p>
        
          </a>
        </li>
        @endforeach
        
      </ul>
      {{-- {{$posts->paginate(2)->links('pagination::demo')}} --}}
      {{$posts_paginate->links('pagination::demo')}}
    </section>
  </div>


<!-- /.modal -->
@endsection
@section('inner_js')
@endsection