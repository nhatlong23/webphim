@extends('layouts.app')
@section('content')
    @if (Auth::id())
        <div class="card-header">Liệt Kê Leech Phim</div>
        <div class="table-responsive">
            <table class="table" id="tablemovie">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">name</th>
                        <th scope="col">origin_name</th>
                        {{-- <th scope="col">content</th> --}}
                        <th scope="col">type</th>
                        <th scope="col">status</th>
                        <th scope="col">thumb_url</th>
                        <th scope="col">trailer_url</th>
                        <th scope="col">time</th>
                        <th scope="col">episode_current</th>
                        <th scope="col">episode_total</th>
                        <th scope="col">quality</th>
                        <th scope="col">lang</th>
                        <th scope="col">notify</th>
                        <th scope="col">showtimes</th>
                        <th scope="col">slug</th>
                        <th scope="col">year</th>
                        <th scope="col">view</th>
                        <th scope="col">actor</th>
                        <th scope="col">director</th>
                        <th scope="col">category</th>
                        <th scope="col">country</th>
                        <th scope="col">is_copyright</th>
                        <th scope="col">chieurap</th>
                        <th scope="col">poster_url</th>
                        <th scope="col">sub_docquyen</th>
                    </tr>
                </thead>
                <tbody class="order_position">
                    @foreach ($resp_movie as $key => $res)
                        <tr  id="{{ $res['_id'] }}">
                            <th scope="row">{{ $key }}</th>
                            <td>{{ $res['name'] }}
                            @php
                                $movie = \App\Models\Movie::where('slug', $res['slug'])->first();
                            @endphp
                            @if (!$movie)
                                <form method="post" action="{{ route('leech-store', $res['slug']) }}">
                                    @csrf
                                    <input type="submit" class="btn btn-success" value="Thêm phim">
                                </form>
                            @else
                                <form method="post" action="{{ route('movie.destroy', $movie->id) }}">
                                    @csrf
                                    @method('delete')
                                    <input type="submit" class="btn btn-danger" value="Xóa phim">
                                </form>
                            @endif
                            </td>
                            <td>{{ $res['origin_name'] }}</td>
                            {{-- <td>{{ $res['content'] }}</td> --}}
                            <td>{{ $res['type'] }}</td>
                            <td>{{ $res['status'] }}</td>
                            <td><img src="{{ $res['thumb_url'] }}" width="80px" height="80px"></td>
                            <td>{{ $res['trailer_url'] }}</td>
                            <td>{{ $res['time'] }}</td>
                            <td>{{ $res['episode_current'] }}
                                <a href="{{ route('leech-episodes', $res['slug']) }}" class="btn btn-success">Tập phim</a>
                            </td>
                            <td>{{ $res['episode_total'] }}</td>
                            <td>{{ $res['quality'] }}</td>
                            <td>{{ $res['lang'] }}</td>
                            <td>{{ $res['notify'] }}</td>
                            <td>{!! $res['showtimes'] !!}</td>
                            <td>{{ $res['slug'] }}</td>
                            <td>{{ $res['year'] }}</td>
                            <td>{{ $res['view'] }}</td>
                            <td>
                                @foreach ($res['actor'] as $astor)
                                    <span class="badge badge-info">{{$astor}}</span>
                                @endforeach    
                            </td>
                            <td>
                                @foreach ($res['director'] as $director)
                                    <span class="badge badge-info">{{$director}}</span>
                                @endforeach  
                            </td>
                            <td>
                                @foreach ($res['category'] as $category)
                                    <span class="badge badge-info">{{$category['name']}}</span>
                                @endforeach  
                            </td>
                            <td>
                                @foreach ($res['country'] as $country)
                                    <span class="badge badge-info">{{$country['name']}}</span>
                                @endforeach  
                            </td>
                            <td>
                                @if ($res['is_copyright'] == true)
                                    <span class="badge badge-info">Có</span>
                                @else
                                    <span class="badge badge-info">Không</span>
                                @endif
                            </td>
                            <td>
                                @if ($res['chieurap'] == true)
                                    <span class="badge badge-info">Có</span>
                                @else
                                    <span class="badge badge-info">Không</span>
                                @endif    
                            </td>
                            <td><img src="{{ $res['poster_url'] }}" width="80px" height="80px"></td>
                            <td>
                                @if ($res['sub_docquyen'] == true)
                                    <span class="badge badge-info">Có</span>
                                @else
                                    <span class="badge badge-info">Không</span>
                                @endif    
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <script>
            window.location = "/login";
        </script>
    @endif
@endsection
