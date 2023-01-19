@extends('layouts.app')
@section('content')
    @if (Auth::id())
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
                                    <td><img src="{{ asset('uploads/movie/' . $episode->movie->image) }}" width="100">
                                    </td>
                                    <td>{{ $episode->episode }}</td>
                                    <td>
                                        <style type="text/css">
                                            .iframe-phim iframe {
                                                width: 560;
                                                height: 315;
                                            }
                                        </style>
                                        <div class="iframe-phim">
                                            {!! $episode->linkphim !!}
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
