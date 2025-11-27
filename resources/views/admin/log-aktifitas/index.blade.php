@extends('layouts.admin')

@section('title', 'Log Aktivitas')

@section('content')
<div class="flex flex-wrap -mx-3">
    <div class="flex-none w-full max-w-full px-3">
        <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
            <div class="p-6 pb-0 mb-0 bg-white border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                <div class="flex flex-wrap items-center justify-between">
                    <h6 class="mb-0 text-slate-700 text-lg font-bold">Log Aktivitas</h6>
                    <form method="GET" class="flex items-center gap-2">
                        <input type="text" name="search" 
                               class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow" 
                               placeholder="Cari aktivitas..." value="{{ request('search') }}">
                        <button type="submit" class="inline-block px-6 py-3 font-bold text-center text-white uppercase align-middle transition-all rounded-lg cursor-pointer bg-gradient-to-tl from-purple-700 to-pink-500 leading-pro text-xs ease-soft-in tracking-tight-soft shadow-soft-md bg-150 bg-x-25 hover:scale-102 active:opacity-85 hover:shadow-soft-xs">
                            Cari
                        </button>
                    </form>
                </div>
            </div>
            <div class="flex-auto px-0 pt-0 pb-2">
                <div class="p-0 overflow-x-auto">
                    <table class="items-center w-full mb-0 align-top border-gray-200 text-slate-500">
                        <thead class="align-bottom">
                            <tr>
                                <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Waktu</th>
                                <th class="px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Pengguna</th>
                                <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Aksi</th>
                                <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Objek</th>
                                <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">IP Address</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($logs as $log)
                            <tr>
                                <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    <p class="mb-0 font-semibold leading-tight text-xs text-slate-600">{{ $log->waktu->format('d/m/Y H:i:s') }}</p>
                                </td>
                                <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    <div class="flex px-2 py-1">
                                        <div class="flex flex-col justify-center">
                                            <h6 class="mb-0 leading-normal text-sm text-slate-700">{{ $log->user->nama ?? 'System' }}</h6>
                                            <p class="mb-0 leading-tight text-xs text-slate-400">{{ $log->user->role ?? '-' }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    <span class="bg-gradient-to-tl from-purple-700 to-pink-500 px-2.5 text-xs rounded-1.8 py-1.4 inline-block whitespace-nowrap text-center align-baseline font-bold uppercase leading-none text-white">
                                        {{ $log->aksi }}
                                    </span>
                                </td>
                                <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    <p class="mb-0 font-semibold leading-tight text-xs text-slate-600">{{ $log->objek }}</p>
                                </td>
                                <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    <p class="mb-0 font-semibold leading-tight text-xs text-slate-600">{{ $log->ip }}</p>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    <div class="text-slate-400">
                                        <i class="fas fa-inbox fa-2x mb-2 opacity-50"></i>
                                        <p class="mb-0 leading-tight text-xs">Tidak ada data log aktivitas</p>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                
                @if($logs->hasPages())
                <div class="px-6 py-4">
                    {{ $logs->links() }}
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection