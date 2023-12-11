@extends('layouts.app')
@section('content')
    @if (Auth::id())
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <a href="{{ route('episode.index') }}" class="btn btn-primary">Liệt kê danh sách tập phim</a>
                        <div class="card-header">Quản lí tập Phim</div>
                        <div class="card-body">
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif
                            @if (!isset($episode))
                                {!! Form::open(['route' => 'episode.store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                            @else
                                {!! Form::open([
                                    'route' => ['episode.update', $episode->id],
                                    'method' => 'PUT',
                                    'enctype' => 'multipart/form-data',
                                ]) !!}
                            @endif

                            <div class="form-group">
                                {!! Form::label('movie_title', 'Phim', []) !!}
                                {!! Form::text('movie_title', isset($movie) ? $movie->title : '', [
                                    'class' => 'form-control',
                                    'readonly',
                                    'required',
                                ]) !!}
                                {!! Form::hidden('movie_id', isset($movie) ? $movie->id : '', []) !!}
                            </div>

                            <div class="form-group">
                                {!! Form::label('link', 'Link Phim', []) !!}
                                {!! Form::text(
                                    'link',
                                    '<p><iframe allowfullscreen frameborder="0" height="360" scrolling="0" src="..." width="100%"></iframe></p>',
                                    [
                                        'class' => 'form-control',
                                        'required',
                                        'id' => 'link-input',
                                    ],
                                ) !!}
                            </div>

                            @if (!isset($episode))
                                <div class="form-group">
                                    {!! Form::label('episode', 'Tập Phim', []) !!}
                                    {!! Form::select('episode', $episodeOptions, null, [
                                        'class' => 'form-control',
                                    ]) !!}
                                </div>
                            @else
                                <div class="form-group">
                                    {!! Form::label('episode', 'Tập Phim', []) !!}
                                    {!! Form::text('episode', isset($episode) ? $episode->episode : '', [
                                        'class' => 'form-control',
                                        'placeholder' => 'Nhập vào dữ liệu...',
                                        isset($episode) ? 'readonly' : '',
                                    ]) !!}
                                </div>
                            @endif

                            <div class="form-group">
                                {!! Form::label('linkserver', 'LinkServer', []) !!}
                                {!! Form::select('linkserver', $linkmovie, '', [
                                    'class' => 'form-control',
                                ]) !!}
                            </div>
                            @if (!isset($episode))
                                {!! Form::submit('Thêm Tập Phim', ['class' => 'btn btn-primary']) !!}
                            @else
                                {!! Form::submit('Cập Nhật', ['class' => 'btn btn-success']) !!}
                            @endif
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- Quan ly phim --}}
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">

                    <table class="table" id="tablemovie">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Tên phim</th>
                                <th scope="col">Hình ảnh phim</th>
                                <th scope="col">Tập Phim</th>
                                <th scope="col">Link Phim</th>
                                <th scope="col">Server Phim</th>
                                {{-- <th scope="col">Active/Inactive</th> --}}
                                <th scope="col">Manage</th>
                            </tr>
                        </thead>
                        <tbody class="order_positionn">
                            @foreach ($list_episode as $key => $episode)
                                <tr id="{{ $episode->id }}">
                                    <th scope="row">{{ $key }}</th>
                                    <td>{{ $episode->movie->title }}</td>
                                    @php
                                        $image_check = substr($episode->movie->image, 0, 4);
                                    @endphp
                                    <td>
                                        @if ($image_check == 'http')
                                            <img src="{{ $episode->movie->image }}" width="100">
                                        @else
                                            <img src="{{ asset('uploads/movie/' . $episode->movie->image) }}"
                                                width="100">
                                        @endif
                                    </td>
                                    <td>Tập {{ $episode->episode }}</td>
                                    <td>
                                        <style type="text/css">
                                            .iframe-phim iframe {
                                                width: 560;
                                                height: 315;
                                            }
                                        </style>
                                        <div class="iframe-phim">
                                            {{ $episode->linkphim }}
                                        </div>
                                    </td>
                                    <td>
                                        @foreach ($list_server as $key => $server_link)
                                            @if ($episode->server == $server_link->id)
                                                {{ $server_link->title }}
                                            @endif
                                        @endforeach
                                    </td>
                                    <td>
                                        {!! Form::open([
                                            'method' => 'DELETE',
                                            'route' => ['episode.destroy', $episode->id],
                                            'onsubmit' => 'return confirm("Xóa?")',
                                        ]) !!}
                                        {!! Form::submit('Xóa', ['class' => 'btn btn-danger']) !!}
                                        {!! Form::close() !!}
                                        <a href="{{ route('episode.edit', $episode->id) }}" class="btn btn-warning">Sửa</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @else
        <script>
            window.location = "/login";
        </script>
    @endif
@endsection
