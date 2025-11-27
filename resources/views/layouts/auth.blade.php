<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>SMK BAKTINUSANTARA 666</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Raleway:wght@600;800&display=swap" rel="stylesheet"> 

    <!-- Icon Font Stylesheet -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    
    <!-- Login Notification Styles -->
    <link href="{{ asset('css/login-notifications.css') }}" rel="stylesheet">
</head>

<body class="bg-light">
    @yield('content')

    <!-- JavaScript Libraries -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('lib/waypoints/waypoints.min.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    
    <!-- Confetti Library -->
    <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.6.0/dist/confetti.browser.min.js"></script>
    
    <!-- Login Notification System -->
    <script src="{{ asset('js/login-notifications.js') }}"></script>
    
    <!-- Show Login Success Notification -->
    @if(session('login_success'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const loginData = @json(session('login_success'));
            loginNotification.showLoginSuccess(loginData.user_name, loginData.role);
        });
    </script>
    @endif
</body>
</html>