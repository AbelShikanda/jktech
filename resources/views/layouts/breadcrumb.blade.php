<!-- Page Header Start -->
<div class="container-fluid page-header py-5 mb-5 wow fadeIn" data-wow-delay="0.1s">
    <div class="container py-5">
        <h1 class="display-4 animated slideInDown mb-4">{{ $pageTitle }}</h1>
        <nav aria-label="breadcrumb animated slideInDown">
            <ol class="breadcrumb mb-0">
                @foreach ($breadcrumbLinks as $link)
                    <li class="breadcrumb-item {{ request()->is($link['url']) ? 'active' : '' }}" aria-current="page"><a
                            href="{{ $link['url'] }}">{{ $link['label'] }}</a></li>
                @endforeach
            </ol>
        </nav>
    </div>
</div>
<!-- Page Header End -->
