<!DOCTYPE html>
<html>
<head>
    <title>Test Email PPDB</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Test Email PPDB SMK Bakti Nusantara 666</h5>
                    </div>
                    <div class="card-body">
                        <form id="testEmailForm">
                            <div class="mb-3">
                                <label for="email" class="form-label">Email Tujuan:</label>
                                <input type="email" class="form-control" id="email" name="email" value="alifnurimam2007@gmail.com" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Kirim Test Email</button>
                        </form>
                        
                        <div id="result" class="mt-3" style="display: none;"></div>
                        
                        <hr class="my-4">
                        
                        <h6>Konfigurasi Email Saat Ini:</h6>
                        <ul class="list-unstyled">
                            <li><strong>Host:</strong> {{ config('mail.host') }}</li>
                            <li><strong>Port:</strong> {{ config('mail.port') }}</li>
                            <li><strong>From:</strong> {{ config('mail.from.address') }}</li>
                            <li><strong>Name:</strong> {{ config('mail.from.name') }}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('testEmailForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const email = document.getElementById('email').value;
            const resultDiv = document.getElementById('result');
            const submitBtn = e.target.querySelector('button[type="submit"]');
            
            // Show loading
            submitBtn.disabled = true;
            submitBtn.textContent = 'Mengirim...';
            resultDiv.style.display = 'none';
            
            // Send request
            fetch('/test-email/send?email=' + encodeURIComponent(email), {
                method: 'GET'
            })
            .then(response => response.json())
            .then(data => {
                resultDiv.style.display = 'block';
                if (data.success) {
                    resultDiv.innerHTML = '<div class="alert alert-success">' + data.message + '</div>';
                } else {
                    resultDiv.innerHTML = '<div class="alert alert-danger">' + data.message + '</div>';
                }
            })
            .catch(error => {
                resultDiv.style.display = 'block';
                resultDiv.innerHTML = '<div class="alert alert-danger">Error: ' + error.message + '</div>';
            })
            .finally(() => {
                submitBtn.disabled = false;
                submitBtn.textContent = 'Kirim Test Email';
            });
        });
    </script>
</body>
</html>