<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
{{-- emptyあれば表示 --}}
<title>@if (!empty($under_title)) {{$under_title}} | @endif{{$blog_info_first->name}}</title>
<meta name="csrf-token" content="{{ csrf_token() }}">
  <!-- Tell the browser to be responsive to screen width -->
<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no">
@if (!empty($under_description))
<meta name="description" content="{{$blog_info_first->description.$under_description}}">
@else
<meta name="description" content="{{$blog_info_first->description}}">
@endif
@if (!empty($under_keywords))
<meta name="keywords" content="デモテーマ,デモ,PHP,テーマ,{{$under_keywords}}">
@else
<meta name="keywords" content="デモテーマ,デモ,PHP,テーマ">
@endif


<link rel="stylesheet" type="text/css" href="{{asset('themes/DemoTheme/css/common.css')}}" />
<link rel="stylesheet" type="text/css" href="{{asset('themes/DemoTheme/css/comb.css')}}" />
<link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
<!--font-family: tbchibirgothicplusk-pro, sans-serif; font-family: cheap-pine, sans-serif;-->
<script>
  (function(d) {
    var config = {
      kitId: 'xog1lnv',
      scriptTimeout: 3000,
      async: true
    },
    h=d.documentElement,t=setTimeout(function(){h.className=h.className.replace(/\bwf-loading\b/g,"")+" wf-inactive";},config.scriptTimeout),tk=d.createElement("script"),f=false,s=d.getElementsByTagName("script")[0],a;h.className+=" wf-loading";tk.src='https://use.typekit.net/'+config.kitId+'.js';tk.async=true;tk.onload=tk.onreadystatechange=function(){a=this.readyState;if(f||a&&a!="complete"&&a!="loaded")return;f=true;clearTimeout(t);try{Typekit.load(config)}catch(e){}};s.parentNode.insertBefore(tk,s)
  })(document);
</script>

<!--font-family: tbchibirgothicplusk-pro, sans-serif;-->

  @yield('inner_css')
</head>
<body>

<h1>{{$blog_info_first->name}}</h1>
<div class="wrap" id="pagetop">
  @if (Auth::check())
  @include('DemoTheme.Templates.toolbar')
  @endif
  <div id="clone_header" class="@if (Auth::check()) bar_on @endif"></div>

    <header class="@if (Auth::check()) bar_on @endif">
        <div class="header">
        <h1>{{$blog_info_first->name}}</h1>
        <h2 class="logo alpha"><a href="{{url('/')}}">{{$blog_info_first->name}}</a></h2>
          <div class="btn_nav">
            <div class="wrap">
              <hr>
              <hr>
              <hr>
            </div>
          </div>
        </div>
        <div class="nav_js">
          <div>
            <nav class="gnavi_wrap">
              <ul class="gnavi">
                <li><a href="{{url('/').'/'}}" data-lowernolink="true">ホーム</a></li>
                <li><a href="{{url('/blog/')}}">ブログ</a></li>
                @foreach ($fixeds->get() as $fixed)
              <li class="@if ($fixed->fixed_status == "非公開") private @endif"><a href="{{url('/'.$fixed->fixed_url)}}">{{$fixed->fixed_title}}</a></li>
                @endforeach
              </ul>
            </nav>
          </div>
        </div>
      </header>
      @include('DemoTheme.Templates.breadcrumbs')
      @yield('content')

      <footer>
        <div class="footer_bg">
          <div class="clearfix box01">
            <div class="item">
              <h3>SNSリンク</h3>
              <ul class="clearfix sns_list">
                @if ($blog_info_first->twitter_url != "")
                <li><a href="{{$blog_info_first->twitter_url}}" target="_blank" rel="external noreferrer noopener"><i class="fab fa-twitter-square"></i></a></li>
                @endif
              @if ($blog_info_first->instagram_url != "")
              <li><a href="{{$blog_info_first->instagram_url}}" target="_blank" rel="external noreferrer noopener"><i class="fab fa-instagram"></i></a></li>
              @endif
               @if ($blog_info_first->facebook_url != "")
               <li><a href="{{$blog_info_first->facebook_url}}" target="_blank" rel="external noreferrer noopener"><i class="fab fa-facebook-square"></i></a></li>
               @endif 
              </ul>
            </div>
            <div class="item">
              <h3>カテゴリー</h3>
              <ul class="category_list">
                @php($category_result[]="")
                @foreach ($posts->get() as $post)
                @if ($post->category != "")
                @php(array_push($category_result,$post->category))
                @endif
                {{-- <li><a href="#">{{$post->category}}</a></li> --}}
                @endforeach
               @foreach (array_unique($category_result) as $category)
               @if (!$loop->first)
              <li><a href="{{url('blog/?cat='.$category)}}">{{$category}}</a></li>
               @endif
               @endforeach
                {{-- <li><a href="#">ダミー</a></li> --}}
              </ul>
            </div>
            <div class="item">
                <h3>タグ</h3>
                @php($result="")
              <ul class="tag_list">
                {{-- 文字列連結$result --}}
                @foreach ($posts->get() as $post)
                @if ($post->post_name != "")
                @php($result .=$post->post_name)
                @endif
                @endforeach
                {{-- ここで連結した$resultを,を除いた配列に変換 --}}
                @php($array_names = explode(",",$result))
                {{-- array_uniqueで同じ値を削除でeach --}}
                 @foreach (array_unique($array_names) as $array_name)
                            @if (!$loop->last)
                            <li><a href="{{url('blog/?tag='.$array_name)}}">{{$array_name}}</a></li>
                            @endif
                  @endforeach
              </ul>
            </div>
          </div>
        </div>
        <p class="copyright ta_c"><small>Copyright &copy; @datetime_year(now()) {{$blog_info_first->name}}. All rights reserved.</small></p>
      </footer>

</div>
@include('DemoTheme.Templates.modal_contact')
<!-- ./wrapper -->



<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jQuery-rwdImageMaps/1.6/jquery.rwdImageMaps.min.js"></script> 
<script type="text/javascript" src="{{asset('themes/DemoTheme/js/util.js')}}"></script>
<script type="text/javascript" src="{{asset('themes/DemoTheme/js/comb.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/object-fit-images/3.2.4/ofi.min.js"></script>

<script>
    objectFitImages();
</script>
<script src="{{asset('themes/DemoTheme/js/google_form.js')}}"></script>
@yield('inner_js')
</body>
</html>