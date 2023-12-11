@extends('layouts.app')
@section('content')
    @if (Auth::id())
        @if ($errors->any())
            <div class="alert alert-danger" role="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div id="main-wrapper" data-layout="vertical" data-navbarbg="skin5" data-sidebartype="full"
            data-sidebar-position="absolute" data-header-position="absolute" data-boxed-layout="full">
            <div class="page-wrapper">
                <div class="container-fluid">
                    <div class="row">
                        <style>
                            .picture-container {
                                position: relative;
                                cursor: pointer;
                                text-align: center;
                            }

                            .picture {
                                width: 106px;
                                height: 106px;
                                background-color: #999999;
                                border: 4px solid #cccccc;
                                color: #ffffff;
                                border-radius: 50%;
                                margin: 5px auto;
                                overflow: hidden;
                                transition: all 0.2s;
                                -webkit-transition: all 0.2s;
                            }

                            .picture-src {
                                width: 100%;
                                height: 100%;
                            }

                            .picture:hover {
                                border-color: #4caf50;
                            }

                            .picture input[type="file"] {
                                cursor: pointer;
                                display: block;
                                height: 100%;
                                left: 0;
                                opacity: 0 !important;
                                position: absolute;
                                top: 0;
                                width: 100%;
                            }

                            .choice {
                                text-align: center;
                                cursor: pointer;
                            }

                            .choice input[type="radio"],
                            .choice input[type="checkbox"] {
                                position: absolute;
                                left: -10000px;
                                z-index: -1;
                            }

                            .choice .icon {
                                text-align: center;
                                vertical-align: middle;
                                height: 106px;
                                width: 106px;
                                border-radius: 50%;
                                color: #999999;
                                margin: 5px auto;
                                border: 4px solid #cccccc;
                                transition: all 0.2s;
                                -webkit-transition: all 0.2s;
                                overflow: hidden;
                            }

                            .choice .icon:hover {
                                border-color: #4caf50;
                            }

                            .choice.active .icon {
                                border-color: #2ca8ff;
                            }
                        </style>
                        {!! Form::open([
                            'route' => ['update-profile-admin', $admin->id],
                            'method' => 'PUT',
                            'enctype' => 'multipart/form-data',
                        ]) !!}
                        <div class="col-lg-2">
                            {!! Form::label('avatar', 'Hình ảnh', []) !!}
                            <div class="picture-container hight">
                                <div class="picture">
                                    <img src="{{ $admin->avatar }}" class="picture-src" id="wizardPicturePreview"
                                        title="" />
                                    <input type="file" name="avatar" id="wizard-picture" aria-invalid="false"
                                        class="valid" accept="image/*" />
                                </div>
                                <h5>Chọn hình ảnh</h5>
                                <h6>
                                    @if ($admin->roles == 0)
                                        Super Admin
                                    @endif
                                </h6>
                            </div>
                        </div>
                        <div class="col-lg-9">
                            <div class="card">
                                <div class="card-body">
                                    <div class="form-group">
                                        {!! Form::label('name', 'Tên Admin', []) !!}
                                        {!! Form::text('name', isset($admin) ? $admin->name : '', [
                                            'class' => 'form-control',
                                            'placeholder' => 'longNguyenAdmin...',
                                            'autocomplete' => 'off',
                                        ]) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('email', 'Email', []) !!}
                                        {!! Form::text('email', isset($admin) ? $admin->email : '', [
                                            'class' => 'form-control',
                                            'placeholder' => 'johnathan@admin.com...',
                                            'autocomplete' => 'off',
                                            'readonly' => isset($admin) ? 'readonly' : null,
                                        ]) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('phone_number', 'Số điện thoại', []) !!}
                                        {!! Form::text('phone_number', isset($admin) ? $admin->phone_number : '', [
                                            'class' => 'form-control',
                                            'placeholder' => '123 456 7890...',
                                            'autocomplete' => 'off',
                                        ]) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('address', 'Địa chỉ', []) !!}
                                        {!! Form::text('address', isset($admin) ? $admin->address : '', [
                                            'class' => 'form-control',
                                            'placeholder' => 'K103/6, BÌnh thái 1',
                                            'autocomplete' => 'off',
                                        ]) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('old_password', 'Mật khẩu hiện tại', []) !!}
                                        {!! Form::password('old_password', [
                                            'class' => 'form-control',
                                            'placeholder' => '*********',
                                            'autocomplete' => 'off',
                                        ]) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('new_password', 'Mật khẩu mới', []) !!}
                                        {!! Form::password('new_password', [
                                            'class' => 'form-control',
                                            'placeholder' => '*********',
                                            'autocomplete' => 'off',
                                        ]) !!}
                                    </div>

                                    <div class="form-group">
                                        {!! Form::label('confirm_password', 'Nhập lại mật khẩu mới', []) !!}
                                        {!! Form::password('confirm_password', [
                                            'class' => 'form-control',
                                            'placeholder' => '*********',
                                            'autocomplete' => 'off',
                                        ]) !!}
                                    </div>

                                    {!! Form::submit('Cập Nhật', [
                                        'class' => 'btn btn-success',
                                    ]) !!}
                                    {!! Form::close() !!}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-header">Liệt Kê Các Admin</div>
                    <table class="table" id="tablemovie">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Avatar</th>
                                <th scope="col">Tên</th>
                                <th scope="col">Email</th>
                                <th scope="col">Địa chỉ</th>
                                <th scope="col">Số điện thoại</th>
                                <th scope="col">Locked</th>
                                <th scope="col">Quyền hạn</th>
                                <th scope="col">Ngày tạo</th>
                                <th scope="col">Ngày cập nhật</th>
                            </tr>
                        </thead>
                        <tbody class="order_position">
                            @foreach ($all_admin as $key => $admin)
                                <tr id="{{ $admin->id }}">
                                    <th scope="row">{{ $key }}</th>
                                    <td>
                                        <div class="picture-container hight">
                                            <div class="picture">
                                                <img src="{{ $admin->avatar }}" class="picture-src" title="" />
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ $admin->name }}</td>
                                    <td>{{ $admin->email }}</td>
                                    <td>{{ $admin->address }}</td>
                                    <td>{{ $admin->phone_number }}</td>
                                    <td>
                                        <form method="POST">
                                            @csrf
                                            {!! Form::select(
                                                'locked',
                                                [
                                                    '0' => 'Hoạt động',
                                                    '1' => 'Khóa',
                                                ],
                                                isset($admin) ? $admin->locked : '',
                                                [
                                                    'class' => 'select-locked',
                                                    'id' => $admin->id,
                                                ],
                                            ) !!}
                                        </form>
                                    </td>
                                    <td>
                                        <form method="POST">
                                            @csrf
                                            {!! Form::select(
                                                'roles',
                                                [
                                                    '1' => 'Admin',
                                                    '2' => 'Author',
                                                ],
                                                isset($admin) ? $admin->roles : '',
                                                [
                                                    'class' => 'select-roles',
                                                    'id' => $admin->id,
                                                ],
                                            ) !!}
                                        </form>
                                    </td>
                                    <td>{{ $admin->created_at }}</td>
                                    <td>{{ $admin->updated_at }}</td>
                                    <td>
                                        {!! Form::open([
                                            'method' => 'POST',
                                            'route' => ['delete-admin', $admin->id],
                                            'onsubmit' => 'return confirm("Bạn có chắc chắn muốn Xóa ' . ($admin->roles === 1 ? 'Admin' : 'Author') . ' này không?")',
                                        ]) !!}
                                        @csrf
                                        @method('DELETE')
                                        {!! Form::submit('Xóa', ['class' => 'btn btn-danger']) !!}
                                        {!! Form::close() !!}
                                    </td>
                                    </tr>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        </div>
        <script>
            $("#wizard-picture").change(function() {
                readURL(this);
            });

            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        $("#wizardPicturePreview").attr("src", e.target.result).fadeIn("slow");
                    };
                    reader.readAsDataURL(input.files[0]);
                }
            }
        </script>
        <script type="text/javascript">
            $('.select-roles').change(function() {
                var admin_id = $(this).attr('id');
                var roles = $(this).val();
                var _token = $('input[name="_token"]').val();

                $.ajax({
                    url: "/update-role-admin",
                    method: "POST",
                    data: {
                        admin_id: admin_id,
                        roles: roles,
                        _token: _token
                    },
                    success: function(data) {
                        alert('Thay đổi quyền thành công');
                    }
                });
            })
        </script>
        <script type="text/javascript">
            $('.select-locked').change(function() {
                var admin_id = $(this).attr('id');
                var locked = $(this).val();
                var _token = $('input[name="_token"]').val();

                $.ajax({
                    url: "/update-locked-admin",
                    method: "POST",
                    data: {
                        admin_id: admin_id,
                        locked: locked,
                        _token: _token
                    },
                    success: function(data) {
                        alert('Thay đổi quyền hoạt động thành công');
                    }
                });
            })
        </script>
    @else
        <script>
            window.location = "/login";
        </script>
    @endif
@endsection
