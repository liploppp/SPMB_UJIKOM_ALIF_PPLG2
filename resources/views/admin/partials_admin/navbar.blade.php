<!-- Top Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm mb-4">
    <div class="container-fluid">
        <div class="d-flex align-items-center w-100">
            <div>
                <span class="text-muted small">Welcome back,</span>
                <h5 class="mb-0">{{ Session::get('admin_nama') }}</h5>
            </div>
            
            <span class="badge bg-primary px-3 py-2 fs-6 ms-4">
                @php
                    $roleNames = [
                        'admin' => 'Super Admin',
                        'kepsek' => 'Kepala Sekolah', 
                        'verifikator_adm' => 'Verifikator',
                        'keuangan' => 'Keuangan'
                    ];
                    echo $roleNames[Session::get('admin_role')] ?? 'Staff';
                @endphp
            </span>
            
            <div class="flex-grow-1"></div>
            
            <div class="dropdown ms-5">
                <button class="btn btn-outline-danger btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown">
                    <i class="fas fa-user me-2"></i> Akun
                </button>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="#"><i class="fas fa-user me-2"></i>Profil</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item text-danger" href="{{ route('admin.logout') }}"><i class="fas fa-sign-out-alt me-2"></i>Keluar</a></li>
                </ul>
            </div>
        </div>
    </div>
</nav>