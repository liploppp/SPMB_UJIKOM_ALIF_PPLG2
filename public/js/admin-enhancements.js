// Admin UI Enhancements

document.addEventListener('DOMContentLoaded', function() {
    // Add animation classes to elements
    addAnimations();
    
    // Initialize tooltips
    initTooltips();
    
    // Add loading states
    initLoadingStates();
    
    // Add smooth scrolling
    initSmoothScrolling();
    
    // Add search enhancements
    initSearchEnhancements();
});

function addAnimations() {
    // Animate cards on load
    const cards = document.querySelectorAll('.shadow-soft-xl');
    cards.forEach((card, index) => {
        card.style.animationDelay = `${index * 0.1}s`;
        card.classList.add('animate-fade-in-up');
    });
    
    // Animate table rows
    const tableRows = document.querySelectorAll('tbody tr');
    tableRows.forEach((row, index) => {
        row.style.animationDelay = `${index * 0.05}s`;
        row.classList.add('animate-slide-in-right');
        row.classList.add('table-row-hover');
    });
    
    // Add hover effects to buttons
    const buttons = document.querySelectorAll('button, .btn');
    buttons.forEach(button => {
        button.addEventListener('mouseenter', function() {
            this.style.transform = 'scale(1.02)';
        });
        
        button.addEventListener('mouseleave', function() {
            this.style.transform = 'scale(1)';
        });
    });
}

function initTooltips() {
    // Add tooltips to action buttons
    const actionButtons = document.querySelectorAll('[data-tooltip]');
    actionButtons.forEach(button => {
        button.addEventListener('mouseenter', showTooltip);
        button.addEventListener('mouseleave', hideTooltip);
    });
}

function showTooltip(e) {
    const tooltip = document.createElement('div');
    tooltip.className = 'absolute z-50 px-2 py-1 text-xs text-white bg-gray-900 rounded shadow-lg tooltip';
    tooltip.textContent = e.target.getAttribute('data-tooltip');
    
    document.body.appendChild(tooltip);
    
    const rect = e.target.getBoundingClientRect();
    tooltip.style.left = rect.left + (rect.width / 2) - (tooltip.offsetWidth / 2) + 'px';
    tooltip.style.top = rect.top - tooltip.offsetHeight - 5 + 'px';
}

function hideTooltip() {
    const tooltip = document.querySelector('.tooltip');
    if (tooltip) {
        tooltip.remove();
    }
}

function initLoadingStates() {
    // Add loading state to forms
    const forms = document.querySelectorAll('form');
    forms.forEach(form => {
        form.addEventListener('submit', function() {
            const submitBtn = this.querySelector('button[type="submit"]');
            if (submitBtn) {
                const originalText = submitBtn.innerHTML;
                submitBtn.innerHTML = '<div class="spinner mr-2"></div>Memproses...';
                submitBtn.disabled = true;
                
                // Reset after 5 seconds (fallback)
                setTimeout(() => {
                    submitBtn.innerHTML = originalText;
                    submitBtn.disabled = false;
                }, 5000);
            }
        });
    });
}

function initSmoothScrolling() {
    // Smooth scroll for anchor links
    const anchorLinks = document.querySelectorAll('a[href^="#"]');
    anchorLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });
}

function initSearchEnhancements() {
    const searchInput = document.querySelector('input[name="search"]');
    if (searchInput) {
        // Add search icon animation
        const searchIcon = searchInput.parentElement.querySelector('.fa-search');
        
        searchInput.addEventListener('focus', function() {
            if (searchIcon) {
                searchIcon.classList.add('animate-pulse-slow');
            }
            this.parentElement.style.transform = 'scale(1.02)';
        });
        
        searchInput.addEventListener('blur', function() {
            if (searchIcon) {
                searchIcon.classList.remove('animate-pulse-slow');
            }
            this.parentElement.style.transform = 'scale(1)';
        });
        
        // Add real-time search feedback
        let searchTimeout;
        searchInput.addEventListener('input', function() {
            clearTimeout(searchTimeout);
            const value = this.value;
            
            if (value.length > 0) {
                this.style.borderColor = '#8b5cf6';
                this.style.boxShadow = '0 0 0 3px rgba(139, 92, 246, 0.1)';
            } else {
                this.style.borderColor = '#e2e8f0';
                this.style.boxShadow = 'none';
            }
        });
    }
}

// Add notification system
function showNotification(message, type = 'success') {
    const notification = document.createElement('div');
    notification.className = `fixed top-4 right-4 z-50 p-4 rounded-lg shadow-lg transition-all duration-300 transform translate-x-full ${
        type === 'success' ? 'bg-green-500' : 
        type === 'error' ? 'bg-red-500' : 
        type === 'warning' ? 'bg-yellow-500' : 'bg-blue-500'
    } text-white`;
    
    notification.innerHTML = `
        <div class="flex items-center">
            <i class="fas fa-${type === 'success' ? 'check' : type === 'error' ? 'times' : type === 'warning' ? 'exclamation' : 'info'} mr-2"></i>
            <span>${message}</span>
            <button onclick="this.parentElement.parentElement.remove()" class="ml-4 text-white hover:text-gray-200">
                <i class="fas fa-times"></i>
            </button>
        </div>
    `;
    
    document.body.appendChild(notification);
    
    // Animate in
    setTimeout(() => {
        notification.classList.remove('translate-x-full');
    }, 100);
    
    // Auto remove
    setTimeout(() => {
        notification.classList.add('translate-x-full');
        setTimeout(() => notification.remove(), 300);
    }, 5000);
}

// Add keyboard shortcuts
document.addEventListener('keydown', function(e) {
    // Ctrl/Cmd + K for search focus
    if ((e.ctrlKey || e.metaKey) && e.key === 'k') {
        e.preventDefault();
        const searchInput = document.querySelector('input[name="search"]');
        if (searchInput) {
            searchInput.focus();
        }
    }
    
    // Escape to clear search
    if (e.key === 'Escape') {
        const searchInput = document.querySelector('input[name="search"]');
        if (searchInput && document.activeElement === searchInput) {
            searchInput.value = '';
            searchInput.blur();
        }
    }
});

// Add progress bar for page loads
function showProgressBar() {
    const progressBar = document.createElement('div');
    progressBar.className = 'fixed top-0 left-0 w-full h-1 bg-gradient-to-r from-purple-500 to-pink-500 z-50 transition-all duration-300';
    progressBar.style.width = '0%';
    document.body.appendChild(progressBar);
    
    let width = 0;
    const interval = setInterval(() => {
        width += Math.random() * 10;
        if (width >= 90) {
            clearInterval(interval);
        }
        progressBar.style.width = Math.min(width, 90) + '%';
    }, 100);
    
    window.addEventListener('load', () => {
        progressBar.style.width = '100%';
        setTimeout(() => progressBar.remove(), 500);
    });
}

// Initialize progress bar
if (document.readyState === 'loading') {
    showProgressBar();
}