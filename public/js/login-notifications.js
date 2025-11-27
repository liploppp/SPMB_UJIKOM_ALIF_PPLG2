// Login Notification System
class LoginNotification {
    constructor() {
        this.createNotificationContainer();
    }

    createNotificationContainer() {
        if (!document.getElementById('notification-container')) {
            const container = document.createElement('div');
            container.id = 'notification-container';
            container.style.cssText = `
                position: fixed;
                top: 20px;
                right: 20px;
                z-index: 9999;
                max-width: 400px;
            `;
            document.body.appendChild(container);
        }
    }

    showLoginSuccess(userName, userRole) {
        const notification = document.createElement('div');
        notification.className = 'login-notification success';
        
        const roleNames = {
            'admin': 'Super Administrator',
            'kepsek': 'Kepala Sekolah',
            'verifikator_adm': 'Verifikator Administrasi',
            'keuangan': 'Staff Keuangan',
            'pendaftar': 'Calon Siswa'
        };
        
        const roleName = roleNames[userRole] || 'User';
        const roleIcon = userRole === 'pendaftar' ? 'fa-user-graduate' : 'fa-user-shield';
        const roleColor = userRole === 'pendaftar' ? '#3b82f6' : '#10b981';
        
        notification.innerHTML = `
            <div class="notification-content">
                <div class="notification-icon" style="background: ${roleColor}">
                    <i class="fas ${roleIcon}"></i>
                </div>
                <div class="notification-text">
                    <h4>Login Berhasil!</h4>
                    <p><strong>${userName}</strong></p>
                    <small>${roleName}</small>
                </div>
                <button class="notification-close" onclick="this.parentElement.parentElement.remove()">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="notification-progress"></div>
        `;
        
        document.getElementById('notification-container').appendChild(notification);
        
        // Trigger confetti for successful login
        this.triggerConfetti();
        
        // Auto remove after 5 seconds
        setTimeout(() => {
            if (notification.parentElement) {
                notification.classList.add('fade-out');
                setTimeout(() => notification.remove(), 300);
            }
        }, 5000);
        
        // Animate progress bar
        const progressBar = notification.querySelector('.notification-progress');
        setTimeout(() => {
            progressBar.style.width = '0%';
        }, 100);
    }

    showLoginError(message) {
        const notification = document.createElement('div');
        notification.className = 'login-notification error';
        
        notification.innerHTML = `
            <div class="notification-content">
                <div class="notification-icon" style="background: #ef4444">
                    <i class="fas fa-exclamation-triangle"></i>
                </div>
                <div class="notification-text">
                    <h4>Login Gagal!</h4>
                    <p>${message}</p>
                </div>
                <button class="notification-close" onclick="this.parentElement.parentElement.remove()">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        `;
        
        document.getElementById('notification-container').appendChild(notification);
        
        // Auto remove after 4 seconds
        setTimeout(() => {
            if (notification.parentElement) {
                notification.classList.add('fade-out');
                setTimeout(() => notification.remove(), 300);
            }
        }, 4000);
    }

    showRegistrationSuccess(noPendaftaran, namaSiswa, jurusan) {
        const notification = document.createElement('div');
        notification.className = 'login-notification registration';
        
        notification.innerHTML = `
            <div class="notification-content">
                <div class="notification-icon" style="background: #10b981">
                    <i class="fas fa-check-circle"></i>
                </div>
                <div class="notification-text">
                    <h4>Pendaftaran Berhasil!</h4>
                    <p><strong>${namaSiswa}</strong></p>
                    <small>No. Pendaftaran: ${noPendaftaran}</small><br>
                    <small>Jurusan: ${jurusan}</small><br>
                    <small class="text-warning">Menunggu verifikasi admin</small>
                </div>
                <button class="notification-close" onclick="this.parentElement.parentElement.remove()">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="notification-progress"></div>
        `;
        
        document.getElementById('notification-container').appendChild(notification);
        
        // Trigger confetti for successful registration
        this.triggerConfetti();
        
        // Auto remove after 8 seconds (longer for registration)
        setTimeout(() => {
            if (notification.parentElement) {
                notification.classList.add('fade-out');
                setTimeout(() => notification.remove(), 300);
            }
        }, 8000);
        
        // Animate progress bar
        const progressBar = notification.querySelector('.notification-progress');
        setTimeout(() => {
            progressBar.style.width = '0%';
        }, 100);
    }

    triggerConfetti() {
        // Confetti animation for successful login
        confetti({
            particleCount: 100,
            spread: 70,
            origin: { y: 0.6 },
            colors: ['#3b82f6', '#10b981', '#f59e0b', '#ef4444', '#8b5cf6']
        });
        
        // Second burst
        setTimeout(() => {
            confetti({
                particleCount: 50,
                angle: 60,
                spread: 55,
                origin: { x: 0 },
                colors: ['#3b82f6', '#10b981']
            });
        }, 200);
        
        setTimeout(() => {
            confetti({
                particleCount: 50,
                angle: 120,
                spread: 55,
                origin: { x: 1 },
                colors: ['#f59e0b', '#ef4444']
            });
        }, 400);
    }
}

// Initialize notification system
const loginNotification = new LoginNotification();

// Make it globally available
window.loginNotification = loginNotification;