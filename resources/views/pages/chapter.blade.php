@extends('../layout')
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">Trang chủ</a></li>
            <li class="breadcrumb-item"><a
                    href="{{ url('danh-muc/' . $truyen_breadcumb->danhmuctruyen->slug_danhmuc) }}">{{ $truyen_breadcumb->danhmuctruyen->tendanhmuc }}</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">{{ $truyen_breadcumb->tentruyen }}</li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-md-12">
            <h4>{{ $chapter->truyen->tentruyen }}</h4>
            <p>Chương hiện tại: {{ $chapter->tieude }}</p>
            <div class="col-md-5">
                <style>
                    .isDisabled {
                        color: currentColor;
                        pointer-events: none;
                        opacity: 0.5;
                        text-decoration: none
                    }
                </style>
                <a href="{{ url('xem-chapter/' . $previous_chapter) }}"
                    class="btn btn-primary {{ $chapter->id == $min_id->id ? 'isDisabled' : '' }}">Chương trước</a>
                <a href="{{ url('xem-chapter/' . $next_chapter) }}"
                    class="btn btn-primary {{ $chapter->id == $max_id->id ? 'isDisabled' : '' }}">Chương sau</a> <br> <br>
                <div class="form-group">
                    <label for="">Chọn chương</label>
                    <select name="select-chapter" class="form-select select-chapter" aria-label="Default select example">
                        @foreach ($all_chapter as $key => $chap)
                            <option value="{{ url('xem-chapter/' . $chap->slug_chapter) }}">{{ $chap->tieude }}</option>
                        @endforeach
                    </select>
                </div>
            </div> <br>
            <div class="noidungchuong">
                {!! $chapter->noidung !!}
            </div>
            <a href="{{ url('xem-chapter/' . $previous_chapter) }}"
                class="btn btn-primary {{ $chapter->id == $min_id->id ? 'isDisabled' : '' }}">Chương trước</a>
            <a href="{{ url('xem-chapter/' . $next_chapter) }}"
                class="btn btn-primary {{ $chapter->id == $max_id->id ? 'isDisabled' : '' }}">Chương sau</a>
        </div>
    @endsection
