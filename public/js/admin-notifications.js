// Modern Admin Notifications
document.addEventListener('DOMContentLoaded', function() {
    // Show success messages
    const successMessage = document.querySelector('[data-success-message]');
    if (successMessage) {
        showNotification(successMessage.dataset.successMessage, 'success');
    }

    // Show error messages
    const errorMessage = document.querySelector('[data-error-message]');
    if (errorMessage) {
        showNotification(errorMessage.dataset.errorMessage, 'error');
    }
});

function showNotification(message, type = 'info') {
    const notification = document.createElement('div');
    notification.className = `notification notification-${type}`;
    
    const icon = type === 'success' ? 'fas fa-check-circle' : 
                 type === 'error' ? 'fas fa-exclamation-circle' : 
                 'fas fa-info-circle';
    
    notification.innerHTML = `
        <div class="notification-content">
            <i class="${icon}"></i>
            <span>${message}</span>
        </div>
        <button class="notification-close" onclick="closeNotification(this.parentElement)">
            <i class="fas fa-times"></i>
        </button>
    `;
    
    document.body.appendChild(notification);
    
    // Auto remove after 5 seconds
    setTimeout(() => {
        closeNotification(notification);
    }, 5000);
}

function closeNotification(notification) {
    notification.style.animation = 'slideOutRight 0.3s ease-in-out';
    setTimeout(() => {
        if (notification.parentElement) {
            notification.parentElement.removeChild(notification);
        }
    }, 300);
}

// Confirm delete function
function confirmDeletePendaftar(form, nama, noPendaftaran) {
    const modal = document.createElement('div');
    modal.className = 'delete-modal-overlay';
    modal.innerHTML = `
        <div class="delete-modal">
            <div class="delete-modal-header">
                <i class="fas fa-exclamation-triangle text-danger"></i>
                <h4>Konfirmasi Hapus</h4>
            </div>
            <div class="delete-modal-body">
                <p>Apakah Anda yakin ingin menghapus data pendaftar:</p>
                <div class="delete-info">
                    <strong>${nama}</strong><br>
                    <small class="text-muted">${noPendaftaran}</small>
                </div>
                <p class="text-danger small mt-2">
                    <i class="fas fa-warning"></i> 
                    Tindakan ini tidak dapat dibatalkan dan akan menghapus semua data terkait.
                </p>
            </div>
            <div class="delete-modal-footer">
                <button type="button" class="btn btn-secondary" onclick="closeDeleteModal()">
                    <i class="fas fa-times"></i> Batal
                </button>
                <button type="button" class="btn btn-danger" onclick="confirmDelete()">
                    <i class="fas fa-trash"></i> Hapus
                </button>
            </div>
        </div>
    `;
    
    document.body.appendChild(modal);
    
    // Store form reference
    window.deleteForm = form;
    
    // Add animation
    setTimeout(() => {
        modal.querySelector('.delete-modal').style.transform = 'scale(1)';
        modal.querySelector('.delete-modal').style.opacity = '1';
    }, 10);
}

function closeDeleteModal() {
    const modal = document.querySelector('.delete-modal-overlay');
    if (modal) {
        modal.querySelector('.delete-modal').style.transform = 'scale(0.8)';
        modal.querySelector('.delete-modal').style.opacity = '0';
        setTimeout(() => {
            document.body.removeChild(modal);
        }, 200);
    }
}

function confirmDelete() {
    if (window.deleteForm) {
        // Show loading
        const deleteBtn = document.querySelector('.delete-modal .btn-danger');
        deleteBtn.innerHTML = '<div class="loading"></div> Menghapus...';
        deleteBtn.disabled = true;
        
        // Submit form
        window.deleteForm.submit();
    }
}

// Loading states for buttons
document.addEventListener('click', function(e) {
    if (e.target.matches('.btn[type="submit"]') || e.target.closest('.btn[type="submit"]')) {
        const btn = e.target.matches('.btn') ? e.target : e.target.closest('.btn');
        const originalText = btn.innerHTML;
        
        btn.innerHTML = '<div class="loading"></div> Memproses...';
        btn.disabled = true;
        
        // Restore after 10 seconds (fallback)
        setTimeout(() => {
            btn.innerHTML = originalText;
            btn.disabled = false;
        }, 10000);
    }
});