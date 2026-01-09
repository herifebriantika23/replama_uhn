<!-- [ Header ] start -->
<header class="pc-header">
    <div class="header-wrapper">

        <div class="me-auto pc-mob-drp">
            <ul class="list-unstyled m-0 d-flex align-items-center">
                <li class="pc-h-item pc-sidebar-collapse">
                    <a href="#" class="pc-head-link" id="sidebar-hide">
                        <i class="ti ti-menu-2"></i>
                    </a>
                </li>
                <li class="pc-h-item pc-sidebar-popup">
                    <a href="#" class="pc-head-link ms-0" id="mobile-collapse">
                        <i class="ti ti-menu-2"></i>
                    </a>
                </li>
            </ul>
        </div>

        <div class="ms-auto">
            <ul class="list-unstyled">
                {{-- NOTIFICATION --}}
                <li class="dropdown pc-h-item">
                    <a class="pc-head-link dropdown-toggle arrow-none me-0 position-relative"
                    data-bs-toggle="dropdown" href="#">
                        <i class="ti ti-bell"></i>

                        @if($adminUnreadCount > 0)
                            <span class="badge bg-danger" style="font-size:10px">
                                {{ $adminUnreadCount }}
                            </span>
                        @endif
                    </a>

                    <div class="dropdown-menu dropdown-notification dropdown-menu-end pc-h-dropdown">
                        <div class="dropdown-header d-flex justify-content-between align-items-center">
                            <h5 class="m-0">Notification</h5>

                            @if($adminUnreadCount > 0)
                                <a href="{{ route('admin.notification.readAll') }}"
                                class="text-sm text-primary">
                                    Tandai semua
                                </a>
                            @endif
                        </div>

                        <div class="dropdown-divider"></div>

                        <div class="header-notification-scroll" style="max-height:300px">
                            <div class="list-group list-group-flush">
                                @forelse($adminNotifications as $notif)
                                    <a href="{{ route('admin.notification.read', $notif->id) }}"
                                    class="list-group-item list-group-item-action {{ $notif->read_at ? '' : 'bg-light' }}">
                                        <div class="d-flex">
                                            <i class="ti ti-file-text text-primary fs-4"></i>
                                            <div class="ms-2 flex-grow-1">
                                                <span class="float-end text-muted small">
                                                    {{ $notif->created_at->diffForHumans() }}
                                                </span>
                                                <div class="fw-semibold">
                                                    {{ $notif->data['judul'] }}
                                                </div>
                                                <small class="text-muted">
                                                    {{ $notif->data['message'] }}
                                                </small>
                                            </div>
                                        </div>
                                    </a>
                                @empty
                                    <div class="text-center text-muted py-3">
                                        Tidak ada notifikasi
                                    </div>
                                @endforelse
                            </div>
                        </div>

                        <div class="dropdown-divider"></div>

                        <div class="text-center py-2">
                            <a href="{{ route('admin.notification.index') }}"
                            class="btn btn-sm btn-primary">
                                View All
                            </a>
                        </div>
                    </div>
                </li>

                {{-- PROFILE --}}
                <li class="dropdown pc-h-item header-user-profile">
                    <a class="pc-head-link dropdown-toggle arrow-none me-0"
                       data-bs-toggle="dropdown" href="#">
                        <img src="{{ $admin->photo_url }}"
                             class="user-avtar rounded-circle"
                             width="32" height="32"
                             style="object-fit:cover">
                        <span>{{ $admin->name }}</span>
                    </a>

                    <div class="dropdown-menu dropdown-user-profile dropdown-menu-end pc-h-dropdown">
                        <div class="dropdown-header">
                            <div class="d-flex mb-1">
                                <div class="flex-shrink-0">
                                <img src="{{ $admin->photo_url }}" alt="user-image" class="user-avtar wid-35">
                                </div>
                                <div class="flex-grow-1 ms-3">
                                <h6 class="mb-1">{{ $admin->name }}</h6>
                                <span>{{ ucfirst($admin->role) }}</span>
                                </div>
                            </div>
                        </div>
                        <a href="{{ route('profile.show') }}" class="dropdown-item">
                            <i class="ti ti-user"></i> Profile
                        </a>
                        <a href="{{ route('password.edit') }}" class="dropdown-item">
                            <i class="ti ti-edit-circle"></i> Settings
                        </a>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button class="dropdown-item">
                                <i class="ti ti-power"></i> Logout
                            </button>
                        </form>
                    </div>
                </li>

            </ul>
        </div>
    </div>
</header>
<!-- [ Header ] end -->

