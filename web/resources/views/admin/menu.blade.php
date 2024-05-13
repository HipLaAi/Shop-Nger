<aside class="app-sidebar">
    <div class="app-sidebar__user">
        <img class="app-sidebar__user-avatar" src="images/logo.png" width="50px"alt="User Image" 
        style="border: 0!important;border-radius: 10px !important;width: 100%;filter: hue-rotate(262deg) brightness(110%);">
    <div>
    <p class="app-sidebar__user-name"><b>ADMIN</b></p>
    <p class="app-sidebar__user-designation">Chào mừng bạn trở lại</p>
    </div>
</div>
<hr>
<ul class="app-menu">
    <li><a class="app-menu__item {{ request()->segment(2) == 'overview' ? 'haha':'' }}" href="admin/overview"><i class='app-menu__icon bx bx-cart-alt'></i>
        <span class="app-menu__label">Tổng quan bán hàng</span></a></li>

    <li><a class="app-menu__item {{ request()->segment(2) == 'category' ? 'haha':'' }}" href="admin/category"><i class='app-menu__icon bx bx-category'></i>
        <span class="app-menu__label">Quản lý danh mục</span></a></li>

    <li><a class="app-menu__item {{ request()->segment(2) == 'brand' ? 'haha':'' }}" href="admin/brand"><i class='app-menu__icon bx bx-code'></i>
        <span class="app-menu__label">Quản lý thương hiệu</span></a></li>
        
    <li><a class="app-menu__item {{ request()->segment(2) == 'product' ? 'haha':'' }}" href="admin/product"><i class='app-menu__icon bx bx-purchase-tag-alt'></i>
        <span class="app-menu__label">Quản lý sản phẩm</span></a></li>

    <li><a class="app-menu__item {{ request()->segment(2) == 'order' ? 'haha':'' }}" href="admin/order"><i class='app-menu__icon bx bx-task'></i>
        <span class="app-menu__label">Quản lý đơn hàng</span></a></li>

    <li><a class="app-menu__item {{ request()->segment(2) == 'slide' ? 'haha':'' }}" href="admin/slide"><i class='app-menu__icon bx bx-tag'></i>
        <span class="app-menu__label">Quản lý slide</span></a></li>

    <li><a class="app-menu__item {{ request()->segment(2) == 'blog' ? 'haha':'' }}" href="admin/blog"><i class='app-menu__icon bx bx-cog'></i>
        <span class="app-menu__label">Quản lý blog</span></a></li>

    <li><a class="app-menu__item {{ request()->segment(2) == 'user' ? 'haha':'' }}" href="admin/user"><i class='app-menu__icon bx bx-user'></i>
        <span class="app-menu__label">Quản lý người dùng</span></a></li>
</ul>
</aside>