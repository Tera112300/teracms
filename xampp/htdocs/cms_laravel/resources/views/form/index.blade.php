@extends('layouts.admin_common.parent')
@section('inner_css')
<link href="{{asset('css/form/index.css')}}" rel="stylesheet">
@endsection

@section('content')
@php
    use Carbon\Carbon; //日付操作
@endphp
<section class="content">

  <div class="card">
    <div class="card-header">
    <div class="flex_header_block">
      <h3 class="card-title">{{$title}}</h3>
      <ul class="operation_list">
        <li><a href="{{url('cms-admin/form/create/')}}" class="btn btn-success"><i class="fa fa-plus-circle"></i>新規作成</a></li>
        <li><a href="" class="btn btn-danger js_form_delete" data-toggle="modal" data-target="#modal-danger" data-id="all"><i class="fa fa-trash"></i>全削除</a></li>
        </ul>
    </div>
    
      <div class="card-tools">
        <form action="{{url('cms-admin/form/')}}" method="GET" >
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
    
  
 {{-- @foreach ($users as $user)
 {{$user->name}}
 @endforeach --}}

   {{-- @php
       echo $users->select('name')->get()
   @endphp --}}
  
 
    <!-- /.card-header -->
    <div class="card-body table-responsive p-0">
      <table class="table table-hover text-nowrap">
        <thead>
          <tr>
            <th>タイトル </th>
            <th>作成日時</th>
            <th>更新日時</th>
            <th>操作</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($forms as $form)
          <tr>
            <td> {{$form->form_title}}</td>
          
          
            <td>{{(new Carbon($form->created_at))->format('Y年m月d日')}}</td>
            <td><span class="tag tag-success">{{(new Carbon($form->updated_at))->format('Y年m月d日')}}</span></td>
            
            <td>
              <ul class="operation_list">
                <li><a href="{{url()->current()}}/edit/{{$form->id}}" class="btn btn-primary"><i class="fa fa-edit"></i>編集</a></li>
              <li><a href="" class="btn btn-danger js_form_delete" data-toggle="modal" data-target="#modal-danger" data-id="{{$form->id}}"><i class="fa fa-trash"></i>削除</a></li>
              </ul>
              </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    <!-- /.card-body -->
    
    
    <div class="card-footer clearfix">
      {{-- {{$posts->links('pagination::default')}} --}}
      {{$forms->appends(request()->input())->links('pagination::default') }}
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
        <form action="{{url('/cms-admin/form/delete/')}}" method="POST" id="js_form">
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



<!-- /.modal -->
@endsection
@section('inner_js')
<script src="{{asset('js/post/index.js')}}"></script>
@endsection