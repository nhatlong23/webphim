@extends('layouts.app')
@section('content')
    @if (Auth::id())
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#banner_quangcao">
            Thêm Quốc Gia
        </button>

        <!-- Modal -->
        <div class="modal fade" id="banner_quangcao" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-header">Thêm Quốc Gia Phim</div>

                                        <div class="card-body">
                                            @if (session('status'))
                                                <div class="alert alert-success" role="alert">
                                                    {{ session('status') }}
                                                </div>
                                            @endif
                                            @if (!isset($country))
                                                {!! Form::open(['route' => 'country.store', 'method' => 'POST']) !!}
                                            @else
                                                {!! Form::open(['route' => ['country.update', $country->id], 'method' => 'PUT']) !!}
                                            @endif
                                            <div class="form-group">
                                                {!! Form::label('title', 'Title', []) !!}
                                                {!! Form::text('title', isset($country) ? $country->title : '', [
                                                    'class' => 'form-control',
                                                    'required',
                                                    'placeholder' => 'Nhập vào dữ liệu...',
                                                    'id' => 'slug',
                                                    'onkeyup' => 'ChangeToSlug()',
                                                ]) !!}
                                            </div>
                                            <div class="form-group">
                                                {!! Form::label('slug', 'Slug', []) !!}
                                                {!! Form::text('slug', isset($country) ? $country->slug : '', [
                                                    'class' => 'form-control',
                                                    'placeholder' => 'Nhập vào dữ liệu...',
                                                    'id' => 'convert_slug',
                                                ]) !!}
                                            </div>
                                            <div class="form-group">
                                                {!! Form::label('description', 'Description', []) !!}
                                                {!! Form::textarea('description', isset($country) ? $country->description : '', [
                                                    'style' => 'resize:none',
                                                    'class' => 'form-control',
                                                    'placeholder' => 'Nhập vào dữ liệu...',
                                                    'id' => 'description',
                                                    'required',
                                                ]) !!}
                                            </div>
                                            <div class="form-group">
                                                {!! Form::label('status', 'Status', []) !!}
                                                {!! Form::select('status', ['1' => 'Hiển thị', '0' => 'Không'], isset($country) ? $country->status : '', [
                                                    'class' => 'form-control',
                                                ]) !!}
                                            </div>
                                            {{-- @if (!isset($country))
                                                {!! Form::submit('Thêm dữ liệu', ['class' => 'btn btn-primary']) !!}
                                            @else
                                                {!! Form::submit('Cập Nhật', ['class' => 'btn btn-success']) !!}
                                            @endif --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        {!! Form::submit('Thêm dữ liệu', ['class' => 'btn btn-primary']) !!}
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
        <div class="card-header">Liệt Kê Quốc Gia Phim</div>
        <table class="table" id="tablemovie">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Title</th>
                    <th scope="col">Description</th>
                    <th scope="col">Slug</th>
                    <th scope="col">Active/Inactive</th>
                    <th scope="col">Manage</th>
                </tr>
            </thead>
            <tbody class="order_position">
                @foreach ($list as $key => $cate)
                    <tr id="{{ $cate->id }}">
                        <th scope="row">{{ $key }}</th>
                        <td>{{ $cate->title }}</td>
                        <td>{{ $cate->description }}</td>
                        <td>{{ $cate->slug }}</td>
                        <td>
                            @if ($cate->status)
                                Hiển thị
                            @else
                                Không Hiển thị
                            @endif
                        </td>
                        <td>
                            {!! Form::open([
                                'method' => 'DELETE',
                                'route' => ['country.destroy', $cate->id],
                                'onsubmit' => 'return confirm("Xóa?")',
                            ]) !!}
                            {!! Form::submit('Xóa', ['class' => 'btn btn-danger']) !!}
                            {!! Form::close() !!}
                            <a href="{{ route('country.edit', $cate->id) }}" class="btn btn-warning">Sửa</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <script>
            window.location = "/login";
        </script>
    @endif
@endsection
