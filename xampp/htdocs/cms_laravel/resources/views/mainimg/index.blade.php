@extends('layouts.admin_common.parent')
@section('inner_css')
<link href="{{asset('css/admin/mainimg/index.css')}}" rel="stylesheet">
@endsection

@section('content')
<section class="content">
  {{-- @php
      // if(!empty($request->input('main'))){
      //   echo $request->input('main');
      // }
      if(!empty($_POST['main'])){
         echo $_POST['main'];
      }
  @endphp --}}
  
<form action="{{url('cms-admin/bloginfo/mainimg/')}}" method="POST" enctype="multipart/form-data" id="up_form">
  <div class="card card-default">
    <div class="card-header">
      <h3 class="card-title">
        <i class="fas fa-cog"></i>
        {{$title}}
      </h3>
    </div>
    <!-- /.card-header -->

    
      {{ csrf_field() }}
    <div class="card-body">
      <label id="largeFile" for="file">
        <input type="file" id="file" accept="image/png,image/jpeg,image/gif" name="files">
        {{-- <input type="hidden" id="file_hidden"> --}}
    </label>
    <div class="invalid-feedback text-center">
    </div>
    <div class="row" id="main_upload">
      <div class="col-xl-2 d-none upload_wrap hidden_js">
        <p class="mb-0 upload_img"><img src="http://placehold.jp/300x300.png" alt=""><button type="button" class="close js_delete" aria-label="Close"><span aria-hidden="true">×</span></button></p>
       
      </div>
      @foreach ($main_imgs as $main_img)
      <div class="col-xl-2 col-md-3 col-sm-4 col-6 upload_wrap">
      <p class="mb-0 upload_img"><img src="{{asset('upload/mainimg/'.$main_img->main)}}" alt="" class="object_cover"><button type="button" class="close js_delete ajax_delete" aria-label="Close" data-id="{{$main_img->id}}"><span aria-hidden="true">×</span></button></p>
      </div>
      @endforeach

    </div>
   
    <div id="file_hidden" class="d-none">
      @foreach ($main_imgs as $main_img)
      <input type="hidden" name="delete">
      @endforeach
      {{-- <input type="hidden" name="file[]"> --}}
    </div>
    </div>
    
    <!-- /.card-body -->
  </div>
  <div class="text-right"><button class="btn btn-primary btn_sp_size" id="create">保存</button></div>
  </form>
</section>



<!-- /.modal -->
@endsection
@section('inner_js')
<script src="{{asset('js/admin/mainimg/index.js')}}"></script>
@endsection