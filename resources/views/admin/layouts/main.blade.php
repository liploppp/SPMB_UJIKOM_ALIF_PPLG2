<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title', 'Admin PPDB SMK BAKTI NUSANTARA 666')</title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="{{ asset('tamplate_admin/assets/css/nucleo-icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('tamplate_admin/assets/css/nucleo-svg.css') }}" rel="stylesheet" />
    <link href="{{ asset('tamplate_admin/assets/css/soft-ui-dashboard-tailwind.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/admin-master.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/admin-custom.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/admin-delete.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/delete-modal.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/admin-detail.css') }}" rel="stylesheet" />
    @yield('head')
    @yield('styles')
</head>

<body class="m-0 font-sans antialiased font-normal text-base leading-default bg-gray-50 text-slate-500">
    @include('admin.partials_admin.sidebar')
    
    <main class="ease-soft-in-out xl:ml-68.5 relative h-full max-h-screen rounded-xl transition-all duration-200">
        @include('admin.partials_admin.navbar')
        
        <div class="w-full px-6 py-6 mx-auto">
            @yield('content')
        </div>
        
        @include('admin.partials_admin.footer')
    </main>

    <script src="{{ asset('tamplate_admin/assets/js/plugins/perfect-scrollbar.min.js') }}" async></script>
    <script src="{{ asset('tamplate_admin/assets/js/sidenav-burger.js') }}" async></script>
    <script src="{{ asset('tamplate_admin/assets/js/navbar-collapse.js') }}" async></script>
    <script src="{{ asset('tamplate_admin/assets/js/soft-ui-dashboard-tailwind.js') }}" async></script>
    <script src="{{ asset('js/admin-master.js') }}"></script>
    <script src="{{ asset('js/admin-enhancements.js') }}"></script>
    <script src="{{ asset('js/admin-notifications.js') }}"></script>
    @yield('scripts')
    @stack('scripts')
</body>
</html>