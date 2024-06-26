<form action="{{ route('filter') }}" method="GET">
    <style type="text/css">
        .stylish_filter {
            border: 0;
            background: #12171b;
            color: #fff;
        }
    </style>
    <div class="col-md-2">
        <div class="form-group">
            <select class="form-control stylish_filter" name="order">
                <option value="">--Sắp xếp--</option>
                <option value="ngaytao">Ngày đăng</option>
                <option value="year">Năm sản xuất</option>
                <option value="title">Tên phim</option>
                <option value="topview">Lượt xem</option>
            </select>
        </div>
    </div>
    {{-- thể loại --}}
    <div class="col-md-2">
        <div class="form-group">
            <select class="form-control stylish_filter" name="genre">
                <option value="">--Thể Loại--</option>
                @foreach ($genre_home as $key => $gen_filter)
                    <option {{ isset($_GET['genre']) && $_GET['genre'] == $gen_filter->id ? 'selected' : '' }}
                        value="{{ $gen_filter->id }}">{{ $gen_filter->title }}</option>
                @endforeach
            </select>
        </div>
    </div>
    {{-- quốc gia --}}
    <div class="col-md-3">
        <div class="form-group">
            <select class="form-control stylish_filter" name="country">
                <option value="">--Quốc Gia--</option>
                @foreach ($country_home as $key => $country_filter)
                    <option {{ isset($_GET['country']) && $_GET['country'] == $country_filter->id ? 'selected' : '' }}
                        value="{{ $country_filter->id }}">{{ $country_filter->title }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            @php
                if (isset($_GET['year'])) {
                    $year = $_GET['year'];
                } else {
                    $year = null;
                }
            @endphp
            {!! Form::selectYear('year', 2006, 2030, $year, [
                'class' => 'form-control stylish_filter',
                'placeholder' => '--Năm Phim--',
            ]) !!}
        </div>
    </div>
    <input type="submit" class="btn btn-sm btn-default stylish_filter" value="lọc phim">
</form>
