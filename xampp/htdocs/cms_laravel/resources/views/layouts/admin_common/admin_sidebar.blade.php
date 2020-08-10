<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{url('/cms-admin/')}}" class="brand-link">
      <img src="{{asset('images/admin/cms_logo.png')}}" alt="" class="brand-image img-circle elevation-3">
      <span class="brand-text font-weight-light">TeraCms</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      {{-- <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{asset('images/admin/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Alexander Pierce</a>
        </div>
      </div> --}}

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
               <li class="nav-item">
                <a href="{{url('/cms-admin/')}}" class="nav-link" data-lowernolink="true">
                  <i class="nav-icon fas fa-tachometer-alt"></i>
                  <p>
                    ダッシュボード
                  </p>
                </a>
              </li>
          <li class="nav-item has-treeview">
            <a href="{{url('/cms-admin/post/')}}" class="nav-link">
              <i class="nav-icon fas fa-pencil-alt"></i>
              <p>
                記事
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{url('/cms-admin/post/')}}" class="nav-link" data-lowernolink="true">
                  <i class="far fa-circle nav-icon"></i>
                  <p>記事一覧</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('/cms-admin/post/create/')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>新規作成</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('/cms-admin/post/category/')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>カテゴリー</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item has-treeview">
            <a href="{{url('/cms-admin/fixed/')}}" class="nav-link">
              <i class="nav-icon fas fa-sticky-note"></i>
              <p>
                固定ページ
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{url('/cms-admin/fixed/')}}" class="nav-link" data-lowernolink="true">
                  <i class="far fa-circle nav-icon"></i>
                  <p>固定ページ一覧</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('/cms-admin/fixed/create/')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>新規作成</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item has-treeview nav-item_mail">
            <a href="{{url('/cms-admin/form/')}}" class="nav-link">
              <i class="fas fa-envelope"></i>
              <p>
                フォーム
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{url('/cms-admin/form/')}}" class="nav-link" data-lowernolink="true">
                  <i class="far fa-circle nav-icon"></i>
                  <p>フォーム一覧</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('/cms-admin/form/create/')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>新規作成</p>
                </a>
              </li>
            </ul>
          </li>


          <li class="nav-item has-treeview">
            <a href="{{url('/cms-admin/bloginfo/')}}" class="nav-link">
              <i class="nav-icon fas fa-cog"></i>
              <p>
                設定
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{url('/cms-admin/bloginfo/')}}" class="nav-link" data-lowernolink="true">
                  <i class="far fa-circle nav-icon"></i>
                  <p>SEO・SNS 設定</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('/cms-admin/bloginfo/mainimg')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>メイン画像設定</p>
                </a>
              </li>
              
            </ul>
          </li>

          @if (Auth::user()->user_status == "投稿者")
<li class="nav-item">
  <a href="{{url('/cms-admin/user/edit/'.Auth::user()->id)}}" class="nav-link">
    <i class="nav-icon fas fa-user"></i>
    <p>
      プロフィール
    </p>
  </a>
</li>
@else
<li class="nav-item has-treeview">
  <a href="{{url('/cms-admin/user/')}}" class="nav-link">
    <i class="nav-icon fas fa-user"></i>
    <p>
      ユーザー
      <i class="right fas fa-angle-left"></i>
    </p>
  </a>
  <ul class="nav nav-treeview">
    <li class="nav-item">
      <a href="{{url('/cms-admin/user/')}}" class="nav-link" data-lowernolink="true">
        <i class="far fa-circle nav-icon"></i>
        <p>ユーザー一覧</p>
      </a>
    </li>
    <li class="nav-item">
      <a href="{{url('/cms-admin/user/create/')}}" class="nav-link">
        <i class="far fa-circle nav-icon"></i>
        <p>新規作成</p>
      </a>
    </li>
    <li class="nav-item">
    <a href="{{url('/cms-admin/user/edit/'.Auth::user()->id)}}" class="nav-link">
        <i class="far fa-circle nav-icon"></i>
        <p>あなたのプロフィール</p>
      </a>
    </li>
  </ul>
</li>
@endif

          {{-- <li class="nav-item">
            <a href="{{url('/cms-admin/bloginfo/')}}" class="nav-link" data-lowernolink="true">
              <i class="nav-icon fas fa-cog"></i>
              <p>
                設定
              </p>
            </a>
          </li> --}}
          <li class="nav-item">
            <a href="{{url('/cms-admin/theme/')}}" class="nav-link">
              <i class="nav-icon fas fa-paint-brush"></i>
              <p>
                テーマ
              </p>
            </a>
          </li>

          <li class="nav-item laravel_logo_sidebar">
            <a href="http://laravel.jp/" class="nav-link" target="_blank" rel="external noreferrer noopener" >
            <img src="{{asset('images/admin/laravel_logo.png')}}" alt="">
              <p>
                Laravel公式サイト
                <span class="right badge badge-danger">New</span>
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>