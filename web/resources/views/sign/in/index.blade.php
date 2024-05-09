@extends('sign.layout')
@section('content')
<div class="form-container sign-in-container">
	<form action="{{ route('login') }}" method="POST">
	@csrf
		<h1 style="color: #ffba00;">Đăng nhập</h1>
		<div class="social-container">
			<a href="#" class="social"><i class="fab fa-facebook-f"></i></a>
			<a href="#" class="social"><i class="fab fa-google-plus-g"></i></a>
			<a href="#" class="social"><i class="fab fa-linkedin-in"></i></a>
		</div>
		<span>hoặc sử dụng tài khoản của bạn</span>
		<input type="email" placeholder="Email" name="email" required/>
		@error('email')<small style="color:red">{{ $message }}</small> @enderror
		<input type="password" placeholder="Mật khẩu" name="password" required/>
		@error('password')<small style="color:red">{{ $message }}</small> @enderror
		<a href="#" style="color: black;">Bạn quên mật khẩu?</a>
		<button>Đăng nhập</button>
	</form>
</div>
<div class="overlay-container-sign-in">
	<div class="overlay">
		<div class="overlay-panel">
			<h1>Chào bạn!</h1>
			<p>Nhập thông tin cá nhân của bạn và bắt đầu hành trình với chúng tôi</p>
			<button class="ghost" id="signUp" onclick="window.location.href='{{route('register')}}'">Đăng ký</button>
		</div>
	</div>
</div>
@endsection