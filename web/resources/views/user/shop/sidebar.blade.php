<div class="col-xl-3 col-lg-4 col-md-5">
    <div class="sidebar-categories">
        <div class="head">Danh mục</div>
        <ul class="main-categories">
            <li class="main-nav-list">
                <a href="shop" style="{{ request()->segment(2) == '' ? 'color:#ffba00':'' }}">
                    Tất cả
                    <span class="number">
                        ({{ $category->sum(function($category) { return $category->products->count(); }) }})
                    </span>
                </a>
            </li>
            @foreach($category as $item)
                <li class="main-nav-list"><a href="shop/{{ $item->id }}" style="{{ request()->segment(2) == $item->id ? 'color:#ffba00':'' }}">{{$item->name}}<span class="number">({{ $item->products->count() }})</span></a></li>
            @endforeach
        </ul>
    </div>
    <div class="sidebar-filter mt-50">
        <div class="top-filter-head">Bộ lọc sản phẩm</div>
        <div class="common-filter">
            <div class="head">Thương hiệu</div>
            <form action="">
                <ul>
                    @foreach($brand as $item)
                        <li class="filter-list">
                            <input {{ (request('brand')[$item->id] ?? '') == 'on' ? 'checked' : '' }} 
                            class="pixel-radio" 
                            type="checkbox" 
                            id="brand_{{ $item->id }}" 
                            name="brand[{{ $item->id }}]"
                            onchange="this.form.submit()">
                            <label for="brand_{{ $item->id }}">{{ $item->name }}<span>({{ $item->products->count() }})</span>
                            </label>
                        </li>
                    @endforeach
                </ul>
            </form>
        </div>

        <form action="">
            <div class="common-filter">
                <div class="head">Giá</div>
                <div class="price-range-area">
                    <div id="price-range" data-min="{{ request('min') }}" data-max="{{ request('max') }}"></div>
                    <div class="value-wrapper d-flex">
                        <div id="lower-value" name="min"></div>
                        <input type="hidden" id="lower_value" name="min">
                        <span>(tr)</span>
                        <div class="to">-></div>
                        <div id="upper-value"></div>
                        <input type="hidden" id="upper_value" name="max">
                        <span>(tr) VNĐ</span>
                    </div>
                </div>
                <div class="head">
                    <button type="submit" class="btn primary-btn" style="line-height: 35px;">Lọc</button>
                </div>
            </div>
        </form>

    </div>
</div>
