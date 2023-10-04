                    @if (Auth::id())
            <div class="modal" id="episode" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="episode_title"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p id="content_episode_title"></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <p id="button_save_episode"></p>
                    </div>
                </div>
            </div>
        </div>
                    <div class="table-responsive">
                        <table class="table table-responsive" id="">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Manage</th>
                                    <th scope="col">Tên phim</th>
                                    <th scope="col">Thêm Phim</th>
                                    <th scope="col">Hình ảnh</th>
                                    <th scope="col">Thuộc phim</th>
                                    <th scope="col">Season</th>
                                    <th scope="col">Năm Phim</th>
                                    <th scope="col">Danh mục</th>
                                    <th scope="col">Ngày cập nhập</th>
                                    <th scope="col">Ngày tạo</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($movies as $key => $cate)
                                    <tr>
                                        <th scope="row">{{ $key }}</th>
                                        <td>
                                            <a href="{{ route('movie.edit', $cate->id) }}" class="btn btn-warning">Sửa</a>
                                            {!! Form::open([
                                                'method' => 'DELETE',
                                                'route' => ['movie.destroy', $cate->id],
                                                'onsubmit' => 'return confirm("Xóa?")',
                                            ]) !!}
                                            {!! Form::submit('Xóa', ['class' => 'btn btn-danger']) !!}
                                            {!! Form::close() !!}
                                        </td>
                                        <td>
                                            <span class="badge badge-success">{{ $cate->title }}</span> <br>
                                        </td>
                                        <td>
                                            <span><a href="{{ route('leech-episodes', $cate->slug) }}" class="btn btn-success">Tập phim api</a></span>
                                            <a href="{{ route('add-episode', [$cate->id]) }}" class="btn btn-danger btn-sm">Thêm Tập Phim bằng tay</a>
                                        </td>
                                        <td>
                                            @php
                                                $image_check = substr($cate->image, 0, 4);
                                            @endphp
                                            <img src="{{ (strpos($cate->image, 'http') === 0) ? $cate->image : asset('uploads/movie/' . $cate->image) }}" width="65">
                                            <span class="badge badge-success">{{ $cate->episode_count }} / {{ $cate->episodes }} tập</span> <br>
                                            <span class="badge badge-primary">{{ $cate->duration_movie }}</span> <br>
                                        </td>
                                        <td>
                                            <span> Thuộc phim </span>
                                        </td>
                                        <td>
                                            <span> Session </span>
                                        </td>
                                        <td>
                                            <span> Năm phim </span>
                                        </td>
                                        <td>
                                            <span> Danh mục </span>
                                        </td>
                                        <td>
                                            <span> Ngày tạo </span>
                                        </td>
                                        <td>
                                            <span> Ngày cập nhật </span>
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