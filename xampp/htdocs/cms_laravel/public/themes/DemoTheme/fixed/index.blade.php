@extends('DemoTheme.Templates.main')
@section('inner_css')
<link href="{{asset('themes/DemoTheme/css/summernote-bs4.css')}}" rel="stylesheet">
<link href="{{asset('themes/DemoTheme/css/blog.css')}}" rel="stylesheet">
<link href="{{asset('themes/DemoTheme/css/content_layout.css')}}" rel="stylesheet">
<link href="{{asset('themes/DemoTheme/css/contact.css')}}" rel="stylesheet">
@endsection

@section('content')

@php
    use Carbon\Carbon; //日付操作
@endphp
  <div id="container" class="mt40">
    <div class="fixed_content mb60 comb comb_bottom">
      <h3 class="global_ttl mb30">{{$fixed_url->fixed_title}}</h3>
      @if ($fixed_url->fixed_guid != '')
      <p class="mb25 ta_c catching_img"><img src="{{asset('upload/'.$fixed_url->fixed_guid)}}" alt=""></p>
      @else
      <p class="mb25 ta_c catching_img"><img src="{{asset('themes/DemoTheme/images/fixed/fixed_img01.jpg')}}" alt=""></p>
      @endif
     
        {{-- <h3 class="ttl mb20">{{$fixed_url->fixed_title}}</h3> --}}
       
          <div class="content_layout">
            {!! $fixed_url->fixed_content !!}
          </div>

    </div>
      {{-- <div class="clearfix mb60">
        <div class="blog_content">
          
        </div>
        @include('DemoTheme.Templates.sidebar')
      </div> --}}
      
    
  </div>


<!-- /.modal -->
@endsection
@section('inner_js')
<script src="{{asset('themes/DemoTheme/js/content_layout.js')}}"></script>
@endsection