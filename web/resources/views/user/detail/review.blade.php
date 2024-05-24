<div class="tab-pane fade show active" id="review" role="tabpanel" aria-labelledby="review-tab">
    <div class="row">
        <div class="col-lg-6">
            <div class="row total_rate">
                <div class="col-6">
                    <div class="box_total">
                        <h5>Tổng thể</h5>
                        <h4>{{ number_format($review->avg('review'),1) }}</h4>
                        <h6>({{ $review->count('review') }} Đánh giá)</h6>
                    </div>
                </div>
                <div class="col-6">
                    <div class="rating_list">
                        <h3>Dựa trên {{ $review->count('review') }} đánh giá</h3>
                        <ul class="list">
                            <li><a>5 sao <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i><i class="fa fa-star"></i>
                            <i class="fa fa-star"></i><i class="fa fa-star"></i> {{ $review->where('review', 5)->count() }}</a></li>

                            <li><a>4 sao <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i><i class="fa fa-star"></i>
                            <i class="fa fa-star"></i> {{ $review->where('review', 4)->count() }}</a></li>

                            <li><a>3 sao <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i><i class="fa fa-star"></i> {{ $review->where('review', 3)->count() }}</a></li>

                            <li><a>2 sao <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i> {{ $review->where('review', 2)->count() }}</a></li>

                            <li><a>1 sao <i class="fa fa-star"></i> {{ $review->where('review', 1)->count() }}</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="review_list">
                @foreach($review as $item)
                <div class="review_item">
                    <div class="media">
                        <div class="d-flex">
                            <img style="width: 80px;height: 80px;border-radius: 50%;object-fit: cover;" src="images/{{ $item->users->avatar }}" alt="">
                        </div>
                        <div class="media-body">
                            <h4>{{ $item->users->name }}</h4>
                            @for($i=0; $i<$item->review;$i++)
                                <i class="fa fa-star"></i>
                            @endfor
                            <h5>{{ $item->created_at->format('Y-m-d') }}</h5>
                            @if($item->users->id == auth()->id())
                            <form action="product/{{ $item->proid }}/{{ $item->id }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="reply_btn" onclick="return confirm('Bạn có chắc chắn muốn xóa danh mục này không?')">Thu hồi</button>
                            </form>
                            @endif
                        </div>
                    </div>
                    <p>{{ $item->comment }}</p>
                </div>
                @endforeach
            </div>
        </div>
        <div class="col-lg-6">
            <div class="review_box">
                @if($checkReview)
                    <h4>Bạn đã đánh giá sản phẩm này.</h4>
                @else
                    <h4>Đánh giá</h4>
                    <p>Đánh giá của bạn:</p>
                    <div class="rating" id="rating">
                        <input type="radio" id="star5" name="rating" value="5">
                        <label for="star5"><i class="fa fa-star"></i></label>
                        <input type="radio" id="star4" name="rating" value="4">
                        <label for="star4"><i class="fa fa-star"></i></label>
                        <input type="radio" id="star3" name="rating" value="3">
                        <label for="star3"><i class="fa fa-star"></i></label>
                        <input type="radio" id="star2" name="rating" value="2">
                        <label for="star2"><i class="fa fa-star"></i></label>
                        <input type="radio" id="star1" name="rating" value="1">
                        <label for="star1"><i class="fa fa-star"></i></label>
                    </div>
                    <p>Nhận xét:</p>
                    <div class="row contact_form">
                        <div class="col-md-12">
                            <div class="form-group">
                                <textarea class="form-control" name="comment" id="comment" rows="1" placeholder="Viết nhận xét" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Viết nhận xét'"></textarea>
                            </div>
                        </div>
                        <div class="col-md-12 text-right">
                            @if(auth()->check())
                                <button onclick="addReview({{ $product->id }},(document.getElementById('comment').value))"
                                type="submit" value="submit" class="primary-btn">Gửi</button>
                            @else
                                <a href ="sign in" class="primary-btn">Vui lòng đăng nhập</a>
                            @endif
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>