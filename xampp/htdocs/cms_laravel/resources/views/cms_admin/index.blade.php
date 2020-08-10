@extends('layouts.admin_common.parent')
@section('inner_css')
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
<link rel="stylesheet" href="{{asset('css/admin/index.css')}}">
@endsection

@section('content')
@php
    use Carbon\Carbon; //日付操作
@endphp
<section class="content">
  <div class="row">
    <div class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box bg-info">
        <div class="inner">
          <h3>{{$posts->count()}}</h3>

          <p>記事投稿数</p>
        </div>
        <div class="icon">
          <i class="fas fa-pencil-alt"></i>
        </div>
      <a href="{{url()->current().'/post/'}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box bg-success">
        <div class="inner">
          <h3>{{$fixeds->count()}}</h3>

          <p>固定ページ数</p>
        </div>
        <div class="icon">
          <i class="fas fa-sticky-note"></i>
        </div>
        <a href="{{url()->current().'/fixed/'}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box bg-warning">
        <div class="inner">
        <h3>{{$users->count()}}</h3>

          <p>ユーザー登録数</p>
        </div>
        <div class="icon">
          <i class="fas fa-user-plus"></i>
        </div>
        <a href="{{url()->current().'/user/'}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box bg-danger">
        <div class="inner">
          <h3>
            @php
            echo phpversion();
            @endphp
          </h3>
         
          <p>PHPバージョン</p>
        </div>
        <div class="icon">
          <i class="fas fa-chart-pie"></i>
        </div>
        <a href="https://www.php.net/manual/ja/index.php" class="small-box-footer" target="_blank"  rel="external noreferrer noopener">More info <i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->
  </div>
  <div class="row">
    <div class="col-lg-7 connectedSortable">
      <div class="card bg-gradient-info" id="new_user">
        <div class="card-header border-0">

          <h3 class="card-title">
            <i class="fas fa-user"></i>
            最新のユーザー
          </h3>
          <!-- tools card -->
          <div class="card-tools">
            <!-- button with a dropdown -->
            
            <button type="button" class="btn btn-info btn-sm" data-card-widget="collapse">
              <i class="fas fa-minus"></i>
            </button>
            
          </div>
          <!-- /. tools -->
        </div>
        <!-- /.card-header -->
        <div class="card-body pt-0 pb-2 pl-2 pr-2">
          <ul class="users-list clearfix mb-0">
            @foreach ($users as $user)
            {{-- iteration1から始まる --}}
            @if ($loop->iteration <= 4)
            <li>
              {{-- {{$loop->iteration}} --}}
              @if($user->user_img)
            <img src="{{url('upload/users/'.$user->user_img)}}" alt="User Image" width="128" height="128" class="object_cover">
            @else
            <img src="{{asset('images/admin/user.jpg')}}" alt="User Image" width="128" height="128" class="object_cover">
            @endif
            <p>{{$user->name}}<br> <span class="users-list-date">{{(new Carbon($user->created_at))->format('Y年m月d日')}}</span></p>
             
            </li>
            @endif
            
            @endforeach
          </ul>
        </div>
        {{-- <div class="card-footer text-center">
          <a href="javascript::">More info </a>
        </div> --}}
        <!-- /.card-body -->
      </div>

      <div class="card" id="new_post">
        <div class="card-header">
          <h3 class="card-title"><i class="fas fa-pencil-alt"></i>最近投稿された記事</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse">
              <i class="fas fa-minus"></i>
            </button>
          </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body p-0">
          <ul class="products-list product-list-in-card pl-2 pr-2">
             @foreach ($posts as $post)
             @if ($loop->iteration <= 3)
            <li class="item">
              <div class="product-img">
                @if($post->post_guid)
                <img src="{{url('upload/'.$post->post_guid)}}" alt="Image" class="img-size-50" width="150" height="150">
                @else
                <img src="{{asset('images/admin/noimage_350x350.png')}}" alt="Image" class="img-size-50" width="150" height="150">
                @endif
              </div>
              <div class="product-info">
              <a href="{{url()->current().'/post/edit/'.$post->id}}" class="product-title">{{$post->post_title}}</a>
                <span class="product-description">
                  {{$post->post_excerpt}}
                </span>
              </div>
            </li>
            @endif
          @endforeach
          </ul>
        </div>
        <!-- /.card-body -->
      </div>
      

    </div>
    <div class="col-lg-5 connectedSortable">
      <div class="card bg-gradient-success">
        <div class="card-header border-0">

          <h3 class="card-title">
            <i class="far fa-calendar-alt"></i>
            カレンダー
          </h3>
          <!-- tools card -->
          <div class="card-tools">
            <!-- button with a dropdown -->
            
            <button type="button" class="btn btn-success btn-sm" data-card-widget="collapse">
              <i class="fas fa-minus"></i>
            </button>
            
          </div>
          <!-- /. tools -->
        </div>
        <!-- /.card-header -->
        <div class="card-body pt-0 pb-2 pl-2 pr-2">
          <!--The calendar -->
          <div id="datepicker"></div>
          <input type="hidden" id="date_val"/>
        </div>
        <!-- /.card-body -->
      </div>
    </div>
  </div>
</section>


{{-- <button class="btn btn-clipboard" data-clipboard-target="#clipboard-target">コピーする</button>
<div id="clipboard-target">ここの文字がコピーされます。</div>
<button class="btn btn-clipboard" data-clipboard-target="#clipboard-target">コピー</button><span class="clipboard-success">コピーしました</span> --}}


<!-- /.modal -->
@endsection
@section('inner_js')
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script src="https://rawgit.com/jquery/jquery-ui/master/ui/i18n/datepicker-ja.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.6/clipboard.min.js"></script>
<script src="{{asset('js/admin/index.js')}}"></script>
@endsection