<nav class="navbar navbar-expand-lg navbar-light fixed-top shadow-sm" id="mainNav">
    <div class="container px-5">
        <a class="navbar-brand fw-bold" href="{{ route('home') }}">
            <img src="{{ asset('images/bg_navbar.png') }}" alt="Logo UHN" style="max-height: 55px"/>
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarResponsive" aria-controls="navbarResponsive"
                aria-expanded="false" aria-label="Toggle navigation">
            <i class="bi-list fs-5"></i>
        </button>

        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ms-auto me-4 my-3 my-lg-0">
                <li class="nav-item"><a class="nav-link me-lg-3" href="{{ route('home') }}">Beranda</a></li>
                <li class="nav-item"><a class="nav-link me-lg-3" href="{{ route('about') }}">Tentang Kami</a></li>
                <li class="nav-item"><a class="nav-link me-lg-3" href="{{ route('guide') }}">Panduan</a></li>
            </ul>

            <a class="btn btn-primary rounded-pill px-3 mb-2 mb-lg-0" href="{{ route('login') }}">
                <span class="fw-bold">Masuk</span>
            </a>
        </div>
    </div>
</nav>