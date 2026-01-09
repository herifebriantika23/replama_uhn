<nav class="navbar navbar-expand-lg navbar-dark shadow-sm" id="mainNav">
    <div class="container px-auto">

        {{-- LOGO --}}
        <a class="navbar-brand fw-bold" href="{{ url('/') }}">
            <img src="{{ asset('images/bg_navbar.png') }}"
                 alt="Logo UHN" style="max-height:55px;">
        </a>

        {{-- TOGGLER --}}
        <button class="navbar-toggler"
                type="button"
                data-bs-toggle="offcanvas"
                data-bs-target="#offcanvasNavbar">
            <i class="bi bi-list fs-4"></i>
        </button>

        {{-- MENU DESKTOP --}}
        <div class="collapse navbar-collapse d-none d-lg-flex position-relative">

            {{-- MENU UTAMA --}}
            <ul class="navbar-nav ms-auto gap-3">
                <li class="nav-item"><a class="nav-link" href="{{ route('user.beranda') }}">Beranda</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('user.tentang') }}">Tentang Web</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('user.panduan') }}">Panduan</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('user.laporan.index') }}">Kelola Laporan</a></li>
            </ul>

            {{-- NOTIFIKASI --}}
            <ul class="navbar-nav align-items-center gap-2 ms-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link position-relative" href="#" data-bs-toggle="dropdown">
                        <i class="ti ti-bell fs-5"></i>

                        @if(($navUnreadCount ?? 0) > 0)
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                {{ $navUnreadCount }}
                            </span>
                        @endif
                    </a>

                    <div class="dropdown-menu dropdown-menu-end shadow" style="width:320px">
                        <div class="dropdown-header fw-semibold">Notifikasi</div>

                        <div class="list-group list-group-flush">
                            @forelse($navNotifications ?? [] as $notif)
                                <a href="{{ route('user.notification.read', $notif->id) }}"
                                   class="list-group-item list-group-item-action {{ $notif->read_at ? '' : 'bg-light' }}">
                                    <div class="d-flex">
                                        <i class="ti ti-file-text text-primary fs-4"></i>
                                        <div class="ms-2 flex-grow-1">
                                            <span class="float-end text-muted small">
                                                {{ $notif->created_at->diffForHumans() }}
                                            </span>
                                            <div class="fw-semibold">
                                                {{ $notif->data['judul'] ?? 'Notifikasi' }}
                                            </div>
                                            <small class="text-muted">
                                                {{ $notif->data['message'] ?? '' }}
                                            </small>
                                        </div>
                                    </div>
                                </a>
                            @empty
                                <div class="text-center text-muted py-3">Tidak ada notifikasi</div>
                            @endforelse
                        </div>

                        <div class="dropdown-divider"></div>

                        <div class="d-flex justify-content-between px-3 py-2">
                            @if(($navUnreadCount ?? 0) > 0)
                                <a href="{{ route('user.notification.readAll') }}"
                                   class="btn btn-sm btn-success fw-semibold">
                                    <i class="ti ti-check me-1"></i> Tandai Semua
                                </a>
                            @else
                                <span></span>
                            @endif

                            <a href="{{ route('user.notification.index') }}"
                               class="btn btn-sm btn-primary fw-semibold">
                                <i class="ti ti-list me-1"></i> View All
                            </a>
                        </div>
                    </div>
                </li>

                {{-- PROFIL --}}
                @isset($navUser)
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle d-flex align-items-center gap-2"
                       href="#" data-bs-toggle="dropdown">
                        <img src="{{ $navUser->photo_url }}"
                             class="rounded-circle border"
                             width="32" height="32"
                             style="object-fit:cover">
                        <span class="fw-semibold d-none d-lg-inline">
                            {{ $navUser->name }}
                        </span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-end shadow" style="min-width:220px">
                        <div class="dropdown-header text-center">
                            <img src="{{ $navUser->photo_url }}"
                                 class="rounded-circle border mb-2"
                                 width="48" height="48">
                            <div class="fw-semibold">{{ $navUser->name }}</div>
                            <small class="text-muted">{{ ucfirst($navUser->role) }}</small>
                        </div>

                        <div class="dropdown-divider"></div>

                        <a href="{{ route('profile.show') }}" class="dropdown-item">
                            <i class="ti ti-user me-2"></i> Profil
                        </a>
                        <a href="{{ route('password.edit') }}" class="dropdown-item">
                            <i class="ti ti-edit me-2"></i> Pengaturan
                        </a>

                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="dropdown-item text-danger">
                                <i class="ti ti-logout me-2"></i> Logout
                            </button>
                        </form>
                    </div>
                </li>
                @endisset
            </ul>
        </div>
    </div>
</nav>
