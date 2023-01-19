@extends('layouts.app')
@section('content')
    @if (Auth::id())

        <div class="card-header">Liệt Kê Danh Mục</div>
        <table class="table" id="tablemovie">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Title</th>
                    <th scope="col">Description</th>
                    <th scope="col">Active/Inactive</th>
                    <th scope="col">Manage</th>
                </tr>
            </thead>
            <tbody class="order_position">
                @foreach ($linkmovie as $key => $movielink)
                    <tr>
                        <th scope="row">{{ $key }}</th>
                        <td>{{ $movielink->title }}</td>
                        <td>{{ $movielink->description }}</td>
                        <td>
                            @if ($movielink->status)
                                Hiển thị
                            @else
                                Không Hiển thị
                            @endif
                        </td>
                        <td>
                            {!! Form::open([
                                'method' => 'DELETE',
                                'route' => ['linkmovie.destroy', $movielink->id],
                                'onsubmit' => 'return confirm("Xóa?")',
                            ]) !!}
                            {!! Form::submit('Xóa', ['class' => 'btn btn-danger']) !!}
                            {!! Form::close() !!}
                            <a href="{{ route('linkmovie.edit', $movielink->id) }}" class="btn btn-warning">Sửa</a>
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
