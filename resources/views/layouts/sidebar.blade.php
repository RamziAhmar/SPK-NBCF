<!-- [ Sidebar Menu ] start -->
<nav class="pc-sidebar">
    <div class="navbar-wrapper">
        <div class="m-header">
            <a href="{{ route('dashboard') }}" class="b-brand text-primary text-center">
                <!-- ========   Change your logo from here   ============ -->
                <img src="/assets/images/logo-pt.png" class="img-fluid logo-lg" style="max-width: 50%;" alt="logo">
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
                
                <li class="pc-item pc-caption">
                    <label>Menu</label>
                    <i class="ti ti-brand-chrome"></i>
                </li>
                <li class="pc-item {{ request()->routeIs('penilaian.*') ? 'active' : '' }}">
                    <a href="{{ route('penilaian.index') }}" class="pc-link">
                        <span class="pc-micon"><i class="ti ti-calculator"></i></span>
                        <span class="pc-mtext">Penilaian</span>
                    </a>
                </li>

                @if (auth()->user()->role == 'admin')
                    <li class="pc-item {{ request()->routeIs('approval.*') ? 'active' : '' }}">
                        <a href="{{ route('approval.index') }}" class="pc-link">
                            <span class="pc-micon"><i class="ti ti-checkbox"></i></span>
                            <span class="pc-mtext">Approval</span>
                        </a>
                    </li>
                @endif

                @if (auth()->user()->role == 'admin')
                    <li class="pc-item pc-caption">
                        <label>Master Data</label>
                        <i class="ti ti-brand-chrome"></i>
                    </li>
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

                    <li class="pc-item {{ request()->routeIs('user.*') ? 'active' : '' }}">
                        <a href="{{ route('user.index') }}" class="pc-link">
                            <span class="pc-micon"><i class="ti ti-user"></i></span>
                            <span class="pc-mtext">User</span>
                        </a>
                    </li>
                @endif

            </ul>
        </div>
    </div>
</nav>
<!-- [ Sidebar Menu ] end --> <!-- [ Header Topbar ] start -->
