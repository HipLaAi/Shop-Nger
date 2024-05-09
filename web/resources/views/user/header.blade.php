<header class="header_area sticky-header">
		<div class="main_menu">
			<nav class="navbar navbar-expand-lg navbar-light main_box">
				<div class="container">
					<!-- Brand and toggle get grouped for better mobile display -->
					<a class="navbar-brand logo_h" href=""><img src="images/logo.png" alt="" style="height:75px;filter: hue-rotate(262deg) brightness(110%);"></a>
					<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
					 aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<!-- Collect the nav links, forms, and other content for toggling -->
					<div class="collapse navbar-collapse offset" id="navbarSupportedContent">
						<ul class="nav navbar-nav menu_nav ml-auto">
							<li class="nav-item {{ request()->segment(1) == '' ? 'active':'' }}"><a class="nav-link" href="">Trang chủ</a></li>
							<li class="nav-item {{ request()->segment(1) == 'shop' ? 'active':'' }}"><a class="nav-link" href="shop">Cửa hàng</a></li>
							<li class="nav-item {{ request()->segment(1) == 'blog' ? 'active':'' }}"><a class="nav-link" href="blog">Blog</a></li>
							<li class="nav-item {{ request()->segment(1) == 'contact' ? 'active':'' }}"><a class="nav-link" href="contact">Liên hệ</a></li>
						</ul>
						<ul class="nav navbar-nav navbar-right">
							<li class="nav-item">
								@if(auth()->check())
								<a class="cart-count" style="
									border-radius: 50%;
									color: black;
									top: -10px;
									right: -26px;
									position: relative;
									background-color: #ffba00a3;
									padding:0px 1px
								">&nbsp{{ $cartDetail->count() }}&nbsp</a>
								<a href="cart" class="cart">
									<span class="ti-bag"></span>
								</a>
								@else
								<a class="cart-count" style="
									border-radius: 50%;
									color: black;
									top: -10px;
									right: -26px;
									position: relative;
									background-color: #ffba00a3;
									padding:0px 1px
								">&nbsp0&nbsp</a>
								<a href="sign in" class="cart" onclick="return confirm('Vui lòng đăng nhập để thực hiện hành động này')">
									<span class="ti-bag"></span>
								</a>
								@endif
							</li>
							<li class="nav-item" style="margin-left:15px">
								@if(auth()->check())
								<a class="love-count" style="
									border-radius: 50%;
									color: black;
									top: -10px;
									right: -26px;
									position: relative;
									background-color: #ffba00a3;
									padding:0px 1px
								">&nbsp{{ $loveDetail->count() }}&nbsp</a>
								<a href="love" class="cart">
									<span class="ti-heart"></span>
								</a>
								@else
								<a class="love-count" style="
									border-radius: 50%;
									color: black;
									top: -10px;
									right: -26px;
									position: relative;
									background-color: #ffba00a3;
									padding:0px 1px
								">&nbsp0&nbsp</a>
								<a href="sign in" class="cart" onclick="return confirm('Vui lòng đăng nhập để thực hiện hành động này')">
									<span class="ti-heart"></span>
								</a>
								@endif
							</li>
							<li class="nav-item">
								<button class="search"><span class="lnr lnr-magnifier" id="search"></span></button>
							</li>
							@if(auth()->check())
							<li class="nav-item">
								<a href="account" class="ti-user" style="color:black"><span></span></a>
							</li>
							<li class="nav-item">
								<a href="sign out" style="color:black" onclick="return confirm('Bạn có chắc muốn đăng xuất tài khoản không?')">
									<span style="font-family:Roboto, sans-serif;text-transform: uppercase;font-size: 12px;">Đăng xuất</span>
								</a>
							</li>
							<!-- <li class="nav-item"><a href="account" class="ti-user" style="color:black"><span style="font-family:Roboto, sans-serif;text-transform: uppercase;font-size: 12px; margin-left:20px">{{ auth()->user()->name }}</span></a></li> -->
							@else
							<li class="nav-item"><a href="sign in" style="color:black"><span style="font-family:Roboto, sans-serif;text-transform: uppercase;font-size: 12px;">Đăng nhập</span></a></li>
							@endif
						</ul>
					</div>
				</div>
			</nav>
		</div>
		<div class="search_input" id="search_input_box">
			<div class="container">
				<form class="d-flex justify-content-between" action="shop">
					<input name="search" value="{{ request('search') }}" type="text" class="form-control" id="search_input" placeholder="Tìm kiếm">
					<button type="submit" class="btn"></button>
					<span class="lnr lnr-cross" id="close_search" title="Close Search"></span>
				</form>
			</div>
		</div>
	</header>