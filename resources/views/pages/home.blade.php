@extends('../layout')
@section('slide')
    @include('pages.slide')
@endsection
@section('content')
<h2>Tổng hợp các truyện</h2>
    <div class="album py-5 bg-light">
        <div class="container">
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
            @foreach($truyen as $key => $value)
            <div class="col-md-3 d-flex">
            <div class="card shadow-sm">
                <img class="card-img-top" src="{{asset('public/uploads/truyen/'.$value->hinhanh)}}" style="width: auto; height: 400px">
                <div class="card-body">
                    <h4>{{$value->tentruyen}}</h4>
                <p class="card-text">{{ $value->limit_desc }}</p>
                {{-- <p class="card-text">{{ Illuminate\Support\Str::words($value->tomtat, 25, '...') }}</p> --}}
                <div class="d-flex justify-content-between align-items-center">
                    <div class="btn-group">
                    <a href="{{url('xem-truyen/'.$value->slug_truyen)}}" class="btn btn-sm btn-outline-secondary">Đọc ngay</a>
                    <a class="btn btn-sm btn-outline-secondary"><i class="fa-solid fa-eye"> {{$value->chapter->sum("view")}}</i></a>
                    </div>
                    {{-- Hiển thị thời gian update lần cuối --}}
                    <small class="text-muted"> {{$value->updated_at->diffForHumans()}}</small> 
                </div>
                </div>
            </div>
            </div>
            @endforeach
        </div> <br>
        <div class="d-flex justify-content-center">
            {{ $truyen->links() }}
        </div>
        </div>
    </div>
    @endsection