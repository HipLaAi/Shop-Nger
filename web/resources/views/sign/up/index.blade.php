@extends('sign.layout')
@section('content')
<div class="form-container sign-up-container">
	<form action="" method="POST">
	@csrf
		<h1 style="color: #ffba00;">Đăng ký tài khoản</h1>
		<div class="social-container">
			<a href="#" class="social"><i class="fab fa-facebook-f"></i></a>
			<a href="#" class="social"><i class="fab fa-google-plus-g"></i></a>
			<a href="#" class="social"><i class="fab fa-linkedin-in"></i></a>
		</div>
		<span>hoặc sử dụng email của bạn để đăng ký</span>
		<input type="text" placeholder="Họ tên" name="name" required/>
		@error('name')<small style="color:red">{{ $message }}</small> @enderror
		<input type="email" placeholder="Email" name="email" required/>
		@error('email')<small style="color:red">{{ $message }}</small> @enderror
		<input type="password" placeholder="Mật khẩu" name="password" required/>
		@error('password')<small style="color:red">{{ $message }}</small> @enderror
		<input type="password" placeholder="Xác nhận mật khẩu" name="confirmpassword" required/>
		@error('confirmpassword')<small style="color:red">{{ $message }}</small> @enderror
		<button>Đăng ký</button>
	</form>
</div>
<div class="overlay-container-sign-up">
	<div class="overlay">
		<div class="overlay-panel">
			<h1>Chào mừng bạn quay trở lại!</h1>
			<p>Để giữ kết nối với chúng tôi, vui lòng đăng nhập bằng thông tin cá nhân của bạn</p>
			<button class="ghost" id="signUp" onclick="window.location.href='{{route('login')}}'">Đăng nhập</button>
		</div>
	</div>
</div>
@endsection