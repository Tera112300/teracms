@extends('layouts.admin_common.parent')
@section('inner_css')

@endsection

@section('content')
<section class="content">
  
  <form action="{{url()->current()}}" method="POST">
    {{ csrf_field() }}
    <div class="row">
      <div class="col-xl-6">
        <div class="card card-default">
          <div class="card-header">
            <h3 class="card-title">
              <i class="fas fa-cog"></i>
              SEO{{$title}}
            </h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="callout callout-info">
              <div class="form-group">
                <label>サイトのタイトル</label>
                @if (!empty($blog_info_first->name))
                <input type="text" class="form-control @if($errors->has('name')) is-invalid @endif" placeholder="title" value="{{$blog_info_first->name}}" name="name" required>
                @else
                <input type="text" class="form-control @if($errors->has('name')) is-invalid @endif" placeholder="title" value="{{old('name')}}" name="name" required>
                @endif
                <div class="invalid-feedback">
                  @foreach ($errors->get('name') as $error)
                  {{ $error }}<br>
                  @endforeach
                </div>
              </div>
              <div class="form-group mb-0">
                <label>キャッチフレーズ</label>
                @if (!empty($blog_info_first->description))
                <textarea class="form-control @if($errors->has('description')) is-invalid @endif" rows="3" placeholder="description" name="description" required>{{$blog_info_first->description}}</textarea>
                 @else
                 <textarea class="form-control @if($errors->has('description')) is-invalid @endif" rows="3" placeholder="description" name="description" required>{{old('description')}}</textarea>
                @endif
                <div class="invalid-feedback">
                  @foreach ($errors->get('description') as $error)
                  {{ $error }}<br>
                  @endforeach
                </div>
              </div>
            </div>
          </div>
          <!-- /.card-body -->
        </div>
      </div>

      <div class="col-xl-6">
        <div class="card card-default">
          <div class="card-header">
            <h3 class="card-title">
              <i class="fas fa-cog"></i>
              SNSリンク{{$title}}
            </h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="callout callout-info">
              <div class="form-group">
                {{-- <label>Twitter</label> --}}
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fab fa-twitter"></i></span>
                  </div>
                @if (!empty($blog_info_first->twitter_url))
                  <input type="url" class="form-control @if($errors->has('twitter_url')) is-invalid @endif" placeholder="Twitter url" name="twitter_url" value="{{$blog_info_first->twitter_url}}">
                @else
                <input type="url" class="form-control @if($errors->has('twitter_url')) is-invalid @endif" placeholder="Twitter url" name="twitter_url" value="{{old('twitter_url')}}">
                @endif
                <div class="invalid-feedback">
                  @foreach ($errors->get('twitter_url') as $error)
                  {{ $error }}<br>
                  @endforeach
                </div>
              </div>
              </div>



              <div class="form-group">
                {{-- <label>Facebook</label> --}}
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fab fa-facebook-f"></i></span>
                  </div>
                @if (!empty($blog_info_first->facebook_url))
                  <input type="url" class="form-control @if($errors->has('facebook_url')) is-invalid @endif" placeholder="Facebook url" name="facebook_url" value="{{$blog_info_first->facebook_url}}">
                @else
                <input type="url" class="form-control @if($errors->has('facebook_url')) is-invalid @endif" placeholder="Facebook url" name="facebook_url" value="{{old('facebook_url')}}">
                @endif
                <div class="invalid-feedback">
                  @foreach ($errors->get('facebook_url') as $error)
                  {{ $error }}<br>
                  @endforeach
                </div>
              </div>
              </div>


              <div class="form-group">
                {{-- <label>Instagram</label> --}}
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fab fa-instagram"></i></span>
                  </div>
                @if (!empty($blog_info_first->instagram_url))
                  <input type="url" class="form-control @if($errors->has('instagram_url')) is-invalid @endif" placeholder="Instagram url" name="instagram_url" value="{{$blog_info_first->instagram_url}}">
                @else
                <input type="url" class="form-control @if($errors->has('instagram_url')) is-invalid @endif" placeholder="Instagram url" name="instagram_url" value="{{old('instagram_url')}}">
                @endif
                <div class="invalid-feedback">
                  @foreach ($errors->get('instagram_url') as $error)
                  {{ $error }}<br>
                  @endforeach
                </div>
              </div>
              </div>
              

              
            </div>
          </div>
          <!-- /.card-body -->
        </div>
      </div>

    </div>
  



  

  <div class="text-right"><button class="btn btn-primary btn_sp_size" id="create">保存</button></div>
</form>

</section>


<!-- /.modal -->
@endsection
@section('inner_js')
@endsection