<!-- Carousel Start -->
<div class="container-fluid p-0 mb-5 wow fadeIn" data-wow-delay="0.1s">
    <div id="header-carousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            @foreach ($memes as $index => $meme)
                <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                    <img class="w-100" src="{{ asset('storage/' . $meme->image) }}" alt="Meme Image" />

                    <div class="carousel-overlay-wrapper position-absolute top-0 start-0 w-100 h-100">
                        <!-- Gradient overlay (left half only) -->
                        <div class="carousel-gradient-left position-absolute top-0 start-0 h-100" style="width: 70%;">
                        </div>

                        <div class="carousel-caption">
                            <div class="container">
                                <div class="row">
                                    <div class="col-12 col-lg-6">
                                        <h1 class="display-3 text-dark mb-4 animated slideInDown">
                                            {{ $meme->heading }}
                                        </h1>
                                        <p class="fs-4 text-body mb-5 w-75">
                                            {{ $meme->description }}
                                        </p>
                                        <a href="{{ route('underConstruction') }}" class="btn btn-dark py-3 px-5">
                                            More Details
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#header-carousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#header-carousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</div>
<!-- Carousel End -->
