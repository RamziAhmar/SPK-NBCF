<!-- [ Sidebar Menu ] start -->
<nav class="pc-sidebar">
    <div class="navbar-wrapper">
        <div class="m-header">
            <a href="{{ route('dashboard') }}" class="b-brand text-primary">
                <!-- ========   Change your logo from here   ============ -->
                <img src="/assets/images/logo-dark.svg" class="img-fluid logo-lg" alt="logo">
            </a>
        </div>
        <div class="navbar-content">
            <ul class="pc-navbar">
                <li class="pc-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <a href="{{ route('dashboard') }}" class="pc-link">
                        <span class="pc-micon"><i class="ti ti-dashboard"></i></span>
                        <span class="pc-mtext">Dashboard</span>
                    </a>
                </li>

                @if (auth()->user()->role == 'admin')
                    <li class="pc-item {{ request()->routeIs('kriteria.*') ? 'active' : '' }}">
                        <a href="{{ route('kriteria.index') }}" class="pc-link">
                            <span class="pc-micon"><i class="ti ti-pencil"></i></span>
                            <span class="pc-mtext">Kriteria</span>
                        </a>
                    </li>

                    <li class="pc-item {{ request()->routeIs('sub_kriteria.*') ? 'active' : '' }}">
                        <a href="{{ route('sub_kriteria.index') }}" class="pc-link">
                            <span class="pc-micon"><i class="ti ti-brush"></i></span>
                            <span class="pc-mtext">Sub Kriteria</span>
                        </a>
                    </li>
                @endif

                <li class="pc-item {{ request()->routeIs('penilaian.*') ? 'active' : '' }}">
                    <a href="{{ route('penilaian.index') }}" class="pc-link">
                        <span class="pc-micon"><i class="ti ti-calculator"></i></span>
                        <span class="pc-mtext">Penilaian</span>
                    </a>
                </li>

            </ul>
        </div>
    </div>
</nav>
<!-- [ Sidebar Menu ] end --> <!-- [ Header Topbar ] start -->
