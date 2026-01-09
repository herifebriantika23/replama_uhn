<nav class="pc-sidebar">
    <div class="navbar-wrapper">
        <div class="m-header">
            <a href="{{ route('admin.dashboard') }}"
               class="b-brand d-flex justify-content-center mt-2">
                <img src="{{ asset('images/bg_sidebar.png') }}"
                     alt="Logo"
                     class="img-fluid"
                     style="max-width:120px">
            </a>
        </div>

        <div class="navbar-content">
            <ul class="pc-navbar">

                {{-- DASHBOARD --}}
                <li class="pc-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <a href="{{ route('admin.dashboard') }}" class="pc-link">
                        <span class="pc-micon"><i class="ti ti-dashboard"></i></span>
                        <span class="pc-mtext">Dashboard</span>
                    </a>
                </li>

                {{-- FAKULTAS --}}
                <li class="pc-item {{ request()->routeIs('admin.fakultas.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.fakultas.index') }}" class="pc-link">
                        <span class="pc-micon"><i class="ti ti-building"></i></span>
                        <span class="pc-mtext">Fakultas</span>
                    </a>
                </li>

                {{-- PROGRAM STUDI --}}
                <li class="pc-item {{ request()->routeIs('admin.prodi.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.prodi.index') }}" class="pc-link">
                        <span class="pc-micon"><i class="ti ti-school"></i></span>
                        <span class="pc-mtext">Program Studi</span>
                    </a>
                </li>

                {{-- MAHASISWA --}}
                <li class="pc-item {{ request()->routeIs('admin.mahasiswa.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.mahasiswa.index') }}" class="pc-link">
                        <span class="pc-micon"><i class="ti ti-users"></i></span>
                        <span class="pc-mtext">Kelola Mahasiswa</span>
                    </a>
                </li>

                {{-- LAPORAN --}}
                <li class="pc-item {{ request()->routeIs('admin.laporan.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.laporan.index') }}" class="pc-link">
                        <span class="pc-micon"><i class="ti ti-file-check"></i></span>
                        <span class="pc-mtext">Verifikasi Laporan</span>
                    </a>
                </li>

                {{-- PERIODE MAGANG --}}
                <li class="pc-item {{ request()->routeIs('admin.periode.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.periode.index') }}" class="pc-link">
                        <span class="pc-micon"><i class="ti ti-calendar"></i></span>
                        <span class="pc-mtext">Periode Magang</span>
                    </a>
                </li>

                {{-- STATISTIK --}}
                <li class="pc-item {{ request()->routeIs('admin.statistik.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.statistik.index') }}" class="pc-link">
                        <span class="pc-micon"><i class="ti ti-chart-bar"></i></span>
                        <span class="pc-mtext">Statistik Laporan</span>
                    </a>
                </li>

            </ul>
        </div>
    </div>
</nav>
