@extends('layouts.admin_common.parent')
@section('inner_css')
<link href="{{asset('css/post/show.css')}}" rel="stylesheet">
@endsection

@section('content')
<section class="content">
  <div class="card card-default show_card">
    <div class="card-header">
      <h3 class="card-title">
        {{-- <i class="fas fa-sticky-note"></i> --}}
        <i class="fas fa-eye"></i>
        {{$title}}
      </h3>
      <ul class="operation_list">
      <li><a href="{{ url('/cms-admin/post') }}" class="btn btn-warning"><i class="fa fa-list-alt"></i>リストへ戻る</a></li>
      <li><a href="{{url('cms-admin/post/create/')}}" class="btn btn-success"><i class="fa fa-plus-circle"></i>新規作成</a></li>
      <br class="d-none show_sp_d">
        <li><a href="" class="btn btn-primary"><i class="fa fa-edit"></i>編集</a></li>
        <li><a href="" class="btn btn-danger" data-toggle="modal" data-target="#modal-danger"><i class="fa fa-trash"></i>削除</a></li>
      </ul>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
      
      <div class="callout callout-info">
        <h5>タイトル</h5>
        <p>{{$fixeds_id->fixed_title}}</p>
      </div>
      <div class="callout callout-info">
        <h5>作成者</h5>
        <p>{{$users_id->name}}</p>
      </div>
      {{-- <div class="callout callout-info">
        <h5>コンテンツ</h5>
        <p>{{$fixeds_id->fixed_content}}</p>
      </div> --}}
      <div class="callout callout-info">
        <h5>抜粋文</h5>
        <p>{{$fixeds_id->fixed_excerpt}}</p>
      </div>
      <div class="callout callout-info">
        <h5>表示状態</h5>
        <p>{{$fixeds_id->fixed_status}}</p>
      </div>
      <div class="callout callout-info">
        <h5>作成日時</h5>
        <p>{{$fixeds_id->created_at}}</p>
      </div>
      <div class="callout callout-info">
        <h5>更新日時</h5>
        <p>{{$fixeds_id->updated_at}}</p>
      </div>

      <div class="callout callout-info">
        <h5>投稿タグ</h5>
        @php($array_names = explode(",",$fixeds_id->fixed_name))
        <ul class="tag_list">
          @foreach ($array_names as $array_name)
          @if ($loop->last)
          @else
          <li>{{$array_name}}</li>
          @endif
          @endforeach
        </ul>
                           
        {{-- <p>{{$fixeds_id->fixed_name}}</p> --}}
      </div>
      <div class="callout callout-info">
        <h5>パーマリンク</h5>
        <p class="permalink"><a href="{{url('?p='.$fixeds_id->id)}}" rel="external noreferrer noopener" target="_blank">{{url('?p='.$fixeds_id->id)}}</a></p>
      </div>
      <div class="callout callout-info">
        <h5>投稿ステータス</h5>
        <p>{{$fixeds_id->fixed_status}}</p>
      </div>

      <div class="callout callout-info">
        <h5>アイキャッチ画像</h5>
        <p>
          @if($fixeds_id->fixed_guid)
          <img src="{{asset('upload/'.$fixeds_id->fixed_guid)}}" alt="" width="360">
          @else
          未設定です。
          @endif
        </p>
      </div>
      <div class="callout callout-info">
        <h5>seo タイトル</h5>
        <p>{{$fixeds_id->seo_title}}</p>
      </div>
      <div class="callout callout-info">
        <h5>meta 説明</h5>
        <p>{{$fixeds_id->meta_description}}</p>
      </div>
      <div class="callout callout-info">
        <h5>meta キーワード</h5>
        <p>{{$fixeds_id->meta_keywords}}</p>
      </div>
      
    </div>
    <!-- /.card-body -->
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
        <form action="{{url('/cms-admin/post/delete/'.$fixeds_id->id)}}" method="POST">
          {{ csrf_field() }}
            {{ method_field('DELETE') }}
          <button class="btn btn-danger">削除</button>
        </form>
        {{-- <a href="{{url('/cms-admin/post/delete/'.$fixeds_id->id)}}" class="btn btn-danger">削除</a> --}}
      
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

@endsection
@section('inner_js')

@endsection