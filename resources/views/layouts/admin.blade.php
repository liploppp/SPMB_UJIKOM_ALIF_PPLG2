<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Admin PPDB SMK BAKTI NUSANTARA 666</title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="{{ asset('assets/css/nucleo-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/nucleo-svg.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/soft-ui-dashboard-tailwind.css') }}" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @stack('styles')
</head>
<body class="m-0 font-sans antialiased font-normal text-base leading-default bg-gray-50 text-slate-500">
    <!-- Sidebar -->
    <aside class="max-w-62.5 ease-nav-brand z-990 fixed inset-y-0 my-4 ml-4 block w-full -translate-x-full flex-wrap items-center justify-between overflow-y-auto rounded-2xl border-0 bg-white p-0 antialiased shadow-soft-xl transition-transform duration-200 xl:left-0 xl:translate-x-0 xl:bg-transparent">
        <div class="h-19.5">
            <i class="absolute top-0 right-0 hidden p-4 opacity-50 cursor-pointer fas fa-times text-slate-400 xl:hidden" sidenav-close></i>
            <a class="block px-8 py-6 m-0 text-sm whitespace-nowrap text-slate-700" href="{{ route('admin.dashboard') }}">
                <img src="{{ asset('assets/img/logo-ct.png') }}" class="inline h-full max-w-full transition-all duration-200 ease-nav-brand max-h-8" alt="main_logo">
                <span class="ml-1 font-semibold transition-all duration-200 ease-nav-brand">PPDB Admin</span>
            </a>
        </div>

        <hr class="h-px mt-0 bg-transparent bg-gradient-to-r from-transparent via-black/40 to-transparent">

        <div class="items-center block w-auto max-h-screen overflow-auto h-sidenav grow basis-full">
            <ul class="flex flex-col pl-0 mb-0">
                <li class="mt-0.5 w-full">
                    <a class="py-2.7 {{ request()->routeIs('admin.dashboard') ? 'shadow-soft-xl text-sm ease-nav-brand my-0 mx-4 flex items-center whitespace-nowrap rounded-lg bg-white px-4 font-semibold text-slate-700 transition-colors' : 'text-sm ease-nav-brand my-0 mx-4 flex items-center whitespace-nowrap px-4 transition-colors' }}" href="{{ route('admin.dashboard') }}">
                        <div class="{{ request()->routeIs('admin.dashboard') ? 'bg-gradient-to-tl from-purple-700 to-pink-500 shadow-soft-2xl mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-white bg-center stroke-0 text-center xl:p-2.5' : 'shadow-soft-2xl mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-white bg-center stroke-0 text-center xl:p-2.5' }}">
                            <i class="fas fa-tachometer-alt {{ request()->routeIs('admin.dashboard') ? 'text-white' : 'text-slate-800 opacity-60' }} text-sm"></i>
                        </div>
                        <span class="ml-1 duration-300 opacity-100 pointer-events-none ease-soft">Dashboard</span>
                    </a>
                </li>

                @if(session('admin_role') != 'keuangan')
                <li class="mt-0.5 w-full">
                    <a class="py-2.7 {{ request()->routeIs('admin.pendaftar.*') ? 'shadow-soft-xl text-sm ease-nav-brand my-0 mx-4 flex items-center whitespace-nowrap rounded-lg bg-white px-4 font-semibold text-slate-700 transition-colors' : 'text-sm ease-nav-brand my-0 mx-4 flex items-center whitespace-nowrap px-4 transition-colors' }}" href="{{ route('admin.pendaftar.index') }}">
                        <div class="shadow-soft-2xl mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-white bg-center stroke-0 text-center xl:p-2.5">
                            <i class="fas fa-users fill-slate-800 opacity-60 text-sm"></i>
                        </div>
                        <span class="ml-1 duration-300 opacity-100 pointer-events-none ease-soft">Data Pendaftar</span>
                    </a>
                </li>
                @endif



                @if(session('admin_role') == 'admin')
                <li class="w-full mt-4">
                    <h6 class="pl-6 ml-2 font-bold leading-tight uppercase text-xs opacity-60">Master Data</h6>
                </li>

                <li class="mt-0.5 w-full">
                    <a class="py-2.7 {{ request()->routeIs('admin.jurusan.*') ? 'shadow-soft-xl text-sm ease-nav-brand my-0 mx-4 flex items-center whitespace-nowrap rounded-lg bg-white px-4 font-semibold text-slate-700 transition-colors' : 'text-sm ease-nav-brand my-0 mx-4 flex items-center whitespace-nowrap px-4 transition-colors' }}" href="{{ route('admin.jurusan.index') }}">
                        <div class="shadow-soft-2xl mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-white bg-center stroke-0 text-center xl:p-2.5">
                            <i class="fas fa-graduation-cap fill-slate-800 opacity-60 text-sm"></i>
                        </div>
                        <span class="ml-1 duration-300 opacity-100 pointer-events-none ease-soft">Jurusan</span>
                    </a>
                </li>

                <li class="mt-0.5 w-full">
                    <a class="py-2.7 {{ request()->routeIs('admin.gelombang.*') ? 'shadow-soft-xl text-sm ease-nav-brand my-0 mx-4 flex items-center whitespace-nowrap rounded-lg bg-white px-4 font-semibold text-slate-700 transition-colors' : 'text-sm ease-nav-brand my-0 mx-4 flex items-center whitespace-nowrap px-4 transition-colors' }}" href="{{ route('admin.gelombang.index') }}">
                        <div class="shadow-soft-2xl mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-white bg-center stroke-0 text-center xl:p-2.5">
                            <i class="fas fa-calendar-alt fill-slate-800 opacity-60 text-sm"></i>
                        </div>
                        <span class="ml-1 duration-300 opacity-100 pointer-events-none ease-soft">Gelombang</span>
                    </a>
                </li>

                <li class="mt-0.5 w-full">
                    <a class="py-2.7 {{ request()->routeIs('admin.wilayah.*') ? 'shadow-soft-xl text-sm ease-nav-brand my-0 mx-4 flex items-center whitespace-nowrap rounded-lg bg-white px-4 font-semibold text-slate-700 transition-colors' : 'text-sm ease-nav-brand my-0 mx-4 flex items-center whitespace-nowrap px-4 transition-colors' }}" href="{{ route('admin.wilayah.index') }}">
                        <div class="shadow-soft-2xl mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-white bg-center stroke-0 text-center xl:p-2.5">
                            <i class="fas fa-map-marker-alt fill-slate-800 opacity-60 text-sm"></i>
                        </div>
                        <span class="ml-1 duration-300 opacity-100 pointer-events-none ease-soft">Wilayah</span>
                    </a>
                </li>

                <li class="mt-0.5 w-full">
                    <a class="py-2.7 {{ request()->routeIs('admin.pengguna.*') ? 'shadow-soft-xl text-sm ease-nav-brand my-0 mx-4 flex items-center whitespace-nowrap rounded-lg bg-white px-4 font-semibold text-slate-700 transition-colors' : 'text-sm ease-nav-brand my-0 mx-4 flex items-center whitespace-nowrap px-4 transition-colors' }}" href="{{ route('admin.pengguna.index') }}">
                        <div class="shadow-soft-2xl mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-white bg-center stroke-0 text-center xl:p-2.5">
                            <i class="fas fa-user-cog fill-slate-800 opacity-60 text-sm"></i>
                        </div>
                        <span class="ml-1 duration-300 opacity-100 pointer-events-none ease-soft">Pengguna</span>
                    </a>
                </li>
                @endif

                @if(session('admin_role') == 'keuangan')
                <li class="w-full mt-4">
                    <h6 class="pl-6 ml-2 font-bold leading-tight uppercase text-xs opacity-60">Keuangan</h6>
                </li>

                <li class="mt-0.5 w-full">
                    <a class="py-2.7 {{ request()->routeIs('admin.pembayaran.*') ? 'shadow-soft-xl text-sm ease-nav-brand my-0 mx-4 flex items-center whitespace-nowrap rounded-lg bg-white px-4 font-semibold text-slate-700 transition-colors' : 'text-sm ease-nav-brand my-0 mx-4 flex items-center whitespace-nowrap px-4 transition-colors' }}" href="{{ route('admin.pembayaran.index') }}">
                        <div class="shadow-soft-2xl mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-white bg-center stroke-0 text-center xl:p-2.5">
                            <i class="fas fa-money-check-alt fill-slate-800 opacity-60 text-sm"></i>
                        </div>
                        <span class="ml-1 duration-300 opacity-100 pointer-events-none ease-soft">Verifikasi Pembayaran</span>
                    </a>
                </li>

                <li class="mt-0.5 w-full">
                    <a class="py-2.7 {{ request()->routeIs('admin.keuangan.rekap') ? 'shadow-soft-xl text-sm ease-nav-brand my-0 mx-4 flex items-center whitespace-nowrap rounded-lg bg-white px-4 font-semibold text-slate-700 transition-colors' : 'text-sm ease-nav-brand my-0 mx-4 flex items-center whitespace-nowrap px-4 transition-colors' }}" href="{{ route('admin.keuangan.rekap') }}">
                        <div class="shadow-soft-2xl mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-white bg-center stroke-0 text-center xl:p-2.5">
                            <i class="fas fa-file-invoice-dollar fill-slate-800 opacity-60 text-sm"></i>
                        </div>
                        <span class="ml-1 duration-300 opacity-100 pointer-events-none ease-soft">Rekap Pembayaran</span>
                    </a>
                </li>

                <li class="mt-0.5 w-full">
                    <a class="py-2.7 {{ request()->routeIs('admin.keuangan.daftar') ? 'shadow-soft-xl text-sm ease-nav-brand my-0 mx-4 flex items-center whitespace-nowrap rounded-lg bg-white px-4 font-semibold text-slate-700 transition-colors' : 'text-sm ease-nav-brand my-0 mx-4 flex items-center whitespace-nowrap px-4 transition-colors' }}" href="{{ route('admin.keuangan.daftar') }}">
                        <div class="shadow-soft-2xl mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-white bg-center stroke-0 text-center xl:p-2.5">
                            <i class="fas fa-list-alt fill-slate-800 opacity-60 text-sm"></i>
                        </div>
                        <span class="ml-1 duration-300 opacity-100 pointer-events-none ease-soft">Daftar Pembayaran</span>
                    </a>
                </li>
                @endif

                @if(session('admin_role') == 'kepsek')
                <li class="w-full mt-4">
                    <h6 class="pl-6 ml-2 font-bold leading-tight uppercase text-xs opacity-60">Monitoring</h6>
                </li>

                <li class="mt-0.5 w-full">
                    <a class="py-2.7 {{ request()->routeIs('admin.monitoring.diterima') ? 'shadow-soft-xl text-sm ease-nav-brand my-0 mx-4 flex items-center whitespace-nowrap rounded-lg bg-white px-4 font-semibold text-slate-700 transition-colors' : 'text-sm ease-nav-brand my-0 mx-4 flex items-center whitespace-nowrap px-4 transition-colors' }}" href="{{ route('admin.monitoring.diterima') }}">
                        <div class="shadow-soft-2xl mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-white bg-center stroke-0 text-center xl:p-2.5">
                            <i class="fas fa-user-check fill-slate-800 opacity-60 text-sm"></i>
                        </div>
                        <span class="ml-1 duration-300 opacity-100 pointer-events-none ease-soft">Siswa Diterima</span>
                    </a>
                </li>

                <li class="mt-0.5 w-full">
                    <a class="py-2.7 {{ request()->routeIs('admin.monitoring.asal-sekolah') ? 'shadow-soft-xl text-sm ease-nav-brand my-0 mx-4 flex items-center whitespace-nowrap rounded-lg bg-white px-4 font-semibold text-slate-700 transition-colors' : 'text-sm ease-nav-brand my-0 mx-4 flex items-center whitespace-nowrap px-4 transition-colors' }}" href="{{ route('admin.monitoring.asal-sekolah') }}">
                        <div class="shadow-soft-2xl mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-white bg-center stroke-0 text-center xl:p-2.5">
                            <i class="fas fa-school fill-slate-800 opacity-60 text-sm"></i>
                        </div>
                        <span class="ml-1 duration-300 opacity-100 pointer-events-none ease-soft">Data Asal Sekolah</span>
                    </a>
                </li>

                <li class="mt-0.5 w-full">
                    <a class="py-2.7 {{ request()->routeIs('admin.monitoring.asal-wilayah') ? 'shadow-soft-xl text-sm ease-nav-brand my-0 mx-4 flex items-center whitespace-nowrap rounded-lg bg-white px-4 font-semibold text-slate-700 transition-colors' : 'text-sm ease-nav-brand my-0 mx-4 flex items-center whitespace-nowrap px-4 transition-colors' }}" href="{{ route('admin.monitoring.asal-wilayah') }}">
                        <div class="shadow-soft-2xl mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-white bg-center stroke-0 text-center xl:p-2.5">
                            <i class="fas fa-globe-asia fill-slate-800 opacity-60 text-sm"></i>
                        </div>
                        <span class="ml-1 duration-300 opacity-100 pointer-events-none ease-soft">Data Asal Wilayah</span>
                    </a>
                </li>
                @endif

                <li class="mt-0.5 w-full">
                    <a class="py-2.7 {{ request()->routeIs('admin.reports.*') ? 'shadow-soft-xl text-sm ease-nav-brand my-0 mx-4 flex items-center whitespace-nowrap rounded-lg bg-white px-4 font-semibold text-slate-700 transition-colors' : 'text-sm ease-nav-brand my-0 mx-4 flex items-center whitespace-nowrap px-4 transition-colors' }}" href="{{ route('admin.reports.dashboard') }}">
                        <div class="shadow-soft-2xl mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-white bg-center stroke-0 text-center xl:p-2.5">
                            <i class="fas fa-chart-bar fill-slate-800 opacity-60 text-sm"></i>
                        </div>
                        <span class="ml-1 duration-300 opacity-100 pointer-events-none ease-soft">Laporan</span>
                    </a>
                </li>

                @if(session('admin_role') == 'admin')
                <li class="mt-0.5 w-full">
                    <a class="py-2.7 {{ request()->routeIs('admin.log-aktivitas.*') ? 'shadow-soft-xl text-sm ease-nav-brand my-0 mx-4 flex items-center whitespace-nowrap rounded-lg bg-white px-4 font-semibold text-slate-700 transition-colors' : 'text-sm ease-nav-brand my-0 mx-4 flex items-center whitespace-nowrap px-4 transition-colors' }}" href="{{ route('admin.log-aktivitas.index') }}">
                        <div class="shadow-soft-2xl mr-2 flex h-8 w-8 items-center justify-center rounded-lg bg-white bg-center stroke-0 text-center xl:p-2.5">
                            <i class="fas fa-history fill-slate-800 opacity-60 text-sm"></i>
                        </div>
                        <span class="ml-1 duration-300 opacity-100 pointer-events-none ease-soft">Log Aktivitas</span>
                    </a>
                </li>
                @endif
            </ul>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="ease-soft-in-out xl:ml-68.5 relative h-full max-h-screen rounded-xl transition-all duration-200">
        <!-- Navbar -->
        <nav class="relative flex flex-wrap items-center justify-between px-0 py-2 mx-6 transition-all shadow-soft-xl duration-250 ease-soft-in rounded-2xl bg-white/80 backdrop-blur-2xl backdrop-saturate-200 lg:flex-nowrap lg:justify-start" navbar-main navbar-scroll="true">
            <div class="flex items-center justify-between w-full px-6 py-3 mx-auto flex-wrap-inherit">
                <nav>
                    <!-- breadcrumb -->
                    <ol class="flex flex-wrap pt-1 mr-12 bg-transparent rounded-lg sm:mr-16">
                        <li class="leading-normal text-sm">
                            <a class="opacity-50 text-slate-600 hover:text-slate-800 transition-colors" href="javascript:;">Pages</a>
                        </li>
                        <li class="text-sm pl-2 capitalize leading-normal text-slate-700 before:float-left before:pr-2 before:text-slate-400 before:content-['/']" aria-current="page">
                            @yield('title', 'Dashboard')
                        </li>
                    </ol>
                    <h6 class="mb-0 font-bold capitalize text-slate-800 text-lg">@yield('title', 'Dashboard')</h6>
                </nav>

                <div class="flex items-center mt-2 grow sm:mt-0 sm:mr-6 md:mr-0 lg:flex lg:basis-auto">
                    <div class="flex items-center gap-4 ml-auto">
                        <!-- User Profile Section -->
                        <div class="flex items-center px-3 py-2 bg-white rounded-xl shadow-md border border-slate-100 hover:shadow-lg transition-all duration-200">
                            <div class="w-9 h-9 bg-gradient-to-tl from-purple-700 to-pink-500 rounded-xl flex items-center justify-center shadow-sm">
                                <i class="fas fa-user text-white text-sm"></i>
                            </div>
                            <div class="ml-3 mr-2">
                                <div class="text-sm font-semibold text-slate-700 leading-tight">{{ session('admin_nama', 'Admin') }}</div>
                                <div class="text-xs text-slate-500 capitalize leading-tight">{{ session('admin_role', 'Administrator') }}</div>
                            </div>
                        </div>
                        
                        <!-- Logout Button -->
                        <a href="{{ route('admin.logout') }}" class="flex items-center px-4 py-2 bg-gradient-to-r from-red-500 to-red-600 text-white rounded-xl shadow-md hover:shadow-lg hover:from-red-600 hover:to-red-700 transition-all duration-200 text-sm font-medium" title="Logout">
                            <i class="fas fa-sign-out-alt mr-2"></i>
                            <span class="hidden sm:inline">Logout</span>
                        </a>
                        
                        <!-- Mobile Menu Toggle -->
                        <button class="xl:hidden p-2 bg-white rounded-xl shadow-md hover:shadow-lg border border-slate-100 transition-all duration-200" sidenav-trigger>
                            <div class="w-5 h-4 flex flex-col justify-between">
                                <span class="block h-0.5 bg-slate-600 rounded-full transition-all"></span>
                                <span class="block h-0.5 bg-slate-600 rounded-full transition-all"></span>
                                <span class="block h-0.5 bg-slate-600 rounded-full transition-all"></span>
                            </div>
                        </button>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Content Wrapper -->
        <div class="w-full px-6 py-6 mx-auto">
            @if(session('success'))
                <div class="relative p-4 pr-12 mb-4 text-white border border-solid rounded-lg bg-gradient-to-tl from-green-600 to-lime-400 border-lime-300">
                    <i class="fas fa-check-circle mr-2"></i>{{ session('success') }}
                    <button type="button" class="absolute top-2 right-2 w-6 h-6 text-white opacity-50 cursor-pointer" onclick="this.parentElement.style.display='none'">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            @endif
            
            @if(session('error'))
                <div class="relative p-4 pr-12 mb-4 text-white border border-solid rounded-lg bg-gradient-to-tl from-red-600 to-rose-400 border-red-300">
                    <i class="fas fa-exclamation-circle mr-2"></i>{{ session('error') }}
                    <button type="button" class="absolute top-2 right-2 w-6 h-6 text-white opacity-50 cursor-pointer" onclick="this.parentElement.style.display='none'">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            @endif
            
            @yield('content')
        </div>
    </main>

    <!-- Core JS -->
    <script src="{{ asset('assets/js/plugins/perfect-scrollbar.min.js') }}" async></script>
    <script src="{{ asset('assets/js/soft-ui-dashboard-tailwind.js') }}" async></script>
    @stack('scripts')
</body>
</html>