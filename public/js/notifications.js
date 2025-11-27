// Modern notification system

function showNotification(message, type = 'success', duration = 5000) {
    // Create notification container if it doesn't exist
    let container = document.getElementById('notification-container');
    if (!container) {
        container = document.createElement('div');
        container.id = 'notification-container';
        container.className = 'position-fixed top-0 end-0 p-3';
        container.style.zIndex = '9999';
        document.body.appendChild(container);
    }

    // Create notification element
    const notification = document.createElement('div');
    notification.className = `toast align-items-center text-white bg-${type === 'success' ? 'success' : type === 'error' ? 'danger' : 'primary'} border-0`;
    notification.setAttribute('role', 'alert');
    notification.setAttribute('aria-live', 'assertive');
    notification.setAttribute('aria-atomic', 'true');

    notification.innerHTML = `
        <div class="d-flex">
            <div class="toast-body">
                <i class="fas fa-${type === 'success' ? 'check-circle' : type === 'error' ? 'exclamation-circle' : 'info-circle'} me-2"></i>
                ${message}
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
        </div>
    `;

    container.appendChild(notification);

    // Initialize and show toast
    const toast = new bootstrap.Toast(notification, {
        autohide: true,
        delay: duration
    });
    
    toast.show();

    // Remove element after it's hidden
    notification.addEventListener('hidden.bs.toast', function() {
        notification.remove();
    });
}

// Success notification with confetti effect
function showSuccessWithConfetti(message) {
    showNotification(message, 'success');
    
    // Add confetti effect if library is available
    if (typeof confetti !== 'undefined') {
        confetti({
            particleCount: 100,
            spread: 70,
            origin: { y: 0.6 }
        });
    }
}

// Registration success notification
function showRegistrationSuccess(noPendaftaran) {
    const message = `Pendaftaran berhasil! Nomor pendaftaran Anda: ${noPendaftaran}`;
    
    // Show modal instead of toast for registration success
    const modal = document.createElement('div');
    modal.className = 'modal fade';
    modal.innerHTML = `
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-body text-center p-5">
                    <div class="mb-4">
                        <div class="success-animation mx-auto">
                            <svg class="checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52">
                                <circle class="checkmark__circle" cx="26" cy="26" r="25" fill="none"/>
                                <path class="checkmark__check" fill="none" d="m14.1 27.2l7.1 7.2 16.7-16.8"/>
                            </svg>
                        </div>
                    </div>
                    <h3 class="text-success mb-3">🎉 Selamat!</h3>
                    <h5 class="mb-3">Pendaftaran Berhasil</h5>
                    <div class="alert alert-success">
                        <strong>Nomor Pendaftaran:</strong><br>
                        <span class="h4 text-primary">${noPendaftaran}</span>
                    </div>
                    <p class="text-muted mb-4">Silakan simpan nomor pendaftaran Anda untuk keperluan selanjutnya.</p>
                    <div class="d-flex gap-2 justify-content-center">
                        <button type="button" class="btn btn-success px-4" onclick="closeSuccessModal()">OK</button>
                        <a href="/cek-status" class="btn btn-outline-primary px-4">Cek Status</a>
                    </div>
                </div>
            </div>
        </div>
    `;
    
    document.body.appendChild(modal);
    
    const bsModal = new bootstrap.Modal(modal);
    bsModal.show();
    
    // Add confetti effect
    if (typeof confetti !== 'undefined') {
        confetti({
            particleCount: 150,
            spread: 60,
            origin: { y: 0.7 }
        });
    }
    
    // Store modal reference for closing
    window.currentSuccessModal = { element: modal, instance: bsModal };
}

function closeSuccessModal() {
    if (window.currentSuccessModal) {
        window.currentSuccessModal.instance.hide();
        setTimeout(() => {
            window.currentSuccessModal.element.remove();
            window.currentSuccessModal = null;
        }, 300);
    }
}

// Add CSS for animations
const style = document.createElement('style');
style.textContent = `
    .success-animation {
        width: 80px;
        height: 80px;
    }
    
    .checkmark {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        display: block;
        stroke-width: 2;
        stroke: #4bb71b;
        stroke-miterlimit: 10;
        box-shadow: inset 0px 0px 0px #4bb71b;
        animation: fill .4s ease-in-out .4s forwards, scale .3s ease-in-out .9s both;
    }
    
    .checkmark__circle {
        stroke-dasharray: 166;
        stroke-dashoffset: 166;
        stroke-width: 2;
        stroke-miterlimit: 10;
        stroke: #4bb71b;
        fill: none;
        animation: stroke 0.6s cubic-bezier(0.65, 0, 0.45, 1) forwards;
    }
    
    .checkmark__check {
        transform-origin: 50% 50%;
        stroke-dasharray: 48;
        stroke-dashoffset: 48;
        stroke-width: 3;
        stroke: #4bb71b;
        animation: stroke 0.3s cubic-bezier(0.65, 0, 0.45, 1) 0.8s forwards;
    }
    
    @keyframes stroke {
        100% {
            stroke-dashoffset: 0;
        }
    }
    
    @keyframes scale {
        0%, 100% {
            transform: none;
        }
        50% {
            transform: scale3d(1.1, 1.1, 1);
        }
    }
    
    @keyframes fill {
        100% {
            box-shadow: inset 0px 0px 0px 30px #4bb71b;
        }
    }
`;
document.head.appendChild(style);