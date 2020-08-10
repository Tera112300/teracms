<div class="toolbar_header">
  <ul class="toolbar_list">
    <li class="logo alpha"><a href="{{url('/cms-admin/')}}"><img src="{{asset('images/admin/cms_logo.png')}}" alt="Tera cms" width="28" height="28"></a></li>
    <li><span class="js_toolbar_even"><i class="fas fa-plus"></i>新規作成</span>
    <ul class="js_toolbar">
    <li><a href="{{url('/cms-admin/post/create/')}}">記事ページ</a></li>
      <li><a href="{{url('/cms-admin/fixed/create/')}}">固定ページ</a></li>
      @if (Auth::user()->user_status != "投稿者")
      <li><a href="{{url('/cms-admin/user/create/')}}">ユーザー</a></li>
      @endif
     
    </ul>
    </li>
  </ul>
  <ul class="user_list">
    <li>
      <span class="js_user_even"><p class="user_img">
        @if (Auth::user()->user_img != '')
        <img src="{{url('upload/users/'.Auth::user()->user_img)}}" alt="" width="24" height="24">
        @else
        <img src="{{url('themes/DemoTheme/images/common/user.jpg')}}" alt="" width="24" height="24">
        @endif
        
      </p>
      <p class="user_text">{{ Auth::user()->name}}</p></span>
      <ul class="js_user">
      <li><a href="{{url('/cms-admin/user/edit/'.Auth::user()->id)}}">プロフィール情報編集</a></li>
      <li><a href="{{ route('logout') }}" onclick="event.preventDefault();
        document.getElementById('logout-form').submit();">Logout</a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
          @csrf
      </form>
      </li>
    </ul>
    </li>
  </ul>
  </div>