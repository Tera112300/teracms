<aside class="side_content comb comb_bottom comb_delay4">
  <form action="{{url('/blog/')}}" method="GET" class="search mb20 mb15_sp">
    {{ csrf_field() }}
    <ul>
      <li>
        <input type="text" name="search" placeholder="Search" value="" required="required">
      </li>
      <li>
        <input type="submit" value="Search">
      </li>
    </ul>
  </form>
  <div class="news_box mb20">
    <h4 class="side_ttl mb15">新着記事</h4>
    <ul class="news_list">
      @foreach ($posts->take(4)->get() as $post)
      <li>
        <a href="{{url('blog/?p='.$post->id)}}">
              <div class="img">
                @if ($post->post_guid != '')
                <p class="img_inner" style="background-image: url({{asset('upload/'.$post->post_guid)}})"></p>
                @else
                <p class="img_inner" style="background-image: url({{asset('themes/DemoTheme/images/top/blog01.jpg')}})"></p>
                @endif
              </div>
            <p class="text">
              @if ($post->post_status == "非公開") 非公開：@endif {{$post->post_title}}</p>
              </a></li>
      @endforeach
    </ul>
  </div>
<div class="category_box mb30">
<h4 class="side_ttl mb10">カテゴリー</h4>
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
</ul>

</div>
<form class="datepicker_wrap" method="GET" action="{{url('/blog')}}">
  {{-- {{ csrf_field() }} --}}
<div id="datepicker"></div>
<input type="hidden" id="date_val" name="picker">
<button class="js_date_btn" type="button">送信</button>
</form>

</aside>