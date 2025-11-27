@extends('layouts.admin')

@section('title', 'Dashboard Admin')

@push('styles')
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
<link href="{{ asset('assets/css/soft-ui-dashboard-tailwind.css') }}" rel="stylesheet">
<style>
/* Custom styles untuk dashboard */
.dashboard-card {
    position: relative;
    display: flex;
    flex-direction: column;
    min-width: 0;
    word-wrap: break-word;
    background-color: #fff;
    background-clip: border-box;
    border: 0;
    border-radius: 1rem;
    box-shadow: 0 20px 27px 0 rgba(0,0,0,0.05);
    transition: all 0.3s ease;
}

.dashboard-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 8px 26px -4px hsla(0,0%,8%,.15), 0 8px 9px -5px hsla(0,0%,8%,.06);
}

.stats-icon-bg {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    width: 3rem;
    height: 3rem;
    border-radius: 0.75rem;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
}

.stats-icon-bg.purple {
    background: linear-gradient(135deg, #7928ca 0%, #ff0080 100%);
}

.stats-icon-bg.green {
    background: linear-gradient(135deg, #17ad37 0%, #98ec2d 100%);
}

.stats-icon-bg.orange {
    background: linear-gradient(135deg, #f53939 0%, #fbcf33 100%);
}

.stats-icon-bg.blue {
    background: linear-gradient(135deg, #2152ff 0%, #21d4fd 100%);
}

.chart-container {
    position: relative;
    height: 300px;
}

.progress-bar {
    height: 0.375rem;
    border-radius: 0.5rem;
    background-color: #e9ecef;
    overflow: hidden;
}

.progress-fill {
    height: 100%;
    border-radius: 0.5rem;
    transition: width 0.6s ease;
}

.progress-fill.blue {
    background: linear-gradient(135deg, #2152ff 0%, #21d4fd 100%);
}

.progress-fill.green {
    background: linear-gradient(135deg, #17ad37 0%, #98ec2d 100%);
}

.progress-fill.orange {
    background: linear-gradient(135deg, #f53939 0%, #fbcf33 100%);
}

.timeline-item {
    position: relative;
    padding-left: 2.8rem;
    margin-bottom: 1.5rem;
}

.timeline-item::before {
    content: '';
    position: absolute;
    left: 1rem;
    top: 0;
    bottom: -1.5rem;
    width: 2px;
    background: #e9ecef;
}

.timeline-item:last-child::before {
    display: none;
}

.timeline-icon {
    position: absolute;
    left: 0.5rem;
    top: 0.35rem;
    width: 1.625rem;
    height: 1.625rem;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    background: white;
    z-index: 10;
    font-size: 0.75rem;
}

.avatar-group {
    display: flex;
    align-items: center;
}

.avatar {
    width: 1.5rem;
    height: 1.5rem;
    border-radius: 50%;
    border: 2px solid white;
    margin-left: -0.25rem;
    position: relative;
    z-index: 1;
}

.avatar:first-child {
    margin-left: 0;
}

.avatar:hover {
    z-index: 30;
}
</style>
@endpush

@section('content')

<!-- Statistics Cards -->
<div class="flex flex-wrap -mx-3">
    <!-- Card 1 -->
    <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/4">
        <div class="dashboard-card">
            <div class="flex-auto p-4">
                <div class="flex flex-row -mx-3">
                    <div class="flex-none w-2/3 max-w-full px-3">
                        <div>
                            <p class="mb-0 font-sans font-semibold leading-normal text-sm">Total Pendaftar</p>
                            <h5 class="mb-0 font-bold">
                                {{ number_format($totalPendaftar) }}
                                <span class="leading-normal text-sm font-weight-bolder text-lime-500">+{{ $pendaftarBaru }}</span>
                            </h5>
                        </div>
                    </div>
                    <div class="px-3 text-right basis-1/3">
                        <div class="stats-icon-bg purple">
                            <i class="fas fa-users text-lg relative top-0.5 text-white"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Card 2 -->
    <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/4">
        <div class="dashboard-card">
            <div class="flex-auto p-4">
                <div class="flex flex-row -mx-3">
                    <div class="flex-none w-2/3 max-w-full px-3">
                        <div>
                            <p class="mb-0 font-sans font-semibold leading-normal text-sm">Pendaftar Hari Ini</p>
                            <h5 class="mb-0 font-bold">
                                {{ number_format($pendaftarBaru) }}
                                <span class="leading-normal text-sm font-weight-bolder text-lime-500">+3%</span>
                            </h5>
                        </div>
                    </div>
                    <div class="px-3 text-right basis-1/3">
                        <div class="stats-icon-bg green">
                            <i class="fas fa-user-plus text-lg relative top-0.5 text-white"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Card 3 -->
    <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/4">
        <div class="dashboard-card">
            <div class="flex-auto p-4">
                <div class="flex flex-row -mx-3">
                    <div class="flex-none w-2/3 max-w-full px-3">
                        <div>
                            <p class="mb-0 font-sans font-semibold leading-normal text-sm">Total Gelombang</p>
                            <h5 class="mb-0 font-bold">
                                {{ number_format($totalGelombang) }}
                                <span class="leading-normal text-red-600 text-sm font-weight-bolder">Aktif</span>
                            </h5>
                        </div>
                    </div>
                    <div class="px-3 text-right basis-1/3">
                        <div class="stats-icon-bg orange">
                            <i class="fas fa-layer-group text-lg relative top-0.5 text-white"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Card 4 -->
    <div class="w-full max-w-full px-3 sm:w-1/2 sm:flex-none xl:w-1/4">
        <div class="dashboard-card">
            <div class="flex-auto p-4">
                <div class="flex flex-row -mx-3">
                    <div class="flex-none w-2/3 max-w-full px-3">
                        <div>
                            <p class="mb-0 font-sans font-semibold leading-normal text-sm">Total Jurusan</p>
                            <h5 class="mb-0 font-bold">
                                {{ number_format($totalJurusan) }}
                                <span class="leading-normal text-sm font-weight-bolder text-lime-500">Program</span>
                            </h5>
                        </div>
                    </div>
                    <div class="px-3 text-right basis-1/3">
                        <div class="stats-icon-bg blue">
                            <i class="fas fa-graduation-cap text-lg relative top-0.5 text-white"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Charts Section -->
<div class="flex flex-wrap mt-6 -mx-3">
    <!-- Chart Jurusan -->
    <div class="w-full max-w-full px-3 mt-0 mb-6 lg:mb-0 lg:w-5/12 lg:flex-none">
        <div class="dashboard-card">
            <div class="flex-auto p-4">
                <div class="py-4 pr-1 mb-4 bg-gradient-to-tl from-gray-900 to-slate-800 rounded-xl">
                    <div style="position: relative; height: 170px;">
                        <canvas id="chart-bars"></canvas>
                    </div>
                </div>
                <h6 class="mt-6 mb-0 ml-2">Pendaftar per Jurusan</h6>
                <p class="ml-2 leading-normal text-sm">
                    (<span class="font-bold">+{{ $pendaftarBaru }}</span>) hari ini
                </p>
                <div class="w-full px-6 mx-auto max-w-screen-2xl rounded-xl">
                    <div class="flex flex-wrap mt-0 -mx-3">
                        @if(!empty($jurusanData))
                            @foreach(array_slice($jurusanData, 0, 4, true) as $kode => $count)
                            @php
                                $colors = ['from-purple-700 to-pink-500', 'from-blue-600 to-cyan-400', 'from-red-500 to-yellow-400', 'from-green-600 to-lime-400'];
                                $total = array_sum($jurusanData);
                                $percentage = $total > 0 ? round(($count / $total) * 100) : 0;
                                $colorIndex = $loop->index % count($colors);
                            @endphp
                            <div class="flex-none w-1/4 max-w-full py-4 pl-0 pr-3 mt-0">
                                <div class="flex mb-2">
                                    <div class="flex items-center justify-center w-5 h-5 mr-2 text-center bg-center rounded fill-current shadow-soft-2xl bg-gradient-to-tl {{ $colors[$colorIndex] }} text-neutral-900">
                                        <i class="fas fa-graduation-cap text-white" style="font-size: 8px;"></i>
                                    </div>
                                    <p class="mt-1 mb-0 font-semibold leading-tight text-xs">{{ $kode }}</p>
                                </div>
                                <h4 class="font-bold">{{ $count }}</h4>
                                <div class="text-xs h-0.75 flex w-3/4 overflow-visible rounded-lg bg-gray-200">
                                    <div class="duration-600 ease-soft -mt-0.38 -ml-px flex h-1.5 flex-col justify-center overflow-hidden whitespace-nowrap rounded-lg bg-slate-700 text-center text-white transition-all" 
                                         style="width: {{ $percentage }}%" 
                                         role="progressbar" 
                                         aria-valuenow="{{ $percentage }}" 
                                         aria-valuemin="0" 
                                         aria-valuemax="100"></div>
                                </div>
                            </div>
                            @endforeach
                        @else
                            <div class="w-full text-center py-4">
                                <p class="text-gray-500">Belum ada data pendaftar</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Chart Status -->
    <div class="w-full max-w-full px-3 mt-0 lg:w-7/12 lg:flex-none">
        <div class="dashboard-card">
            <div class="border-black/12.5 mb-0 rounded-t-2xl border-b-0 border-solid bg-white p-6 pb-0">
                <h6>Status Pendaftaran</h6>
                <p class="leading-normal text-sm">
                    <i class="fa fa-arrow-up text-lime-500"></i>
                    <span class="font-semibold">{{ $pendaftarBaru }} pendaftar</span> hari ini
                </p>
            </div>
            <div class="flex-auto p-4">
                <div style="position: relative; height: 280px; background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%); border-radius: 15px; padding: 15px;">
                    <canvas id="chart-line"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Recent Registrations & Activity -->
<div class="flex flex-wrap my-6 -mx-3">
    <!-- Recent Registrations Table -->
    <div class="w-full max-w-full px-3 mt-0 mb-6 md:mb-0 md:w-1/2 md:flex-none lg:w-2/3 lg:flex-none">
        <div class="dashboard-card">
            <div class="border-black/12.5 mb-0 rounded-t-2xl border-b-0 border-solid bg-white p-6 pb-0">
                <div class="flex flex-wrap mt-0 -mx-3">
                    <div class="flex-none w-7/12 max-w-full px-3 mt-0 lg:w-1/2 lg:flex-none">
                        <h6>Pendaftar Terbaru</h6>
                        <p class="mb-0 leading-normal text-sm">
                            <i class="fa fa-check text-cyan-500"></i>
                            <span class="ml-1 font-semibold">{{ $pendaftarBaru }} baru</span> hari ini
                        </p>
                    </div>
                    <div class="flex-none w-5/12 max-w-full px-3 my-auto text-right lg:w-1/2 lg:flex-none">
                        <a href="{{ route('admin.pendaftar.index') }}" class="inline-block px-4 py-2 mb-0 font-bold text-center uppercase align-middle transition-all bg-transparent border border-solid rounded-lg shadow-none cursor-pointer leading-pro text-xs ease-soft-in tracking-tight-soft bg-150 bg-x-25 border-fuchsia-500 bg-none text-fuchsia-500 hover:border-fuchsia-500">
                            Lihat Semua
                        </a>
                    </div>
                </div>
            </div>
            <div class="flex-auto p-6 px-0 pb-2">
                <div class="overflow-x-auto">
                    <table class="items-center w-full mb-0 align-top border-gray-200 text-slate-500">
                        <thead class="align-bottom">
                            <tr>
                                <th class="px-6 py-3 font-bold tracking-normal text-left uppercase align-middle bg-transparent border-b letter border-b-solid text-xxs whitespace-nowrap border-b-gray-200 text-slate-400 opacity-70">Pendaftar</th>
                                <th class="px-6 py-3 pl-2 font-bold tracking-normal text-left uppercase align-middle bg-transparent border-b letter border-b-solid text-xxs whitespace-nowrap border-b-gray-200 text-slate-400 opacity-70">Jurusan</th>
                                <th class="px-6 py-3 font-bold tracking-normal text-center uppercase align-middle bg-transparent border-b letter border-b-solid text-xxs whitespace-nowrap border-b-gray-200 text-slate-400 opacity-70">Status</th>
                                <th class="px-6 py-3 font-bold tracking-normal text-center uppercase align-middle bg-transparent border-b letter border-b-solid text-xxs whitespace-nowrap border-b-gray-200 text-slate-400 opacity-70">Tanggal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $pendaftarTerbaru = \App\Models\Pendaftar::with(['dataSiswa', 'jurusan'])
                                    ->orderBy('created_at', 'desc')
                                    ->limit(5)
                                    ->get();
                            @endphp
                            @forelse($pendaftarTerbaru as $pendaftar)
                            <tr>
                                <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap">
                                    <div class="flex px-2 py-1">
                                        <div>
                                            <div class="inline-flex items-center justify-center mr-4 text-white transition-all duration-200 ease-soft-in-out text-sm h-9 w-9 rounded-xl" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%)">
                                                <i class="fas fa-user"></i>
                                            </div>
                                        </div>
                                        <div class="flex flex-col justify-center">
                                            <h6 class="mb-0 leading-normal text-sm">{{ $pendaftar->dataSiswa->nama ?? 'N/A' }}</h6>
                                            <p class="mb-0 leading-tight text-xs text-slate-400">{{ $pendaftar->no_pendaftaran }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap">
                                    <span class="bg-gradient-to-tl from-blue-600 to-cyan-400 px-2.5 text-xs rounded-1.8 py-1.4 inline-block whitespace-nowrap text-center align-baseline font-bold uppercase leading-none text-white">
                                        {{ $pendaftar->jurusan->kode ?? 'N/A' }}
                                    </span>
                                </td>
                                <td class="p-2 leading-normal text-center align-middle bg-transparent border-b text-sm whitespace-nowrap">
                                    @if($pendaftar->status == 'Diterima')
                                        <span class="bg-gradient-to-tl from-green-600 to-lime-400 px-2.5 text-xs rounded-1.8 py-1.4 inline-block whitespace-nowrap text-center align-baseline font-bold uppercase leading-none text-white">
                                            Diterima
                                        </span>
                                    @elseif($pendaftar->status == 'Pending')
                                        <span class="bg-gradient-to-tl from-red-500 to-yellow-400 px-2.5 text-xs rounded-1.8 py-1.4 inline-block whitespace-nowrap text-center align-baseline font-bold uppercase leading-none text-white">
                                            Pending
                                        </span>
                                    @else
                                        <span class="bg-gradient-to-tl from-slate-600 to-slate-300 px-2.5 text-xs rounded-1.8 py-1.4 inline-block whitespace-nowrap text-center align-baseline font-bold uppercase leading-none text-white">
                                            {{ $pendaftar->status }}
                                        </span>
                                    @endif
                                </td>
                                <td class="p-2 leading-normal text-center align-middle bg-transparent border-b text-sm whitespace-nowrap">
                                    <span class="font-semibold leading-tight text-xs">{{ $pendaftar->created_at->format('d/m/Y') }}</span>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap">
                                    <div class="text-slate-400">
                                        <i class="fas fa-inbox fa-2x mb-2 opacity-50"></i>
                                        <p class="mb-0 leading-tight text-xs">Belum ada pendaftar</p>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Activity Timeline -->
    <div class="w-full max-w-full px-3 md:w-1/2 md:flex-none lg:w-1/3 lg:flex-none">
        <div class="dashboard-card">
            <div class="border-black/12.5 mb-0 rounded-t-2xl border-b-0 border-solid bg-white p-6 pb-0">
                <h6>Aktivitas Terbaru</h6>
                <p class="leading-normal text-sm">
                    <i class="fa fa-arrow-up text-lime-500"></i>
                    <span class="font-semibold">24%</span> bulan ini
                </p>
            </div>
            <div class="flex-auto p-4">
                <div class="before:border-r-solid relative before:absolute before:top-0 before:left-4 before:h-full before:border-r-2 before:border-r-slate-100 before:content-[''] before:lg:-ml-px">
                    @php
                        $recentActivities = \App\Models\Pendaftar::with(['dataSiswa', 'jurusan'])
                            ->orderBy('created_at', 'desc')
                            ->limit(6)
                            ->get();
                    @endphp
                    @foreach($recentActivities as $activity)
                    <div class="relative mb-4 mt-0 after:clear-both after:table after:content-['']">
                        <span class="w-6.5 h-6.5 text-base absolute left-4 z-10 inline-flex -translate-x-1/2 items-center justify-center rounded-full bg-white text-center font-semibold">
                            <i class="relative z-10 text-transparent fas fa-user-plus leading-none leading-pro bg-gradient-to-tl from-green-600 to-lime-400 bg-clip-text fill-transparent"></i>
                        </span>
                        <div class="ml-11.252 pt-1.4 lg:max-w-120 relative -top-1.5 w-auto">
                            <h6 class="mb-0 font-semibold leading-normal text-sm text-slate-700">
                                {{ $activity->dataSiswa->nama ?? 'Pendaftar Baru' }}
                            </h6>
                            <p class="mt-1 mb-0 font-semibold leading-tight text-xs text-slate-400">
                                {{ $activity->created_at->format('d M H:i') }}
                            </p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
// Data untuk charts
const jurusanLabels = {!! json_encode(array_keys($jurusanData ?? [])) !!};
const jurusanValues = {!! json_encode(array_values($jurusanData ?? [])) !!};
const statusLabels = {!! json_encode(array_keys($statusData ?? [])) !!};
const statusValues = {!! json_encode(array_values($statusData ?? [])) !!};

// Chart Bars (Jurusan)
const ctx1 = document.getElementById('chart-bars');
if (ctx1) {
    new Chart(ctx1, {
        type: 'bar',
        data: {
            labels: jurusanLabels,
            datasets: [{
                label: 'Pendaftar',
                data: jurusanValues,
                backgroundColor: 'rgba(255, 255, 255, 0.8)',
                borderRadius: 4,
                maxBarThickness: 40
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        color: 'rgba(255, 255, 255, 0.2)',
                        borderDash: [5, 5]
                    },
                    ticks: {
                        color: '#fff',
                        font: { size: 12 }
                    }
                },
                x: {
                    grid: {
                        color: 'rgba(255, 255, 255, 0.2)',
                        borderDash: [5, 5]
                    },
                    ticks: {
                        color: '#f8f9fa',
                        font: { size: 12 }
                    }
                }
            }
        }
    });
}

// Chart Pie (Status)
const ctx2 = document.getElementById('chart-line');
if (ctx2) {
    new Chart(ctx2, {
        type: 'doughnut',
        data: {
            labels: statusLabels,
            datasets: [{
                data: statusValues,
                backgroundColor: [
                    '#FF6384',  // Pink/Red
                    '#36A2EB',  // Blue
                    '#FFCE56',  // Yellow
                    '#4BC0C0',  // Teal
                    '#9966FF',  // Purple
                    '#FF9F40'   // Orange
                ],
                borderColor: '#ffffff',
                borderWidth: 4,
                hoverBorderWidth: 6,
                hoverOffset: 8
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            cutout: '60%',
            plugins: {
                legend: {
                    display: true,
                    position: 'bottom',
                    labels: {
                        color: '#344767',
                        font: { size: 13, weight: '600', family: 'Open Sans' },
                        padding: 20,
                        usePointStyle: true,
                        pointStyle: 'rectRounded',
                        boxWidth: 12,
                        boxHeight: 12
                    }
                },
                tooltip: {
                    backgroundColor: 'rgba(52, 71, 103, 0.95)',
                    titleColor: '#ffffff',
                    bodyColor: '#ffffff',
                    borderColor: 'rgba(255, 255, 255, 0.2)',
                    borderWidth: 1,
                    cornerRadius: 8,
                    displayColors: true,
                    callbacks: {
                        label: function(context) {
                            const total = context.dataset.data.reduce((a, b) => a + b, 0);
                            const percentage = ((context.parsed / total) * 100).toFixed(1);
                            return context.label + ': ' + context.parsed + ' (' + percentage + '%)';
                        }
                    }
                }
            },
            layout: {
                padding: 20
            },
            animation: {
                animateRotate: true,
                animateScale: true,
                duration: 1500,
                easing: 'easeOutQuart'
            },
            interaction: {
                intersect: false,
                mode: 'index'
            }
        }
    });
}
</script>
@endsection