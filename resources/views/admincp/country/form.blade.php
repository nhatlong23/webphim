@extends('layouts.app')
@section('content')
    @if (Auth::id())
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
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
                            @if (!isset($country))
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
