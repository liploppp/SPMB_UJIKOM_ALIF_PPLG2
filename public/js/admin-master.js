// Admin Master JavaScript - Global Functions for All Admin Pages

class AdminMaster {
    constructor() {
        this.init();
    }

    init() {
        this.initNotifications();
        this.initModals();
        this.initTables();
        this.initForms();
        this.initTooltips();
        this.checkSessionMessages();
    }

    // Notification System
    initNotifications() {
        this.notificationContainer = document.createElement('div');
        this.notificationContainer.id = 'notification-container';
        this.notificationContainer.className = 'fixed top-4 right-4 z-50 space-y-2';
        document.body.appendChild(this.notificationContainer);
    }

    showNotification(message, type = 'info', duration = 5000) {
        const notification = document.createElement('div');
        notification.className = `notification ${type}`;
        
        const icons = {
            success: '<i class="fas fa-check-circle"></i>',
            error: '<i class="fas fa-exclamation-circle"></i>',
            warning: '<i class="fas fa-exclamation-triangle"></i>',
            info: '<i class="fas fa-info-circle"></i>'
        };

        notification.innerHTML = `
            <div class="flex items-start gap-3">
                <div class="text-${type === 'error' ? 'red' : type === 'success' ? 'green' : type === 'warning' ? 'yellow' : 'blue'}-500">
                    ${icons[type]}
                </div>
                <div class="flex-1">
                    <p class="text-sm font-medium text-gray-800">${message}</p>
                </div>
                <button onclick="this.parentElement.parentElement.remove()" class="text-gray-400 hover:text-gray-600">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        `;

        this.notificationContainer.appendChild(notification);
        
        // Show animation
        setTimeout(() => notification.classList.add('show'), 100);

        // Auto remove
        if (duration > 0) {
            setTimeout(() => {
                notification.classList.remove('show');
                setTimeout(() => notification.remove(), 300);
            }, duration);
        }

        return notification;
    }

    checkSessionMessages() {
        // Check for Laravel session messages
        const successMsg = document.querySelector('[data-success-message]');
        if (successMsg) {
            this.showNotification(successMsg.getAttribute('data-success-message'), 'success');
            successMsg.remove();
        }

        const errorMsg = document.querySelector('[data-error-message]');
        if (errorMsg) {
            this.showNotification(errorMsg.getAttribute('data-error-message'), 'error');
            errorMsg.remove();
        }
    }

    // Modal System
    initModals() {
        // Close modal on escape key
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') {
                this.closeAllModals();
            }
        });

        // Close modal on backdrop click
        document.addEventListener('click', (e) => {
            if (e.target.classList.contains('modal-overlay')) {
                this.closeModal(e.target);
            }
        });
    }

    showModal(content, options = {}) {
        const modal = document.createElement('div');
        modal.className = 'modal-overlay';
        modal.innerHTML = `
            <div class="modal-content">
                ${options.header ? `
                    <div class="modal-header">
                        <h3 class="modal-title">${options.header}</h3>
                    </div>
                ` : ''}
                <div class="modal-body">
                    ${content}
                </div>
                ${options.footer ? `
                    <div class="modal-footer">
                        ${options.footer}
                    </div>
                ` : ''}
            </div>
        `;

        document.body.appendChild(modal);
        setTimeout(() => modal.classList.add('show'), 10);
        
        return modal;
    }

    closeModal(modal) {
        modal.classList.remove('show');
        setTimeout(() => modal.remove(), 300);
    }

    closeAllModals() {
        document.querySelectorAll('.modal-overlay').forEach(modal => {
            this.closeModal(modal);
        });
    }

    // Table Enhancements
    initTables() {
        // Add hover effects and sorting
        document.querySelectorAll('.admin-table').forEach(table => {
            this.enhanceTable(table);
        });
    }

    enhanceTable(table) {
        // Add row hover effects
        const rows = table.querySelectorAll('tbody tr');
        rows.forEach(row => {
            row.addEventListener('mouseenter', () => {
                row.style.backgroundColor = 'var(--gray-50)';
            });
            row.addEventListener('mouseleave', () => {
                row.style.backgroundColor = '';
            });
        });

        // Add loading state for action buttons
        const actionButtons = table.querySelectorAll('.action-buttons button');
        actionButtons.forEach(button => {
            button.addEventListener('click', (e) => {
                if (!button.disabled) {
                    this.showButtonLoading(button);
                }
            });
        });
    }

    showButtonLoading(button) {
        const originalContent = button.innerHTML;
        button.innerHTML = '<div class="spinner"></div>';
        button.disabled = true;
        
        // Restore after 3 seconds if not handled elsewhere
        setTimeout(() => {
            if (button.disabled) {
                button.innerHTML = originalContent;
                button.disabled = false;
            }
        }, 3000);
    }

    // Form Enhancements
    initForms() {
        // Add form validation and enhancements
        document.querySelectorAll('form').forEach(form => {
            this.enhanceForm(form);
        });
    }

    enhanceForm(form) {
        // Add loading state on submit
        form.addEventListener('submit', (e) => {
            const submitButton = form.querySelector('button[type="submit"]');
            if (submitButton && !submitButton.disabled) {
                this.showButtonLoading(submitButton);
            }
        });

        // Add real-time validation
        const inputs = form.querySelectorAll('.form-control');
        inputs.forEach(input => {
            input.addEventListener('blur', () => {
                this.validateField(input);
            });
        });
    }

    validateField(field) {
        // Basic validation
        const isValid = field.checkValidity();
        
        if (isValid) {
            field.classList.remove('border-red-300');
            field.classList.add('border-green-300');
        } else {
            field.classList.remove('border-green-300');
            field.classList.add('border-red-300');
        }
    }

    // Tooltip System
    initTooltips() {
        document.querySelectorAll('[data-tooltip]').forEach(element => {
            this.addTooltip(element);
        });
    }

    addTooltip(element) {
        let tooltip = null;

        element.addEventListener('mouseenter', () => {
            const text = element.getAttribute('data-tooltip');
            if (!text) return;

            tooltip = document.createElement('div');
            tooltip.className = 'tooltip';
            tooltip.textContent = text;
            tooltip.style.cssText = `
                position: absolute;
                background: rgba(0, 0, 0, 0.8);
                color: white;
                padding: 6px 12px;
                border-radius: 6px;
                font-size: 12px;
                white-space: nowrap;
                z-index: 10000;
                pointer-events: none;
                opacity: 0;
                transition: opacity 0.2s ease;
            `;

            document.body.appendChild(tooltip);

            const rect = element.getBoundingClientRect();
            tooltip.style.left = rect.left + (rect.width / 2) - (tooltip.offsetWidth / 2) + 'px';
            tooltip.style.top = rect.top - tooltip.offsetHeight - 8 + 'px';

            setTimeout(() => tooltip.style.opacity = '1', 10);
        });

        element.addEventListener('mouseleave', () => {
            if (tooltip) {
                tooltip.style.opacity = '0';
                setTimeout(() => tooltip.remove(), 200);
                tooltip = null;
            }
        });
    }

    // Utility Functions
    formatNumber(num) {
        return new Intl.NumberFormat('id-ID').format(num);
    }

    formatDate(date) {
        return new Intl.DateTimeFormat('id-ID', {
            year: 'numeric',
            month: 'long',
            day: 'numeric'
        }).format(new Date(date));
    }

    formatDateTime(date) {
        return new Intl.DateTimeFormat('id-ID', {
            year: 'numeric',
            month: 'long',
            day: 'numeric',
            hour: '2-digit',
            minute: '2-digit'
        }).format(new Date(date));
    }

    // AJAX Helper
    async request(url, options = {}) {
        const defaultOptions = {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content')
            }
        };

        const config = { ...defaultOptions, ...options };
        
        try {
            const response = await fetch(url, config);
            
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            
            return await response.json();
        } catch (error) {
            this.showNotification('Terjadi kesalahan: ' + error.message, 'error');
            throw error;
        }
    }

    // Confirmation Dialog
    confirm(message, options = {}) {
        return new Promise((resolve) => {
            const modal = this.showModal(`
                <div class="text-center">
                    <div class="w-16 h-16 mx-auto mb-4 bg-yellow-100 rounded-full flex items-center justify-center">
                        <i class="fas fa-question-circle text-2xl text-yellow-600"></i>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-800 mb-2">${options.title || 'Konfirmasi'}</h3>
                    <p class="text-gray-600 mb-6">${message}</p>
                </div>
            `, {
                footer: `
                    <button onclick="adminMaster.closeModal(this.closest('.modal-overlay')); resolve(false)" class="btn btn-secondary">
                        ${options.cancelText || 'Batal'}
                    </button>
                    <button onclick="adminMaster.closeModal(this.closest('.modal-overlay')); resolve(true)" class="btn btn-primary">
                        ${options.confirmText || 'Ya'}
                    </button>
                `
            });

            // Store resolve function for button clicks
            window.resolve = resolve;
        });
    }

    // Loading Overlay
    showLoading(message = 'Memuat...') {
        const loading = document.createElement('div');
        loading.id = 'loading-overlay';
        loading.className = 'modal-overlay show';
        loading.innerHTML = `
            <div class="bg-white rounded-lg p-8 text-center">
                <div class="spinner mx-auto mb-4" style="width: 40px; height: 40px;"></div>
                <p class="text-gray-600">${message}</p>
            </div>
        `;
        document.body.appendChild(loading);
        return loading;
    }

    hideLoading() {
        const loading = document.getElementById('loading-overlay');
        if (loading) {
            loading.remove();
        }
    }
}

// Initialize Admin Master
const adminMaster = new AdminMaster();

// Global helper functions
window.showNotification = (message, type, duration) => adminMaster.showNotification(message, type, duration);
window.showModal = (content, options) => adminMaster.showModal(content, options);
window.closeModal = (modal) => adminMaster.closeModal(modal);
window.showLoading = (message) => adminMaster.showLoading(message);
window.hideLoading = () => adminMaster.hideLoading();
window.confirmAction = (message, options) => adminMaster.confirm(message, options);

// Enhanced console logging for development
if (window.location.hostname === 'localhost' || window.location.hostname === '127.0.0.1') {
    console.log('🚀 Admin Master initialized');
    console.log('📋 Available functions:', {
        showNotification: 'showNotification(message, type, duration)',
        showModal: 'showModal(content, options)',
        confirmAction: 'confirmAction(message, options)',
        showLoading: 'showLoading(message)',
        hideLoading: 'hideLoading()'
    });
}