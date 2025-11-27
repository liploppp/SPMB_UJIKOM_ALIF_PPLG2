@extends('layouts.admin')

@section('title', 'Laporan PPDB')

@section('content')
<div class="flex flex-wrap -mx-3">
    <div class="flex-none w-full max-w-full px-3">
        <!-- Header -->
        <div class="flex flex-wrap items-center justify-between mb-6">
            <div>
                <h6 class="mb-0 text-lg font-bold">Laporan Rekapitulasi PPDB</h6>
                <p class="mb-0 text-sm leading-normal text-slate-400">Ringkasan data pendaftaran siswa baru</p>
            </div>
            <div>
                <a href="{{ route('admin.reports.export') }}" class="inline-block px-6 py-3 mb-0 font-bold text-center text-white uppercase align-middle transition-all border-0 rounded-lg cursor-pointer hover:scale-102 active:opacity-85 hover:shadow-soft-xs leading-pro text-xs ease-soft-in tracking-tight-soft shadow-soft-md bg-150 bg-x-25 bg-gradient-to-tl from-green-600 to-lime-400">
                    <i class="fas fa-download mr-2"></i>Unduh Laporan Excel
                </a>
            </div>
        </div>

        <!-- Summary Cards -->
        <div class="flex flex-wrap -mx-3 mb-6">
            <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/4">
                <div class="relative flex flex-col min-w-0 break-words bg-white shadow-soft-xl rounded-2xl bg-clip-border">
                    <div class="flex-auto p-4">
                        <div class="flex flex-row -mx-3">
                            <div class="flex-none w-2/3 max-w-full px-3">
                                <div>
                                    <p class="mb-0 font-sans text-sm font-semibold leading-normal">Total Pendaftar</p>
                                    <h5 class="mb-0 font-bold">{{ number_format($totalPendaftar) }}</h5>
                                </div>
                            </div>
                            <div class="px-3 text-right basis-1/3">
                                <div class="inline-block w-12 h-12 text-center rounded-lg bg-gradient-to-tl from-purple-700 to-pink-500">
                                    <i class="ni ni-single-02 text-lg relative top-3.5 text-white"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/4">
                <div class="relative flex flex-col min-w-0 break-words bg-white shadow-soft-xl rounded-2xl bg-clip-border">
                    <div class="flex-auto p-4">
                        <div class="flex flex-row -mx-3">
                            <div class="flex-none w-2/3 max-w-full px-3">
                                <div>
                                    <p class="mb-0 font-sans text-sm font-semibold leading-normal">Hari Ini</p>
                                    <h5 class="mb-0 font-bold">{{ number_format($rekapHarian->first()->total ?? 0) }}</h5>
                                </div>
                            </div>
                            <div class="px-3 text-right basis-1/3">
                                <div class="inline-block w-12 h-12 text-center rounded-lg bg-gradient-to-tl from-green-600 to-lime-400">
                                    <i class="ni ni-calendar-grid-58 text-lg relative top-3.5 text-white"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Data Tables -->
        <div class="flex flex-wrap -mx-3">
            <div class="w-full max-w-full px-3 lg:w-1/2 lg:flex-none">
                <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
                    <div class="p-6 pb-0 mb-0 bg-white border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                        <h6>Pendaftar per Jurusan</h6>
                        <p class="mb-0 text-sm leading-normal">Distribusi pendaftar berdasarkan jurusan</p>
                    </div>
                    <div class="flex-auto px-0 pt-0 pb-2">
                        <div class="p-0 overflow-x-auto">
                            <table class="items-center w-full mb-0 align-top border-gray-200 text-slate-500">
                                <thead class="align-bottom">
                                    <tr>
                                        <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Jurusan</th>
                                        <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Jumlah</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($pendaftarPerJurusan as $item)
                                    <tr>
                                        <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                            <div class="flex px-2 py-1">
                                                <div>
                                                    <div class="inline-flex items-center justify-center mr-4 text-white transition-all duration-200 ease-soft-in-out text-sm h-9 w-9 rounded-xl bg-gradient-to-tl from-blue-600 to-cyan-400">
                                                        <i class="fas fa-graduation-cap"></i>
                                                    </div>
                                                </div>
                                                <div class="flex flex-col justify-center">
                                                    <h6 class="mb-0 text-sm leading-normal">{{ $item->jurusan->nama }}</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                            <span class="bg-gradient-to-tl from-purple-700 to-pink-500 px-2.5 text-xs rounded-1.8 py-1.4 inline-block whitespace-nowrap text-center align-baseline font-bold uppercase leading-none text-white">
                                                {{ number_format($item->total) }}
                                            </span>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="w-full max-w-full px-3 lg:w-1/2 lg:flex-none">
                <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
                    <div class="p-6 pb-0 mb-0 bg-white border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                        <h6>Rekap 7 Hari Terakhir</h6>
                        <p class="mb-0 text-sm leading-normal">Tren pendaftaran harian</p>
                    </div>
                    <div class="flex-auto px-0 pt-0 pb-2">
                        <div class="p-0 overflow-x-auto">
                            <table class="items-center w-full mb-0 align-top border-gray-200 text-slate-500">
                                <thead class="align-bottom">
                                    <tr>
                                        <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Tanggal</th>
                                        <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Jumlah</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($rekapHarian as $item)
                                    <tr>
                                        <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                            <div class="flex px-2 py-1">
                                                <div>
                                                    <div class="inline-flex items-center justify-center mr-4 text-white transition-all duration-200 ease-soft-in-out text-sm h-9 w-9 rounded-xl bg-gradient-to-tl from-red-500 to-yellow-400">
                                                        <i class="fas fa-calendar-day"></i>
                                                    </div>
                                                </div>
                                                <div class="flex flex-col justify-center">
                                                    <h6 class="mb-0 text-sm leading-normal">{{ \Carbon\Carbon::parse($item->tanggal)->format('d/m/Y') }}</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                            <span class="bg-gradient-to-tl from-green-600 to-lime-400 px-2.5 text-xs rounded-1.8 py-1.4 inline-block whitespace-nowrap text-center align-baseline font-bold uppercase leading-none text-white">
                                                {{ number_format($item->total) }}
                                            </span>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection