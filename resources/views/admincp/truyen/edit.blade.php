@extends('layouts.app')

@section('content')

@include('layouts.nav')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Cập nhật truyện') }}</div>
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{route('truyen.update',[$truyen->id])}}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Tên truyện</label>
                            <input type="text" class="form-control" value="{{$truyen->tentruyen}}" onkeyup="ChangeToSlug();" name="tentruyen" id="slug"
                            aria-describedby="emailHelp" placeholder="Tên truyện..."> <br>

                            <label for="exampleInputEmail1" class="form-label">Tác giả</label>
                            <input type="text" class="form-control" value="{{$truyen->tacgia}}" name="tacgia" id="slug"
                            aria-describedby="emailHelp" placeholder="Tên truyện..."> <br>

                            <label for="exampleInputEmail1" class="form-label">Slug truyện</label>
                            <input type="text" class="form-control" value="{{$truyen->slug_truyen}}" name="slug_truyen" id="convert_slug" 
                            aria-describedby="emailHelp" placeholder="Slug truyện..."> <br>

                            <label for="exampleInputEmail1" class="form-label">Tóm tắt truyện</label>
                            <textarea name="tomtat" class="form-control" rows="5" style="resize: none;">{{$truyen->tomtat}}</textarea> <br>
                            
                            <div class="form-group">
                                <label for="exampleInputEmail">Danh mục truyện</label>
                                <select name="danhmuc" class="form-select" aria-label="Default select example">
                                @foreach($danhmuc as $key => $muc)
                                <option {{$muc->id==$truyen->danhmuc_id ? 'selected' : '' }} value="{{$muc->id}}">{{$muc->tendanhmuc}}</option>
                                @endforeach
                                </select> <br>
                            </div> 
                            
                            <label for="exampleInputEmail1" class="form-label">Hình ảnh truyện</label> <br>
                            <input type="file" class="form-control-file" name="hinhanh"> <br> <br>
                            <h6>Ảnh cũ</h6>
                            <img src="{{asset('public/uploads/truyen/'.$truyen->hinhanh)}}" height="auto" width="100"> <br> <br>

                            <div class="form-group">
                                <label for="exampleInputEmail">Kích hoạt</label>
                                <select name="kichhoat" class="form-select" aria-label="Default select example">
                                @if($truyen->kichhoat==0)
                                    <option selected value="0">Kích hoạt</option>
                                    <option value="1">Không kích hoạt</option>
                                    @else
                                    <option value="0">Kích hoạt</option>
                                    <option selected value="1">Không kích hoạt</option>
                                    @endif
                                </select> 
                            </div> 
                        </div>                
                        <button type="submit" name="themtruyen" class="btn btn-primary">Cập nhật truyện</button>
                    </form>                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
