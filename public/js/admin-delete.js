// Admin Delete Functionality

function confirmDeletePendaftar(form, nama, noPendaftaran) {
    // Remove existing modal if any
    const existingModal = document.querySelector('.delete-modal');
    if (existingModal) {
        existingModal.remove();
    }
    
    // Create custom modal
    const modal = document.createElement('div');
    modal.className = 'delete-modal';
    modal.innerHTML = `
        <div class="delete-modal-content">
            <div class="delete-modal-header">
                <div class="delete-modal-icon">
                    <i class="fas fa-trash-alt"></i>
                </div>
                <h3 class="delete-modal-title">Konfirmasi Hapus Data</h3>
                <p class="delete-modal-subtitle">Tindakan ini tidak dapat dibatalkan</p>
            </div>
            
            <div class="delete-modal-body">
                <div class="user-info-card">
                    <div class="user-info-header">
                        <div class="user-avatar">
                            <i class="fas fa-user"></i>
                        </div>
                        <div class="user-details">
                            <h4>${nama}</h4>
                            <p>${noPendaftaran}</p>
                        </div>
                    </div>
                </div>
                
                <div class="warning-box">
                    <div class="warning-header">
                        <i class="fas fa-exclamation-triangle"></i>
                        <p class="warning-title">Data yang akan dihapus:</p>
                    </div>
                    <ul class="warning-list">
                        <li>Data pribadi siswa</li>
                        <li>Data orang tua/wali</li>
                        <li>Semua berkas dokumen</li>
                        <li>Riwayat pendaftaran</li>
                    </ul>
                </div>
            </div>
            
            <div class="delete-modal-footer">
                <button onclick="closeDeleteModal()" class="btn-cancel">
                    Batal
                </button>
                <button onclick="proceedDelete()" class="btn-delete">
                    <i class="fas fa-trash"></i>
                    Hapus Data
                </button>
            </div>
        </div>
    `;
    
    document.body.appendChild(modal);
    
    // Store form reference
    window.deleteForm = form;
    
    // Show modal with animation
    setTimeout(() => {
        modal.classList.add('show');
    }, 10);
    
    // Prevent default form submission
    return false;
}

function closeDeleteModal() {
    const modal = document.querySelector('.delete-modal');
    if (modal) {
        modal.classList.remove('show');
        setTimeout(() => {
            modal.remove();
        }, 300);
    }
    window.deleteForm = null;
}

function proceedDelete() {
    if (window.deleteForm) {
        // Show loading state
        const button = document.querySelector('button[onclick="proceedDelete()"]');
        const originalContent = button.innerHTML;
        button.innerHTML = '<div class="loading-spinner"></div>Menghapus...';
        button.disabled = true;
        button.classList.add('opacity-75', 'cursor-not-allowed');
        
        // Disable cancel button
        const cancelButton = document.querySelector('button[onclick="closeDeleteModal()"]');
        if (cancelButton) {
            cancelButton.disabled = true;
            cancelButton.classList.add('opacity-50', 'cursor-not-allowed');
        }
        
        // Submit form after short delay for better UX
        setTimeout(() => {
            try {
                window.deleteForm.submit();
            } catch (error) {
                console.error('Error submitting form:', error);
                // Restore button state on error
                button.innerHTML = originalContent;
                button.disabled = false;
                button.classList.remove('opacity-75', 'cursor-not-allowed');
                if (cancelButton) {
                    cancelButton.disabled = false;
                    cancelButton.classList.remove('opacity-50', 'cursor-not-allowed');
                }
                alert('Terjadi kesalahan saat menghapus data. Silakan coba lagi.');
            }
        }, 500);
    }
}

// CSS sudah dimuat dari file terpisah

// Handle escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeDeleteModal();
    }
});

// Handle click outside modal
document.addEventListener('click', function(e) {
    if (e.target.classList.contains('delete-modal')) {
        closeDeleteModal();
    }
});

// Prevent accidental page refresh during delete process
window.addEventListener('beforeunload', function(e) {
    if (window.deleteForm && document.querySelector('.delete-modal')) {
        e.preventDefault();
        e.returnValue = 'Proses penghapusan sedang berlangsung. Yakin ingin meninggalkan halaman?';
        return e.returnValue;
    }
});