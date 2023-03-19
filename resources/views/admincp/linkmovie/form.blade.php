@extends('layouts.app')
@section('content')
    @if (Auth::id())
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">Thêm Server Phim</div>
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
                            @if (!isset($linkmovie))
                                {!! Form::open(['route' => 'linkmovie.store', 'method' => 'POST']) !!}
                            @else
                                {!! Form::open(['route' => ['linkmovie.update', $linkmovie->id], 'method' => 'PUT']) !!}
                            @endif
                            <div class="form-group">
                                {!! Form::label('title', 'Link', []) !!}
                                {!! Form::text('title', isset($linkmovie) ? $linkmovie->title : '', [
                                    'class' => 'form-control',
                                    'placeholder' => 'Nhập vào dữ liệu...',
                                    //'required',
                                ]) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('description', 'Description', []) !!}
                                {!! Form::textarea('description', isset($linkmovie) ? $linkmovie->description : '', [
                                    'style' => 'resize:none',
                                    'class' => 'form-control',
                                    'placeholder' => 'Nhập vào dữ liệu...',
                                    'id' => 'description',
                                    //'required',
                                ]) !!}
                            </div>
                            <div class="form-group">
                                {!! Form::label('status', 'Status', []) !!}
                                {!! Form::select('status', ['1' => 'Hiển thị', '0' => 'Không'], isset($linkmovie) ? $linkmovie->status : '', [
                                    'class' => 'form-control',
                                ]) !!}
                            </div>
                            @if (!isset($linkmovie))
                                {!! Form::submit('Thêm Link', ['class' => 'btn btn-primary']) !!}
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
