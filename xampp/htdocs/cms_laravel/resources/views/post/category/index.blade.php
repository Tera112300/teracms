@extends('layouts.admin_common.parent')
@section('inner_css')
<link href="{{asset('css/post/index.css')}}" rel="stylesheet">
@endsection

@section('content')
@php
use Carbon\Carbon; //日付操作
@endphp
<section class="content">
  <div class="row">
    <div class="col-xl-4 mb-4">
    <form action="{{url()->current()}}" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="card card-default collapse_block">
          <div class="card-header">
            <h3 class="card-title">
             
              <i class="fas fa-list-alt"></i>
             カテゴリー新規追加
            </h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body" id="upload_post">
            
            <div class="callout callout-info">
              <div class="form-group">
                <label>カテゴリー名</label>
                <input type="text" class="form-control @if($errors->has('name_category')) is-invalid @endif" placeholder="category name" name="name_category" required>
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
      
    </div>
    <div class="col-xl-8">
      <div class="card">
        <div class="card-header">
        <div class="flex_header_block">
          <h3 class="card-title">{{$title}}</h3>
          <ul class="operation_list">
            <li><a href="" class="btn btn-danger js_form_delete" data-toggle="modal" data-target="#modal-danger" data-id="all"><i class="fa fa-trash"></i>全削除</a></li>
            </ul>
        </div>
        
          <div class="card-tools">
            <form action="{{url('cms-admin/post/category/')}}" method="GET" >
              {{ csrf_field() }}
            <div class="input-group input-group-sm" style="width: 150px;">
              <input type="text" name="table_search" class="form-control float-right" placeholder="Search">
              <div class="input-group-append">
                <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
              </div>
            </div>
          </form>
          </div>
        </div>
        
      
     
      
     
        <!-- /.card-header -->
        <div class="card-body table-responsive p-0">
          <table class="table table-hover text-nowrap">
            <thead>
              <tr>
                <th>カテゴリー名</th>
                <th>作成日時</th>
                <th>更新日時</th>
                <th>操作</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($categories as $category)
              <tr>
                <td> {{$category->name_category}}</td>
             
                <td>{{(new Carbon($category->created_at))->format('Y年m月d日')}}</td>
                <td><span class="tag tag-success">{{(new Carbon($category->updated_at))->format('Y年m月d日')}}</span></td>
                <td>
                  <ul class="operation_list">
                  <li><a href="{{url('blog/?category='.$category->id)}}" class="btn btn-warning" target="_blank" rel="external noreferrer noopener"><i class="fa fa-eye"></i>表示</a></li>
                    <li><a href="{{url()->current()}}/edit/{{$category->id}}" class="btn btn-primary"><i class="fa fa-edit"></i>編集</a></li>
                  <li><a href="" class="btn btn-danger js_form_delete" data-toggle="modal" data-target="#modal-danger" data-id="{{$category->id}}"><i class="fa fa-trash"></i>削除</a></li>
                  </ul>
                  </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        <!-- /.card-body -->
        <div class="card-footer clearfix">
          {{ $categories->appends(request()->input())->links('pagination::default') }}
        </div>
      </div>
    </div>
  </div>
  

     
      
    

</section>

<div class="modal fade post_delete" id="modal-danger">
  <div class="modal-dialog">
    <div class="modal-content bg-danger">
      <div class="modal-header">
        <h4 class="modal-title"><i class="fa fa-trash mr-2"></i>削除してもよろしいですか？</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">キャンセル</button>
        <form action="{{url('/cms-admin/post/category/delete/')}}" method="POST" id="js_form">
          {{ csrf_field() }}
            {{ method_field('DELETE') }}
          <button class="btn btn-danger">削除</button>
        </form>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
@endsection
@section('inner_js')
<script src="{{asset('js/post/index.js')}}"></script>
@endsection