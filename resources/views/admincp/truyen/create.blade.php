@extends('layouts.app')

@section('content')

@include('layouts.nav')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Thêm truyện') }}</div>
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

                    <form method="POST" action="{{route('truyen.store')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Tên truyện</label>
                            <input type="text" class="form-control" value="{{old('tentruyen')}}" onkeyup="ChangeToSlug();" name="tentruyen" id="slug"
                            aria-describedby="emailHelp" placeholder="Tên truyện..."> <br>

                            <label for="exampleInputEmail1" class="form-label">Tác giả</label>
                            <input type="text" class="form-control" value="{{old('tacgia')}}" name="tacgia" id="slug"
                            aria-describedby="emailHelp" placeholder="Tác giả..."> <br>

                            <label for="exampleInputEmail1" class="form-label">Slug truyện</label>
                            <input type="text" class="form-control" value="{{old('slug_truyen')}}" name="slug_truyen" id="convert_slug" 
                            aria-describedby="emailHelp" placeholder="Slug truyện..."> <br>

                            <label for="exampleInputEmail1" class="form-label">Tóm tắt truyện</label>
                            <textarea class="form-control" rows="5" style="resize: none;" name="tomtat"></textarea> <br>
                            
                            <div class="form-group">
                                <label for="exampleInputEmail">Danh mục truyện</label>
                                <select name="danhmuc" class="form-select" aria-label="Default select example">
                                @foreach($danhmuc as $key => $muc)
                                <option value="{{$muc->id}}">{{$muc->tendanhmuc}}</option>
                                @endforeach
                                </select> <br>
                            </div> 
                            
                            <label for="exampleInputEmail1" class="form-label">Hình ảnh truyện</label> <br>
                            <input type="file" class="form-control-file" name="hinhanh"> <br> <br>

                            <div class="form-group">
                                <label for="exampleInputEmail">Kích hoạt</label>
                                <select name="kichhoat" class="form-select" aria-label="Default select example">
                                <option value="0">Kích hoạt</option>
                                <option value="1">Không kích hoạt</option>
                                </select> 
                            </div> 
                        </div>                
                        <button type="submit" name="themtruyen" class="btn btn-primary">Thêm</button>
                    </form>                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
