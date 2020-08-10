@extends('DemoTheme.Templates.main')
@section('inner_css')
<link href="{{asset('themes/DemoTheme/css/404.css')}}" rel="stylesheet">
@endsection

@section('content')

@php
    use Carbon\Carbon; //日付操作
@endphp
  <div id="container" class="mt40">
    <div class="box_404">
      <div class="circle comb comb_bottom">
     <ul class="list">
       <li><img src="{{asset('themes/DemoTheme/images/404/circle01.png')}}" alt=""></li>
       <li><img src="{{asset('themes/DemoTheme/images/404/circle02.png')}}" alt=""></li>
       <li><img src="{{asset('themes/DemoTheme/images/404/circle03.png')}}" alt=""></li>
       <li><img src="{{asset('themes/DemoTheme/images/404/circle04.png')}}" alt=""></li>
       <li><img src="{{asset('themes/DemoTheme/images/404/circle05.png')}}" alt=""></li>
     </ul>	
     </div>
     <div class="text comb comb_bottom comb_delay2">
     <h3>404</h3>
     <p class="read">Page not fount</p>
     <p class="btn_back"><a href="{{url('/')}}">ホームへ戻る</a></p>
     </div>
      </div>
  </div>


<!-- /.modal -->
@endsection
@section('inner_js')
@endsection