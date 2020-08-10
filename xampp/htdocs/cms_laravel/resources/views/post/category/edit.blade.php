@extends('layouts.admin_common.parent')
@section('inner_css')
<link href="{{asset('css/post/index.css')}}" rel="stylesheet">
@endsection

@section('content')
<section class="content">
  
<form action="{{url()->current()}}" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="card card-default collapse_block">
          <div class="card-header">
            <h3 class="card-title">
             
              <i class="fas fa-list-alt"></i>
              {{$title}}
            </h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body" id="upload_post">
            
            <div class="callout callout-info">
              <div class="form-group">
                <label>カテゴリー名</label>
              <input type="text" class="form-control @if($errors->has('name_category')) is-invalid @endif" placeholder="category name" name="name_category" required value="{{$categories_id->name_category}}">
                <div class="invalid-feedback">
                  @foreach ($errors->get('name_category') as $error)
                  {{ $error }}<br>
                  @endforeach
                </div>
              </div>
            </div>
          </div>
          <!-- /.card-body -->
        </div>
        <div class="text-left"><button class="btn btn-primary btn_sp_size" id="create">保存</button></div>
      </form>


</section>


<!-- /.modal -->
@endsection
@section('inner_js')
@endsection