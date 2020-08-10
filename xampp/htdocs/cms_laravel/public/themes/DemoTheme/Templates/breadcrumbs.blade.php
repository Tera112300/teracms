@if (!empty($pankuzu_array))
<div class="pankuzu_wrap comb">
  <ul class="pankuzu">
    @foreach ($pankuzu_array as $key => $pankuzu)
  <li><a href="{{$key}}">{{$pankuzu}}</a></li>
    @endforeach
  <li> {{$current}}</li>
  {{-- <li>{{$posts_id->category}}</li> --}}
  </ul>
</div>
@endif