<nav class="main-header navbar navbar-expand navbar-white navbar-light">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
    </li>
    <li class="nav-item d-none d-sm-inline-block home">
    <a href="{{url('/').'/'}}" class="nav-link" target="_blank" rel="external noreferrer noopener">Home</a>
    </li>
    
  </ul>

  

  <!-- Right navbar links -->
  <ul class="navbar-nav ml-auto">
    <!-- Messages Dropdown Menu -->
    
    <!-- Notifications Dropdown Menu -->
    <li class="nav-item dropdown">
      <a class="nav-link" data-toggle="dropdown" href="#">
        @if (Auth::user()->user_img == "")
        <i class="fa fa-user-circle" aria-hidden="true"></i>
          @else
      <img src="{{url('upload/users/'.Auth::user()->user_img)}}" alt="" width="35" height="34" id="users_avatar">
          @endif
        {{ Auth::user()->name }}
      </a>
      <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
        <a href="{{url('/cms-admin/user/edit/'.Auth::user()->id)}}" class="dropdown-item">
          <i class="fa fa-cogs" aria-hidden="true"></i> プロフィール情報編集
        </a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="{{ route('logout') }}"
        onclick="event.preventDefault();
                      document.getElementById('logout-form').submit();">
          <i class="fas fa-sign-out-alt" aria-hidden="true"></i> {{ __('Logout') }}
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
          @csrf
      </form>
      </div>
    </li>
    
  </ul>
 
</nav>