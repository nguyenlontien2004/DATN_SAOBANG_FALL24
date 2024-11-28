<div class="slide container-fluid">
    <div id="carouselExampleDark" class="carousel carousel-dark slide" data-bs-ride="carousel">
        <!-- Carousel Inner -->
        <div class="carousel-inner">
            @foreach ($bannerDau as $index => $bn)
                @foreach ($bn->anhBanners as $key => $banner)
                    <div class="carousel-item {{ $key === 0 ? 'active' : '' }}" data-bs-interval="2000">
                        <img src="{{ asset('storage/' . $banner->hinh_anh) }}" class="d-block w-100 img-fluid"
                            alt="...">
                    </div>
                @endforeach
            @endforeach
        </div>

        <!-- Carousel Controls -->
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</div>
