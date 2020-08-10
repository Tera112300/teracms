@extends('DemoTheme.Templates.main')
@section('inner_css')
<link href="{{asset('themes/DemoTheme/css/summernote-bs4.css')}}" rel="stylesheet">
<link href="{{asset('themes/DemoTheme/css/blog.css')}}" rel="stylesheet">
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
<link href="{{asset('themes/DemoTheme/css/content_layout.css')}}" rel="stylesheet">
<link href="{{asset('themes/DemoTheme/css/calendar.css')}}" rel="stylesheet">
<link href="{{asset('themes/DemoTheme/css/contact.css')}}" rel="stylesheet">
@endsection

@section('content')

@php
    use Carbon\Carbon; //日付操作
@endphp
  <div id="container" class="mt40">
    <div class="clearfix mb60">
      <div class="blog_content comb comb_bottom">
        <ul class="data_list">
          <li class="time_wrap"><p><i class="far fa-clock mr2"></i>{{(new Carbon($posts_id->updated_at))->format('Y年m月d日')}}</p></li>
          <li class="category_wrap"><p><i class="fas fa-folder mr2"></i><a href="{{url('blog/?cat='.$posts_id->category)}}">{{$posts_id->category}}</a></p></li>
          @if ($posts_id->post_name != '')
          <li class="tags_wrap"><i class="fas fa-tag mr6"></i>@php($array_names = explode(",",$posts_id->post_name))
            {{-- array_uniqueで同じ値を削除でeach --}}
             @foreach (array_unique($array_names) as $array_name)
                        @if (!$loop->last)
                        <div class="tag"><a href="{{url('blog/?tag='.$array_name)}}">{{$array_name}}</a></div>
                        @endif
              @endforeach</li>
          @endif
        </ul>
      <h3 class="ttl mb20">{{$posts_id->post_title}}</h3>
      @if ($posts_id->post_guid != '')
      <p class="mb45 ta_c catching_img"><img src="{{asset('upload/'.$posts_id->post_guid)}}" alt=""></p>
      @else
      <p class="mb45 ta_c catching_img"><img src="{{asset('themes/DemoTheme/images/fixed/fixed_img01.jpg')}}" alt=""></p>
      @endif
        <div class="content_layout clearfix">
          {!! $posts_id->post_content !!}
        </div>
        
        <div class="user mt45">
          <a href="{{url('blog/?author='.$user->id)}}">
            <ul class="user_list">
              <li>
                <p>
                  @if ($user->user_img != '')
                  <div class="img" style="background-image: url({{url('upload/users/'.$user->user_img)}})"></div>
                  @else
                  <div class="img" style="background-image: url({{url('themes/DemoTheme/images/common/user.jpg')}})"></div>
                  @endif
                </p>
              </li>
              <li>
                <p class="user_ttl mb5">この記事を作成した投稿者</p>
                <p class="user_name">{{$user->name}}</p>
              </li>
              </ul>
          </a>
        </div>

        <div class="relation mt45">
          <p class="relation_ttl mb10">関連記事</p>
          @if ($posts_ex->where('category',$posts_id->category)->where('id', '!=', $posts_id->id)->first() != '')
          <ul class="relation_list clearfix mb45 mb30_sp">
            {{-- :where('id', '<>', 1)->でも以外抽出できる --}}
           @foreach ($posts_ex->where('category',$posts_id->category)->where('id', '!=', $posts_id->id)->take(2)->get() as $post)
           <li>
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
          @else
          <p class="relation_no_txt">関連記事はありません</p>
          @endif
          
        
        </div>
      </div>
      @include('DemoTheme.Templates.sidebar')
    </div>
  </div>


<!-- /.modal -->
@php($date_picker[]="")
@foreach ($posts->get() as $posts_date_picker)
@php(array_push($date_picker,(new Carbon($posts_date_picker->updated_at))->format('yy-m-d')))
{{-- {{$posts_date_picker->updated_at}} --}}
{{-- {{(new Carbon($posts_date_picker->updated_at))->format('yy/mm/dd')}} --}}
@endforeach
{{-- @php(print_r($date_picker)) --}}

{{-- @php(array_unique($date_picker)) --}}
@php(array_shift($date_picker))
@endsection
@section('inner_js')
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script src="https://rawgit.com/jquery/jquery-ui/master/ui/i18n/datepicker-ja.js"></script>
<script src="{{asset('themes/DemoTheme/js/content_layout.js')}}"></script>
<script src="{{asset('themes/DemoTheme/js/google_form.js')}}"></script>
{{-- <script src="{{asset('themes/DemoTheme/js/calendar.js')}}"></script> --}}
<script>
  $(function () {
    var php_date = @json($date_picker);
    //console.log(php_date);
  var dateFormat = 'yy-mm-dd';
  var showDates = php_date;
  // var showDates =  ["2020-08-07","2020-08-05"];
  
  var opt = {
    dateFormat: 'yy-mm-dd',
    beforeShowDay: function (date) {
      var showDate = $.datepicker.formatDate(dateFormat, date);

      //console.log((showDates.indexOf(showDate) == 1));
      return [(showDates.indexOf(showDate) != -1), "", "投稿日"];
    },
	  onSelect: function(dateText, inst) {
                      $("#date_val").val(dateText);
                  },
                  onSelect: function(date) {
                    $("#date_val").val(date);
        //alert(date);
        $('.datepicker_wrap').submit();
     }
  };
 $("#datepicker").datepicker(opt);
});

</script>
@endsection