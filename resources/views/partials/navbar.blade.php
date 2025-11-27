<!-- Navbar start -->
<div class="container-fluid border-bottom bg-light wow fadeIn" data-wow-delay="0.1s">
    <div class="container topbar bg-primary d-none d-lg-block py-2" style="border-radius: 0 40px">
        <div class="d-flex justify-content-between">
        </div>
    </div>
    <div class="container px-0">
        <nav class="navbar navbar-light navbar-expand-xl py-3">
            <a href="{{ url('/') }}" class="navbar-brand"><h1 class="text-primary display-6">SMK<span class="text-secondary">BAKTINUSANTARA 666</span></h1></a>
            <button class="navbar-toggler py-2 px-3" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="fa fa-bars text-primary"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav mx-auto">
                    <a href="{{ url('/') }}" class="nav-item nav-link {{ request()->is('/') ? 'active' : '' }}">Beranda</a>
                    <a href="{{ url('/about') }}" class="nav-item nav-link {{ request()->is('about') ? 'active' : '' }}">Tentang</a>
                    <a href="{{ url('/jurusan') }}" class="nav-item nav-link {{ request()->is('jurusan') ? 'active' : '' }}">Jurusan</a>
                    <a href="{{ url('/pendaftaran') }}" class="nav-item nav-link {{ request()->is('pendaftaran') ? 'active' : '' }}">Pendaftaran</a>
                </div>
               
                    
                @if(Session::has('admin_id'))
                    <div class="dropdown">
                        <button class="btn btn-success dropdown-toggle px-3 py-2" type="button" data-bs-toggle="dropdown">
                            {{ Session::get('admin_nama') }}
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('admin.dashboar02   d') }}">Dashboard Admin</a></li>
                            <li><a class="dropdown-item" href="{{ route('admin.logout') }}">Logout</a></li>
                        </ul>
                    </div>
                @elseif(Session::has('siswa_id'))
                    <div class="dropdown">
                        <button class="btn btn-primary dropdown-toggle px-3 py-2" type="button" data-bs-toggle="dropdown">
                            {{ Session::get('siswa_nama') }}
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('siswa.logout') }}">Logout</a></li>
                        </ul>
                    </div>
                @else
                    <a href="{{ route('auth.login') }}" class="btn btn-primary px-3 py-2">Login</a>
                @endif
            </div>
        </nav>
    </div>
</div>
<!-- Navbar End -->

<!-- Modal Login Start -->
<div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Login Admin / Siswa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" id="authTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="login-tab" data-bs-toggle="tab" data-bs-target="#login" type="button" role="tab">Login</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="register-tab" data-bs-toggle="tab" data-bs-target="#register" type="button" role="tab">Register</button>
                    </li>
                </ul>
                
                <!-- Tab content -->
                <div class="tab-content mt-3" id="authTabsContent">
                    <!-- Login Tab -->
                    <div class="tab-pane fade show active" id="login" role="tabpanel">
                        <form id="loginForm">
                            @csrf
                            <div class="mb-3">
                                <label for="loginEmail" class="form-label">Email</label>
                                <input type="email" class="form-control" id="loginEmail" name="email" placeholder="Masukkan email" required>
                            </div>
                            <div class="mb-3">
                                <label for="loginPassword" class="form-label">Password</label>
                                <input type="password" class="form-control" id="loginPassword" name="password" placeholder="Masukkan password" required>
                            </div>
                            <div id="loginError" class="alert alert-danger d-none"></div>
                            <button type="submit" class="btn btn-primary w-100">Login</button>
                        </form>
                    </div>
                    
                    <!-- Register Tab -->
                    <div class="tab-pane fade" id="register" role="tabpanel">
                        <form id="registerForm">
                            @csrf
                            <div class="mb-3">
                                <label for="registerName" class="form-label">Nama Lengkap</label>
                                <input type="text" class="form-control" id="registerName" name="nama" placeholder="Masukkan nama lengkap" required>
                            </div>
                            <div class="mb-3">
                                <label for="registerEmail" class="form-label">Email</label>
                                <input type="email" class="form-control" id="registerEmail" name="email" placeholder="Masukkan email" required>
                            </div>
                            <div class="mb-3">
                                <label for="registerHp" class="form-label">No. HP</label>
                                <input type="text" class="form-control" id="registerHp" name="hp" placeholder="Masukkan nomor HP" required>
                            </div>
                            <div class="mb-3">
                                <label for="registerPassword" class="form-label">Password</label>
                                <input type="password" class="form-control" id="registerPassword" name="password" placeholder="Masukkan password" required>
                            </div>
                            <div class="mb-3">
                                <label for="confirmPassword" class="form-label">Konfirmasi Password</label>
                                <input type="password" class="form-control" id="confirmPassword" name="password_confirmation" placeholder="Konfirmasi password" required>
                            </div>
                            <div id="registerError" class="alert alert-danger d-none"></div>
                            <button type="submit" class="btn btn-primary w-100">Register</button>
                        </form>
                        
                        <!-- OTP Verification Form -->
                        <form id="otpForm" style="display: none;">
                            @csrf
                            <div class="mb-3">
                                <label for="otpCode" class="form-label">Kode OTP</label>
                                <input type="text" class="form-control" id="otpCode" name="otp" placeholder="Masukkan 6 digit kode OTP" maxlength="6" required>
                                <div class="form-text">Kode OTP telah dikirim ke email Anda</div>
                            </div>
                            <input type="hidden" id="otpEmail" name="email">
                            <div id="otpError" class="alert alert-danger d-none"></div>
                            <button type="submit" class="btn btn-success w-100">Verifikasi OTP</button>
                            <button type="button" class="btn btn-link w-100" onclick="backToRegister()">Kembali ke Form Register</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal Login End -->

@include('partials.otp-script')

<script>
// Login Form Handler
document.getElementById('loginForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const formData = new FormData(this);
    const errorDiv = document.getElementById('loginError');
    
    fetch('{{ route('admin.login') }}', {
        method: 'POST',
        body: formData,
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Accept': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Close modal
            const modal = bootstrap.Modal.getInstance(document.getElementById('searchModal'));
            if (modal) modal.hide();
            
            // Show success notification
            const role = data.role || 'admin';
            const userName = data.user_name || 'Admin';
            
            loginNotification.showLoginSuccess(userName, role);
            
            // Immediate redirect for admin users
            if (['admin', 'kepsek', 'verifikator_adm', 'keuangan'].includes(role)) {
                window.location.href = data.redirect;
            } else {
                setTimeout(() => {
                    window.location.href = data.redirect;
                }, 1500);
            }
        } else {
            loginNotification.showLoginError(data.message || 'Email atau password salah');
        }
    })
    .catch(error => {
        errorDiv.textContent = 'Terjadi kesalahan. Silakan coba lagi.';
        errorDiv.classList.remove('d-none');
    });
});

// Register Form Handler
document.getElementById('registerForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const formData = new FormData(this);
    const errorDiv = document.getElementById('registerError');
    const password = formData.get('password');
    const confirmPassword = formData.get('password_confirmation');
    
    if (password !== confirmPassword) {
        errorDiv.textContent = 'Password dan konfirmasi password tidak sama';
        errorDiv.classList.remove('d-none');
        return;
    }
    
    fetch('{{ route('siswa.register') }}', {
        method: 'POST',
        body: formData,
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success && data.show_otp) {
            // Show OTP form
            document.getElementById('registerForm').style.display = 'none';
            document.getElementById('otpForm').style.display = 'block';
            document.getElementById('otpEmail').value = formData.get('email');
            errorDiv.classList.add('d-none');
        } else if (data.success) {
            // Close modal
            const modal = bootstrap.Modal.getInstance(document.getElementById('searchModal'));
            if (modal) modal.hide();
            
            // Show success notification for registration
            loginNotification.showLoginSuccess(data.user_name || 'Siswa', 'pendaftar');
            
            setTimeout(() => {
                location.reload();
            }, 1500);
        } else {
            errorDiv.textContent = data.message;
            errorDiv.classList.remove('d-none');
        }
    })
    .catch(error => {
        errorDiv.textContent = 'Terjadi kesalahan. Silakan coba lagi.';
        errorDiv.classList.remove('d-none');
    });
});
</script>