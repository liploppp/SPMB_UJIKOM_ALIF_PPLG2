<script>
// Auto-format OTP input
document.addEventListener('DOMContentLoaded', function() {
    const otpInput = document.querySelector('input[name="otp_code"]');
    if (otpInput) {
        otpInput.addEventListener('input', function(e) {
            // Remove non-numeric characters
            this.value = this.value.replace(/[^0-9]/g, '');
            
            // Limit to 6 digits
            if (this.value.length > 6) {
                this.value = this.value.slice(0, 6);
            }
        });
        
        // Focus on OTP input when section is visible
        otpInput.focus();
    }
});
</script>