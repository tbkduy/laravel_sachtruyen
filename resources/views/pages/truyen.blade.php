@extends('../layout')
@section('content')
    <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{url('/')}}">Trang chủ</a></li>
        <li class="breadcrumb-item"><a href="{{url('danh-muc/'.$truyen->danhmuctruyen->slug_danhmuc)}}">{{$truyen->danhmuctruyen->tendanhmuc}}</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{$truyen->tentruyen}}</li>
    </ol>
    </nav>
    <div class="row">
        <div class="col-md-9">
            <div class="row">
                <div class="col-md-3">
                    <img class="card-img-top" src="{{asset('public/uploads/truyen/'.$truyen->hinhanh)}}">
                </div>
                <div class="col-md-9">
                    <ul class="infotruyen" style="list-style: none;"> <br>
                        <li>Tên truyện: {{$truyen->tentruyen}}</li>
                        <li>Tác giả: <strong>{{$truyen->tacgia}}</strong></li>
                        <li>Thể loại truyện: <a href="{{url('danh-muc/'.$truyen->danhmuctruyen->slug_danhmuc)}}">{{$truyen->danhmuctruyen->tendanhmuc}}</a></li>
                        {{-- <li>Thể loại: Trinh thám, cổ tích</li> --}}
                        <li>Số chapter: {{$truyen->chapter->count()}}</li>
                        <li>Số lượt xem: {{$truyen->chapter->sum("view")}}</li> <br>
                        {{-- <li><a href="#">Xem mục lục</a></li> --}}
                        @if($chapter_dau)
                        <li><a href="{{url('xem-chapter/'.$chapter_dau->slug_chapter)}}" class="btn btn-primary">Đọc Online</a></li>
                        @else
                        <li><button class="btn btn-danger">Hiện tại chưa có chương để đọc</button></li>
                        @endif
                    </ul>
                </div>
            </div> <br>
            <div class="col-md-12">
                <p>{{$truyen->tomtat}}</p>
            </div>
            <hr>
            <h4>Mục lục</h4>
            <ul class="mucluctruyen">
                @php 
                    $mucluc = count($chapter);
                @endphp
                @if($mucluc>0)
                    @foreach($chapter as $key => $chap)
                    <li><a href="{{url('xem-chapter/'.$chap->slug_chapter)}}">{{$chap->tieude}}</a> - <i class="fa-solid fa-eye"></i> {{$chap->view}}</li>
                    @endforeach
                @else
                    <li>Đang cập nhật...</li>
                @endif
            </ul>
            <h4>Truyện cùng danh mục</h4>
            <div class="row">
                @foreach($cungdanhmuc as $key => $value)
                <div class="col-md-3 d-flex">
                <div class="card shadow-sm">
                    <img class="card-img-top" src="{{asset('public/uploads/truyen/'.$value->hinhanh)}}" style="width: auto; height: 300px"> 
                    <div class="card-body">
                        <h4>{{$value->tentruyen}}</h4>
                    <p class="card-text">{{ Illuminate\Support\Str::words($value->tomtat, 20, '...') }}</p>
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="btn-group">
                        <a href="{{url('xem-truyen/'.$value->slug_truyen)}}" class="btn btn-sm btn-outline-secondary">Đọc ngay</a>
                        <a class="btn btn-sm btn-outline-secondary"><i class="fa-solid fa-eye"> 1</i></a>
                        </div>
                        <small class="text-muted">1 mins ago</small>
                    </div>
                    </div>
                </div>
                </div>
                @endforeach
            </div>
        </div>
        <div class="col-md-3"> 
            <h3>Truyện được đề xuất</h3> 
            <div class="row mt-2">
                @foreach($cungdanhmuc as $key => $value)
                <div class="col-md-12">
                <div class="card shadow-sm">
                     <img class="card-img-top" src="{{asset('public/uploads/truyen/'.$value->hinhanh)}}" style="width: auto" height="400px"> 
                    <div class="card-body"> 
                        <h4>{{$value->tentruyen}}</h4>
                        <p class="card-text">{{ Illuminate\Support\Str::words($value->tomtat, 20, '...') }}</p>
                        <div class="d-flex justify-content-between align-items-center">
                        <div class="btn-group">
                        <a href="{{url('xem-truyen/'.$value->slug_truyen)}}" class="btn btn-sm btn-outline-secondary">Đọc ngay</a>
                        <a class="btn btn-sm btn-outline-secondary"><i class="fa-solid fa-eye"> 1</i></a>
                        </div>
                        <small class="text-muted">1 mins ago</small>
                        </div>
                    </div>
                </div> 
                </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection