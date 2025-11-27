@extends('layouts.admin')

@section('title', 'Manajemen Pembayaran')

@section('content')
<div class="flex flex-wrap -mx-3">
    <div class="flex-none w-full max-w-full px-3">
        <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
            <div class="p-6 pb-0 mb-0 bg-white border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                <div class="flex flex-wrap -mx-3">
                    <div class="flex-none w-1/2 max-w-full px-3">
                        <h6>Manajemen Pembayaran</h6>
                        <p class="mb-0 text-sm leading-normal">Data pembayaran pendaftar</p>
                    </div>
                    <div class="flex-none w-1/2 max-w-full px-3 text-right">
                        <div class="flex justify-end space-x-2">
                            <a href="?status=pending" class="inline-block px-4 py-2 mb-0 font-bold text-center uppercase align-middle transition-all bg-transparent border border-solid rounded-lg shadow-none cursor-pointer leading-pro text-xs ease-soft-in tracking-tight-soft bg-150 bg-x-25 border-red-500 bg-none text-red-500 hover:border-red-500">
                                Menunggu Verifikasi
                            </a>
                            <a href="?status=verified" class="inline-block px-4 py-2 mb-0 font-bold text-center uppercase align-middle transition-all bg-transparent border border-solid rounded-lg shadow-none cursor-pointer leading-pro text-xs ease-soft-in tracking-tight-soft bg-150 bg-x-25 border-green-500 bg-none text-green-500 hover:border-green-500">
                                Diterima
                            </a>
                            <a href="?status=rejected" class="inline-block px-4 py-2 mb-0 font-bold text-center uppercase align-middle transition-all bg-transparent border border-solid rounded-lg shadow-none cursor-pointer leading-pro text-xs ease-soft-in tracking-tight-soft bg-150 bg-x-25 border-slate-500 bg-none text-slate-500 hover:border-slate-500">
                                Ditolak
                            </a>
                            <a href="{{ route('admin.pembayaran.index') }}" class="inline-block px-4 py-2 mb-0 font-bold text-center uppercase align-middle transition-all bg-transparent border border-solid rounded-lg shadow-none cursor-pointer leading-pro text-xs ease-soft-in tracking-tight-soft bg-150 bg-x-25 border-fuchsia-500 bg-none text-fuchsia-500 hover:border-fuchsia-500">
                                Semua
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex-auto px-0 pt-0 pb-2">
                <div class="p-0 overflow-x-auto">
                    <table class="items-center w-full mb-0 align-top border-gray-200 text-slate-500">
                        <thead class="align-bottom">
                            <tr>
                                <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">No Pendaftaran</th>
                                <th class="px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Nama Siswa</th>
                                <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Jumlah</th>
                                <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Metode</th>
                                <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Tanggal</th>
                                <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Status</th>
                                <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Bukti</th>
                                <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($pembayaran as $item)
                            <tr>
                                <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    <div class="flex px-2 py-1">
                                        <div class="flex flex-col justify-center">
                                            <h6 class="mb-0 text-sm leading-normal">
                                                @if(isset($item->pendaftar) && $item->pendaftar)
                                                    {{ $item->pendaftar->no_pendaftaran }}
                                                @else
                                                    -
                                                @endif
                                            </h6>
                                        </div>
                                    </div>
                                </td>
                                <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    <div class="flex px-2 py-1">
                                        <div class="flex flex-col justify-center">
                                            <h6 class="mb-0 text-sm leading-normal">
                                                @if(isset($item->pendaftar) && $item->pendaftar && isset($item->pendaftar->dataSiswa) && $item->pendaftar->dataSiswa)
                                                    {{ $item->pendaftar->dataSiswa->nama }}
                                                @elseif(isset($item->pendaftar) && $item->pendaftar)
                                                    {{ $item->pendaftar->no_pendaftaran }}
                                                @else
                                                    -
                                                @endif
                                            </h6>
                                            <p class="mb-0 text-xs leading-tight text-slate-400">
                                                @if(isset($item->pendaftar) && $item->pendaftar && isset($item->pendaftar->jurusan) && $item->pendaftar->jurusan)
                                                    {{ $item->pendaftar->jurusan->nama }}
                                                @else
                                                    -
                                                @endif
                                            </p>
                                        </div>
                                    </div>
                                </td>
                                <td class="p-2 text-sm leading-normal text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    <span class="font-semibold leading-tight text-xs">Rp {{ number_format($item->nominal ?? 0, 0, ',', '.') }}</span>
                                </td>
                                <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    <span class="bg-gradient-to-tl from-blue-600 to-cyan-400 px-2.5 text-xs rounded-1.8 py-1.4 inline-block whitespace-nowrap text-center align-baseline font-bold uppercase leading-none text-white">
                                        {{ strtoupper($item->metode_pembayaran ?? 'Transfer Bank') }}
                                    </span>
                                </td>
                                <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    <span class="text-xs font-semibold leading-tight text-slate-400">{{ $item->created_at ? $item->created_at->format('d/m/Y') : '-' }}</span>
                                </td>
                                <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    @php
                                        $status = strtolower($item->status ?? 'pending');
                                    @endphp
                                    @if($status === 'pending')
                                        <span class="bg-gradient-to-tl from-red-500 to-yellow-400 px-2.5 text-xs rounded-1.8 py-1.4 inline-block whitespace-nowrap text-center align-baseline font-bold uppercase leading-none text-white">PENDING</span>
                                    @elseif($status === 'verified')
                                        <span class="bg-gradient-to-tl from-green-600 to-lime-400 px-2.5 text-xs rounded-1.8 py-1.4 inline-block whitespace-nowrap text-center align-baseline font-bold uppercase leading-none text-white">DITERIMA</span>
                                    @elseif($status === 'rejected')
                                        <span class="bg-gradient-to-tl from-slate-600 to-slate-300 px-2.5 text-xs rounded-1.8 py-1.4 inline-block whitespace-nowrap text-center align-baseline font-bold uppercase leading-none text-white">DITOLAK</span>
                                    @else
                                        <span class="bg-gradient-to-tl from-slate-600 to-slate-300 px-2.5 text-xs rounded-1.8 py-1.4 inline-block whitespace-nowrap text-center align-baseline font-bold uppercase leading-none text-white">{{ strtoupper($status) }}</span>
                                    @endif
                                </td>
                                <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    @if($item->bukti_pembayaran ?? false)
                                        <a href="{{ route('admin.pembayaran.bukti', $item->id) }}" target="_blank" class="inline-block px-4 py-2 mb-0 font-bold text-center uppercase align-middle transition-all bg-transparent border border-solid rounded-lg shadow-none cursor-pointer leading-pro text-xs ease-soft-in tracking-tight-soft bg-150 bg-x-25 border-cyan-500 bg-none text-cyan-500 hover:border-cyan-500">
                                            <i class="fas fa-eye"></i> Lihat
                                        </a>
                                    @else
                                        <span class="text-slate-400 text-xs">Tidak ada</span>
                                    @endif
                                </td>
                                <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    <div class="flex justify-center items-center gap-2">
                                        <a href="{{ route('admin.pembayaran.show', $item->id) }}" class="inline-block px-4 py-2 mb-0 font-bold text-center uppercase align-middle transition-all bg-transparent border border-solid rounded-lg shadow-none cursor-pointer leading-pro text-xs ease-soft-in tracking-tight-soft bg-150 bg-x-25 border-fuchsia-500 bg-none text-fuchsia-500 hover:bg-fuchsia-500 hover:text-white" title="Lihat Detail">
                                            <i class="fas fa-eye mr-1"></i> Detail
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8" class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    <div class="text-slate-400">
                                        <i class="fas fa-inbox fa-2x mb-2 opacity-50"></i>
                                        <p class="mb-0 leading-tight text-xs">Belum ada data pembayaran</p>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="px-6 py-4">
                    {{ $pembayaran->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

@endsection