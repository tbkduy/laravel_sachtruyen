@extends('../layout')
@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{url('/')}}">Trang chủ</a></li>
      <li class="breadcrumb-item active" aria-current="page">{{$tendanhmuc}}</li>
    </ol>
  </nav> 
<h2>{{$tendanhmuc}}</h2>
    <div class="album py-5 bg-light">
        <div class="container">
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
            @php 
                $count = count($truyen);
            @endphp
            @if($count==0)
            <div class="col-md-12">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <p>Hiện tại chưa có truyện nào...</p>
                    </div>
                </div>
            </div>
            @else
            @foreach($truyen as $key => $value)
            <div class="col-md-3 d-flex">
            <div class="card shadow-sm">
                <img class="card-img-top" src="{{asset('public/uploads/truyen/'. $value->hinhanh)}}" style="width: auto; height: 400px">
                <div class="card-body">
                    <h4>{{$value->tentruyen}}</h4>
                <p class="card-text">{{ Illuminate\Support\Str::words($value->tomtat, 20, '...') }}</p>
                <div class="d-flex justify-content-between align-items-center">
                    <div class="btn-group">
                    <a href="{{url('xem-truyen/'.$value->slug_truyen)}}" class="btn btn-sm btn-outline-secondary">Đọc ngay</a>
                    <a class="btn btn-sm btn-outline-secondary"><i class="fa-solid fa-eye"> 1</i></a>
                    </div>
                    <small class="text-muted">9 mins ago</small>
                </div>
                </div>
            </div>
            </div>
            @endforeach
            @endif
        </div> 
        {{-- <a class="btn btn-success" href="">Xem tất cả</a> --}}
        </div>
    </div>
    @endsection