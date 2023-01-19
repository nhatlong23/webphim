@extends('layouts.app')
@section('content')
    @if (Auth::id())
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">Quản lí info</div>
                        @if ($errors->any())
                            <div class="alert alert-danger" role="alert">
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
                            @if (isset($info))
                            {!! Form::open(['route' => ['info.update', $info->id], 'method' => 'PUT' ,'enctype' => 'multipart/form-data']) !!}

                            @endif
                            <div class="form-group">
                                {!! Form::label('title', 'Tiêu đề website', []) !!}
                                {!! Form::text('title', isset($info) ? $info->title : '', [
                                    'class' => 'form-control',
                                    'placeholder' => 'Nhập vào dữ liệu...',
                                    //'required',
                                ]) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('description', 'Mô tả website', []) !!}
                                {!! Form::textarea('description', isset($info) ? $info->description : '', [
                                    'style' => 'resize:none',
                                    'class' => 'form-control',
                                    'placeholder' => 'Nhập vào dữ liệu...',
                                    'id' => 'description',
                                    //'required',
                                ]) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('image', 'Hình ảnh logo', []) !!}
                                {!! Form::file('image', [
                                    'class' => 'form-control-file',
                                ]) !!}
                                @if (isset($info))
                                    <img src="{{ asset('uploads/logo/' . $info->logo) }}" width="150">
                                @endif
                            </div>
                            {!! Form::submit('Cập Nhật thông tin website', ['class' => 'btn btn-success']) !!}
                            {!! Form::close() !!}
                        </div>
                    </div>
                    {{-- <table class="table" id="tablemovie">
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
                                            'route' => ['info.destroy', $cate->id],
                                            'onsubmit' => 'return confirm("Xóa?")',
                                        ]) !!}
                                        {!! Form::submit('Xóa', ['class' => 'btn btn-danger']) !!}
                                        {!! Form::close() !!}
                                        <a href="{{ route('info.edit', $cate->id) }}" class="btn btn-warning">Sửa</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table> --}}
                </div>
            </div>
        </div>
    @else
        <script>
            window.location = "/login";
        </script>
    @endif
@endsection
