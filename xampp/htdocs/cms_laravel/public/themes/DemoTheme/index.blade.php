@extends('DemoTheme.Templates.main')
@section('inner_css')
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css"/>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css"/>
<link href="{{asset('themes/DemoTheme/css/perfect-scrollbar.css')}}" rel="stylesheet">
<link href="{{asset('themes/DemoTheme/css/top.css')}}" rel="stylesheet">
<link href="{{asset('themes/DemoTheme/css/main.css')}}" rel="stylesheet">
@endsection

@section('content')
{{-- {{$main_imgs->count()}} --}}
@if ($main_imgs->count() == 0)
<p id="main_on_img"><img src="{{asset('themes/DemoTheme/images/top/main/main.jpg')}}" alt="" width="2400" height="960"></p>
{{-- 登録されていなければ何もしない --}}
@elseif($main_imgs->count() == 1)
<p id="main_on_img"><img src="{{asset('upload/mainimg/'.$main_imgs->first()->main)}}" alt="" width="2400" height="960"></p>
@else
{{-- 2件以降スライダー展開 --}}
<div id="main">
    <ul class="main_slider">
    @foreach ($main_imgs->get() as $main_img)
    <li><img src="{{asset('upload/mainimg/'.$main_img->main)}}" alt="" width="2400" height="960"></li>
    @endforeach
    </ul>
    <div id="arrows">
      <div class="slick-next"> <img src="{{asset('themes/DemoTheme/images/top/main/next.png')}}" alt="→"> </div>
      <div class="slick-prev"> <img src="{{asset('themes/DemoTheme/images/top/main/prev.png')}}" alt="←"> </div>
    </div>
    <div class="circle_wrap">
      <div class="circle_bg"></div>
    </div>
  </div>
@endif
@php
    use Carbon\Carbon; //日付操作
@endphp
  <div id="container" class="mt40">
    <section class="news mb45">
      <h3 class="global_ttl mb20 comb comb_bottom">新着情報</h3>
      <div class="table_news comb comb_bottom">
        <table>
            {{-- @foreach ($posts->get() as $post)
           
            @if ($post->post_status == "公開")
            <tr>
            <th>{{(new Carbon($post->updated_at))->format('Y年m月d日')}}</th>
            
                <td>「{{$post->post_title}}」記事を@if ($post->created_at == $post->updated_at)投稿しました。@else更新後、投稿しました。@endif
                    </td>
              </tr>
              @endif
            @endforeach --}}
            @foreach ($posts->take(10)->get() as $post)
            
            <tr>
            <th>{{(new Carbon($post->updated_at))->format('Y年m月d日')}}</th>
            
                <td> @if ($post->post_status == "非公開") 非公開：@endif「{{$post->post_title}}」記事を@if ($post->created_at == $post->updated_at)投稿しました。@else更新しました。@endif</td>
              </tr>
              
            @endforeach
        </table>
      </div>
    </section>
    <section class="blog mb90 mb60_sp">
      <h3 class="global_ttl mb30 comb comb_bottom">ブログ</h3>
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
        <h4>@if ($post->post_status == "非公開") 非公開：@endif{{$post->post_title}}</h4>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script> 


<script src="{{asset('themes/DemoTheme/js/perfect-scrollbar.js')}}"></script> 
<script src="{{asset('themes/DemoTheme/js/main.js')}}"></script>
<script>
  $(function(){
    //4以上の場合スクロールバー出す
    if($(".news .table_news tr").length >= 4){
      $(".news .table_news").addClass("scroll_bar_on");
      var ps = new PerfectScrollbar('.news .table_news');
    }
  });
  
</script>
@endsection