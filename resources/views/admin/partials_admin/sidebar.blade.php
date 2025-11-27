<!-- Sidebar -->
<div class="col-md-3 col-lg-2 sidebar d-md-block">
    <div class="position-sticky pt-3">
        <h4 class="text-center mb-4">SMK BAKTINUSANTARA 666</h4>
        
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                    <i class="fas fa-fw fa-tachometer-alt me-2"></i>
                    Dashboard
                </a>
            </li>
            
            @if(in_array(Session::get('admin_role'), ['admin', 'verifikator_adm']))
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.pendaftar.*') ? 'active' : '' }}" href="{{ route('admin.pendaftar.index') }}">
                    <i class="fas fa-fw fa-users me-2"></i>
                    Data Pendaftar
                </a>
            </li>
            @endif
            
            @if(Session::get('admin_role') === 'admin')
            <li class="sidebar-heading">Data Master</li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.jurusan.*') ? 'active' : '' }}" href="{{ route('admin.jurusan.index') }}">
                    <i class="fas fa-fw fa-graduation-cap me-2"></i>
                    Jurusan
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.gelombang.*') ? 'active' : '' }}" href="{{ route('admin.gelombang.index') }}">
                    <i class="fas fa-fw fa-wave-square me-2"></i>
                    Gelombang
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.wilayah.*') ? 'active' : '' }}" href="{{ route('admin.wilayah.index') }}">
                    <i class="fas fa-fw fa-map me-2"></i>
                    Wilayah
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.pengguna.*') ? 'active' : '' }}" href="{{ route('admin.pengguna.index') }}">
                    <i class="fas fa-fw fa-user-cog me-2"></i>
                    Pengguna
                </a>
            </li>
            @endif
            
            @if(in_array(Session::get('admin_role'), ['keuangan', 'admin']))
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.pembayaran.*') ? 'active' : '' }}" href="{{ route('admin.pembayaran.index') }}">
                    <i class="fas fa-fw fa-money-bill me-2"></i>
                    Pembayaran
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.keuangan.rekap') ? 'active' : '' }}" href="{{ route('admin.keuangan.rekap') }}">
                    <i class="fas fa-fw fa-chart-bar me-2"></i>
                    Rekap Pembayaran
                </a>
            </li>
            @endif
            
            <li class="nav-item">
                <a class="nav-link d-flex align-items-center {{ request()->routeIs('admin.log-aktivitas.*') ? 'active' : '' }}" href="{{ route('admin.log-aktivitas.index') }}">
                    <i class="fas fa-history me-2"></i>
                    <span>Log Aktivitas</span>
                </a>
            </li>
            
            <li class="sidebar-heading">Akun</li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="fas fa-fw fa-user me-2"></i>
                    Profil
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.logout') }}">
                    <i class="fas fa-fw fa-sign-out-alt me-2"></i>
                    Keluar
                </a>
            </li>
        </ul>
    </div>
</div>