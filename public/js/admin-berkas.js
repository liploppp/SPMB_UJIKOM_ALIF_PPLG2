// Admin Berkas Management JavaScript

function validateFile(berkasId, jenis) {
    if (confirm('Apakah Anda yakin ingin memvalidasi berkas ' + jenis + '?')) {
        const button = event.target;
        const originalText = button.innerHTML;
        
        // Show loading state
        button.innerHTML = '<div class="spinner"></div> Memvalidasi...';
        button.disabled = true;
        
        // Get CSRF token
        const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
        
        fetch(`/admin/berkas/${berkasId}/validate`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': token,
                'Accept': 'application/json'
            },
            body: JSON.stringify({
                catatan: null
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Update UI
                button.style.display = 'none';
                
                // Update status badge
                const berkasItem = button.closest('.berkas-item');
                const statusBadge = berkasItem.querySelector('.px-2.py-1');
                if (statusBadge) {
                    statusBadge.className = 'px-2 py-1 text-xs bg-green-100 text-green-600 rounded';
                    statusBadge.textContent = 'Valid';
                }
                
                // Show success message
                showNotification('Berkas berhasil divalidasi', 'success');
            } else {
                throw new Error(data.message || 'Gagal memvalidasi berkas');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showNotification(error.message || 'Terjadi kesalahan saat memvalidasi berkas', 'error');
            
            // Restore button
            button.innerHTML = originalText;
            button.disabled = false;
        });
    }
}

function showNotification(message, type = 'info') {
    // Create notification element
    const notification = document.createElement('div');
    notification.className = `fixed top-4 right-4 z-50 p-4 rounded-lg shadow-lg transition-all duration-300 transform translate-x-full`;
    
    if (type === 'success') {
        notification.className += ' bg-green-500 text-white';
    } else if (type === 'error') {
        notification.className += ' bg-red-500 text-white';
    } else {
        notification.className += ' bg-blue-500 text-white';
    }
    
    notification.innerHTML = `
        <div class="flex items-center gap-2">
            <span>${message}</span>
            <button onclick="this.parentElement.parentElement.remove()" class="ml-2 text-white hover:text-gray-200">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                </svg>
            </button>
        </div>
    `;
    
    document.body.appendChild(notification);
    
    // Animate in
    setTimeout(() => {
        notification.classList.remove('translate-x-full');
    }, 100);
    
    // Auto remove after 5 seconds
    setTimeout(() => {
        notification.classList.add('translate-x-full');
        setTimeout(() => {
            if (notification.parentElement) {
                notification.remove();
            }
        }, 300);
    }, 5000);
}

function handleImageError(img, filename) {
    console.error('Failed to load image:', filename);
    img.style.display = 'none';
    
    const errorDiv = img.parentElement.querySelector('.error-message');
    if (errorDiv) {
        errorDiv.style.display = 'block';
    }
    
    const loadingDiv = img.parentElement.querySelector('.loading-spinner');
    if (loadingDiv) {
        loadingDiv.style.display = 'none';
    }
    
    // Show notification for failed image load
    showNotification(`Gagal memuat gambar: ${filename}`, 'error');
}

function trackFileView(filename, jenis) {
    console.log('File viewed:', filename, jenis);
    
    // Send analytics if needed
    if (typeof gtag !== 'undefined') {
        gtag('event', 'file_view', {
            'file_name': filename,
            'file_type': jenis
        });
    }
}

function trackFileDownload(filename, jenis) {
    console.log('File downloaded:', filename, jenis);
    
    // Send analytics if needed
    if (typeof gtag !== 'undefined') {
        gtag('event', 'file_download', {
            'file_name': filename,
            'file_type': jenis
        });
    }
    
    showNotification(`Mengunduh file: ${jenis}`, 'info');
}

// Initialize when DOM is loaded
document.addEventListener('DOMContentLoaded', function() {
    // Add loading states to images
    const images = document.querySelectorAll('.berkas-image');
    images.forEach(img => {
        img.addEventListener('loadstart', function() {
            const loadingDiv = this.parentElement.querySelector('.loading-spinner');
            if (loadingDiv) {
                loadingDiv.style.display = 'flex';
            }
            this.style.display = 'none';
        });
        
        img.addEventListener('load', function() {
            const loadingDiv = this.parentElement.querySelector('.loading-spinner');
            if (loadingDiv) {
                loadingDiv.style.display = 'none';
            }
            this.style.display = 'block';
        });
    });
    
    // Add hover effects to berkas items
    const berkasItems = document.querySelectorAll('.berkas-item');
    berkasItems.forEach(item => {
        item.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-2px)';
            this.style.boxShadow = '0 8px 25px rgba(0,0,0,0.15)';
        });
        
        item.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
            this.style.boxShadow = '';
        });
    });
});