@extends('layouts.app')
@section('content')
    @if (Auth::id())
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        @if (!isset($category))
                            <div class="card-header">Thêm Danh Mục</div>
                        @else
                            <div class="card-header">Cập Nhật Danh Mục</div>
                        @endif
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
                            @if (!isset($category))
                                {!! Form::open(['route' => 'category.store', 'method' => 'POST']) !!}
                            @else
                                {!! Form::open(['route' => ['category.update', $category->id], 'method' => 'PUT']) !!}
                            @endif
                            <div class="form-group">
                                {!! Form::label('title', 'Title', []) !!}
                                {!! Form::text('title', isset($category) ? $category->title : '', [
                                    'class' => 'form-control',
                                    'placeholder' => 'Nhập vào dữ liệu...',
                                    'id' => 'slug',
                                    'onkeyup' => 'ChangeToSlug()',
                                    //'required',
                                ]) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('slug', 'Slug', []) !!}
                                {!! Form::text('slug', isset($category) ? $category->slug : '', [
                                    'class' => 'form-control',
                                    'placeholder' => 'Nhập vào dữ liệu...',
                                    'id' => 'convert_slug',
                                ]) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('description', 'Description', []) !!}
                                {!! Form::textarea('description', isset($category) ? $category->description : '', [
                                    'style' => 'resize:none',
                                    'class' => 'form-control',
                                    'placeholder' => 'Nhập vào dữ liệu...',
                                    'id' => 'description',
                                    //'required',
                                ]) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('status', 'Status', []) !!}
                                {!! Form::select('status', ['1' => 'Hiển thị', '0' => 'Không'], isset($category) ? $category->status : '', [
                                    'class' => 'form-control',
                                ]) !!}
                            </div>
                            @if (!isset($category))
                                {!! Form::submit('Thêm dữ liệu', ['class' => 'btn btn-primary']) !!}
                            @else
                                {!! Form::submit('Cập Nhật', ['class' => 'btn btn-success']) !!}
                            @endif
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        <script>
            window.location = "/login";
        </script>
    @endif
@endsection
