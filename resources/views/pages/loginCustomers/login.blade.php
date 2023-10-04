<!doctype html>
<html class="no-js" lang="">
<head>
	<meta charset="utf-8">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<title>{{ $meta_title }}</title>
	<meta name="description" content="{{ $meta_description }}">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" type="image/x-icon" href="{{ asset('uploads/logo/' . $info->logo) }}">
	<link rel="stylesheet" href="{{asset('loginCustomer/css/bootstrap.min.css')}}">
	<link rel="stylesheet" href="{{asset('loginCustomer/css/fontawesome-all.min.css')}}">
	<link rel="stylesheet" href="{{asset('loginCustomer/font/flaticon.css')}}">
	<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&amp;display=swap" rel="stylesheet">
	<link rel="stylesheet" href="{{asset('loginCustomer/style.css')}}">
</head>

<body>
    <div id="preloader" class="preloader">
        <div class='inner'>
            <div class='line1'></div>
            <div class='line2'></div>
            <div class='line3'></div>
        </div>
    </div>
	<div id="wrapper" class="wrapper">
		<div class="fxt-template-animation fxt-template-layout5">
			<div class="fxt-bg-img fxt-none-767" data-bg-image="{{asset('loginCustomer/img/figure/bg5-l.jpg')}}">
				<div class="fxt-intro">
					<div class="sub-title">Chào mừng các bạn đã đến với trang đăng nhập</div>
					<h1>Phimmoi48h</h1>
					<p>"Tại trang web xem phim của chúng tôi, bạn sẽ tìm thấy hàng trăm bộ phim và chương trình truyền hình đa dạng,
                    được cập nhật liên tục. Hãy thư giãn và thưởng thức những giây phút giải trí tuyệt vời cùng chúng tôi! 😘😘😘"</p>
				</div>
			</div>
			<div class="fxt-bg-color">
				<div class="fxt-header">
					<a href="{{ route('homepage') }}" class="fxt-logo"><img src="{{ asset('uploads/logo/' . $info->logo) }}" width="150px" alt="Logo"></a>
					<div class="fxt-page-switcher">
						<a href="{{ route('redirectToLogin') }}" class="switcher-text switcher-text1 active">Đăng nhập</a>
						<a href="{{ route('redirectToRegister') }}" class="switcher-text switcher-text2">Đăng ký</a>
					</div>
				</div>
				<div class="fxt-form">
					@if ($errors->any())
						<div class="alert alert-danger">
							<ul style="margin-bottom: 0px;">
								@foreach ($errors->all() as $error)
									<li style="list-style: none;">{{ $error }}</li>
								@endforeach
							</ul>
						</div>
					@endif
					<form method="POST" action="{{ route('checkLogin') }}">
						@csrf
						<div class="form-group fxt-transformY-50 fxt-transition-delay-1">
							<input type="email" class="form-control" name="email" placeholder="Nhập Email" required="required">
							<i class="flaticon-envelope"></i>
						</div>
						<div class="form-group fxt-transformY-50 fxt-transition-delay-2">
							<input type="password" class="form-control" name="password" placeholder="Nhập password" required="required">
							<i class="flaticon-padlock"></i>
							<a href="{{ route('redirectToForgotPassword') }}" class="switcher-text3">Bạn quên mật khẩu ư!!! 🤡🤡🤡</a>
						</div>
						<div class="form-group fxt-transformY-50 fxt-transition-delay-3">
							<div class="fxt-content-between">
								<button type="submit" class="fxt-btn-fill">Đăng nhập</button>
								<div class="checkbox">
									<input id="checkbox1" type="checkbox" name="remember">
									<label for="checkbox1">Giữ tôi luôn đăng nhập</label>
								</div>
							</div>
						</div>
					</form>
					<div>
						{{-- <a href="">Nếu như bạn chưa kịp xác thực thì bạn hãy bấm vào đây để xác thực với admin của chúng tôi</a> --}}
					</div>
				</div>
				<div class="fxt-footer">
					<ul class="fxt-socials">
						<li class="fxt-facebook fxt-transformY-50 fxt-transition-delay-5"><a href="{{ route('login-to-facebook') }}" title="Facebook"><i class="fab fa-facebook-f"></i></a></li>
						<li class="fxt-twitter fxt-transformY-50 fxt-transition-delay-6"><a href="#" title="twitter"><i class="fab fa-twitter"></i></a></li>
						<li class="fxt-google fxt-transformY-50 fxt-transition-delay-7"><a href="{{ route('login-to-google') }}" title="google"><i class="fab fa-google-plus-g"></i></a></li>
						<li class="fxt-linkedin fxt-transformY-50 fxt-transition-delay-8"><a href="#" title="linkedin"><i class="fab fa-linkedin-in"></i></a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<script src="{{asset('loginCustomer/js/jquery.min.js')}}"></script>
	<script src="{{asset('loginCustomer/js/bootstrap.min.js')}}"></script>
	<script src="{{asset('loginCustomer/js/imagesloaded.pkgd.min.js')}}"></script>
	<script src="{{asset('loginCustomer/js/validator.min.js')}}"></script>
	<script src="{{asset('loginCustomer/js/main.js')}}"></script>

</body>

</html>