@extends('layouts.admin_common.parent')
@section('inner_css')
<link href="{{asset('css/post/index.css')}}" rel="stylesheet">
@endsection

@section('content')
<section class="content">
  <div class="card">
    <div class="card-header">
    <div class="flex_header_block">
      <h3 class="card-title">{{$title}}</h3>
      <ul class="operation_list">
        <li><a href="{{url('cms-admin/user/create/')}}" class="btn btn-success"><i class="fa fa-plus-circle"></i>新規作成</a></li>
        {{-- <li><a href="" class="btn btn-danger js_form_delete" data-toggle="modal" data-target="#modal-danger" data-id="all"><i class="fa fa-trash"></i>ログインユーザー以外全削除</a></li> --}}
        </ul>
    </div>
    
      <div class="card-tools">
        <form action="{{url('cms-admin/user/')}}" method="GET" >
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
            <th>ユーザー名</th>
            <th>メールアドレス</th>
            <th>操作</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($users as $user)
          <tr>
            <td> {{$user->name}}</td>
            <td>{{$user->email}}</td>
            <td>
              <ul class="operation_list">
                <li><a href="{{url()->current()}}/edit/{{$user->id}}" class="btn btn-primary"><i class="fa fa-edit"></i>編集</a></li>
                @if ($user->id != Auth::user()->id)
                <li><a href="" class="btn btn-danger js_form_delete" data-toggle="modal" data-target="#modal-danger" data-id="{{$user->id}}"><i class="fa fa-trash"></i>削除</a></li>
                @endif
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
      {{ $users->appends(request()->input())->links('pagination::default') }}
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
      <form action="{{url('/cms-admin/user/delete/')}}" method="POST" id="js_form">
        {{ csrf_field() }}
        {{ method_field('DELETE') }}
      <div class="modal-body">
        <div class="form-group">
          <label>すべてのコンテンツを以下のユーザーのものにする</label>
          <select class="form-control user_select" name="user_select">
            @foreach ($users_ex as $user)
          <option data-id="{{$user->id}}" value="{{$user->id}}">{{$user->name}}</option>
            @endforeach
          
          </select>
        </div>
      </div>
      <div class="modal-footer justify-content-between">
        
        <button type="button" class="btn btn-default" data-dismiss="modal">キャンセル</button>
        
         
          <button class="btn btn-danger">削除</button>
        
      </div>
    </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
@endsection
@section('inner_js')
<script src="{{asset('js/user/index.js')}}"></script>
@endsection