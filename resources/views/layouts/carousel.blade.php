<!-- Carousel Start -->
<div class="container-fluid p-0 mb-5 wow fadeIn" data-wow-delay="0.1s">
    @php $memes = collect($memes ?? []); @endphp
    @if($memes->isEmpty())
        <div class="bg-light py-5 text-center">
            <div class="container py-4">
                <h1 class="display-6 text-dark mb-3">Welcome</h1>
                <p class="text-muted mb-0">No featured carousel items yet. Add memes/content in admin to populate this section.</p>
            </div>
        </div>
    @else
    <div id="header-carousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            @foreach ($memes as $index => $meme)
                <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                    <img class="w-100" src="{{ $meme->image ? asset('storage/' . $meme->image) : 'https://placehold.co/1600x600?text=JKE' }}" alt="Meme Image" onerror="this.src='https://placehold.co/1600x600?text=JKE'" />
                    <div class="carousel-overlay-wrapper position-absolute top-0 start-0 w-100 h-100">
                        <div class="carousel-gradient-left position-absolute top-0 start-0 h-100" style="width: 70%;"></div>
                        <div class="carousel-caption">
                            <div class="container"><div class="row"><div class="col-12 col-lg-6">
                                <h1 class="display-3 text-dark mb-4 animated slideInDown">{{ $meme->heading ?? 'Welcome' }}</h1>
                                <p class="fs-4 text-body mb-5 w-75">{{ $meme->description ?? '' }}</p>
                            </div></div></div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#header-carousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span><span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#header-carousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span><span class="visually-hidden">Next</span>
        </button>
    </div>
    @endif
</div>
<!-- Carousel End -->
