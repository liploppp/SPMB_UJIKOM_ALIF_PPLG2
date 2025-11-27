@extends('layouts.admin')

@section('title', 'Daftar Pembayaran')

@section('content')
<div class="flex flex-wrap -mx-3">
    <div class="flex-none w-full max-w-full px-3">
        <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
            <div class="p-6 pb-0 mb-0 bg-white border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                <h6 class="mb-0">Daftar Pembayaran</h6>
                <p class="mb-0 text-sm leading-normal text-slate-400">Kelola dan verifikasi pembayaran pendaftar</p>
            </div>
            <div class="flex-auto px-0 pt-0 pb-2">
                <div class="p-0 overflow-x-auto">
                    <table class="items-center w-full mb-0 align-top border-gray-200 text-slate-500">
                        <thead class="align-bottom">
                            <tr>
                                <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">No Pendaftaran</th>
                                <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Nama Pendaftar</th>
                                <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Nominal</th>
                                <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Status</th>
                                <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Tanggal Upload</th>
                                <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($pembayaran as $item)
                            <tr>
                                <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    <div class="flex px-2 py-1">
                                        <div class="flex flex-col justify-center">
                                            <h6 class="mb-0 text-sm leading-normal font-mono font-bold text-blue-600">{{ $item->pendaftar->no_pendaftaran ?? '-' }}</h6>
                                        </div>
                                    </div>
                                </td>
                                <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    <p class="mb-0 text-xs font-semibold leading-tight text-slate-600">{{ $item->pendaftar->dataSiswa->nama ?? '-' }}</p>
                                </td>
                                <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    <p class="mb-0 text-xs font-semibold leading-tight text-green-600">Rp {{ number_format($item->nominal ?? 0, 0, ',', '.') }}</p>
                                </td>
                                <td class="p-2 text-sm leading-normal text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    @if($item->status === 'pending')
                                        <span style="background: linear-gradient(135deg, #d97706, #f59e0b); color: white; padding: 4px 10px; border-radius: 12px; font-size: 11px; font-weight: 600; text-transform: uppercase; display: inline-block;">Pending</span>
                                    @elseif($item->status === 'verified')
                                        <span style="background: linear-gradient(135deg, #059669, #10b981); color: white; padding: 4px 10px; border-radius: 12px; font-size: 11px; font-weight: 600; text-transform: uppercase; display: inline-block;">Terverifikasi</span>
                                    @else
                                        <span style="background: linear-gradient(135deg, #dc2626, #ef4444); color: white; padding: 4px 10px; border-radius: 12px; font-size: 11px; font-weight: 600; text-transform: uppercase; display: inline-block;">Ditolak</span>
                                    @endif
                                </td>
                                <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    <span class="text-xs font-semibold leading-tight text-slate-400">{{ $item->created_at ? $item->created_at->format('d/m/Y H:i') : '-' }}</span>
                                </td>
                                <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    <a href="{{ route('admin.pembayaran.show', $item->id) }}" class="inline-block px-4 py-2 font-bold text-center text-white uppercase align-middle transition-all bg-transparent border-0 rounded-lg shadow-none cursor-pointer leading-pro text-xs ease-soft-in bg-gradient-to-tl from-blue-600 to-cyan-400 hover:scale-102 active:opacity-85">
                                        <i class="fas fa-eye mr-1"></i>Detail
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="p-6 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    <div class="flex flex-col items-center justify-center py-8">
                                        <i class="fas fa-receipt text-4xl text-slate-300 mb-4"></i>
                                        <h4 class="text-lg font-semibold text-slate-600 mb-2">Belum ada data pembayaran</h4>
                                        <p class="text-sm text-slate-400">Data pembayaran akan muncul di sini setelah ada pendaftar yang melakukan pembayaran</p>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                @if($pembayaran->hasPages())
                <div class="px-6 py-4 border-t border-gray-200">
                    {{ $pembayaran->links() }}
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection