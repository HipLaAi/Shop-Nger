<section class="brand-area section_gap">
    <div class="container">
        <div class="row">
            @foreach($brand as $item)
            <a class="col single-img" href="#">
                <img class="img-fluid d-block mx-auto" src="images/{{ $item->image }}" alt="">
            </a>
            @endforeach
            <!-- <a class="col single-img" href="#">
                <img class="img-fluid d-block mx-auto" src="img/brand/1.png" alt="">
            </a>
            <a class="col single-img" href="#">
                <img class="img-fluid d-block mx-auto" src="img/brand/2.png" alt="">
            </a>
            <a class="col single-img" href="#">
                <img class="img-fluid d-block mx-auto" src="img/brand/3.png" alt="">
            </a>
            <a class="col single-img" href="#">
                <img class="img-fluid d-block mx-auto" src="img/brand/4.png" alt="">
            </a>
            <a class="col single-img" href="#">
                <img class="img-fluid d-block mx-auto" src="img/brand/5.png" alt="">
            </a> -->
        </div>
    </div>
</section>