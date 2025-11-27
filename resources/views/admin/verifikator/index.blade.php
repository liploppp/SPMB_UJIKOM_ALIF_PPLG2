@extends('layouts.admin')

@section('title', 'Verifikasi Data Calon Siswa')

@section('content')
<!-- Filter Card -->
<div class="flex flex-wrap -mx-3 mb-6">
    <div class="flex-none w-full max-w-full px-3">
        <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
            <div class="p-6 pb-0 mb-0 bg-white border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                <div class="flex flex-wrap -mx-3">
                    <div class="flex-none w-1/2 max-w-full px-3">
                        <h6>Filter Data</h6>
                        <p class="mb-0 text-sm leading-normal">Filter berdasarkan jurusan dan status</p>
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
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex-auto p-6">
                <form method="GET" class="flex flex-wrap -mx-3">
                    <div class="flex-none w-full max-w-full px-3 md:w-4/12 md:flex-none">
                        <select name="jurusan" class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow">
                            <option value="">Semua Jurusan</option>
                            @foreach($jurusans as $jurusan)
                                <option value="{{ $jurusan->id }}" {{ request('jurusan') == $jurusan->id ? 'selected' : '' }}>
                                    {{ $jurusan->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex-none w-full max-w-full px-3 md:w-3/12 md:flex-none">
                        <select name="status" class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow">
                            <option value="">Semua Status</option>
                            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Menunggu Verifikasi</option>
                            <option value="verified" {{ request('status') == 'verified' ? 'selected' : '' }}>Diterima</option>
                            <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Ditolak</option>
                        </select>
                    </div>
                    <div class="flex-none w-full max-w-full px-3 md:w-2/12 md:flex-none">
                        <button type="submit" class="inline-block px-6 py-3 mb-0 font-bold text-center text-white uppercase align-middle transition-all border-0 rounded-lg cursor-pointer hover:scale-102 active:opacity-85 hover:shadow-soft-xs leading-pro text-xs ease-soft-in tracking-tight-soft shadow-soft-md bg-150 bg-x-25 bg-gradient-to-tl from-purple-700 to-pink-500">
                            Filter
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Data Table -->
<form method="POST" action="{{ route('admin.verifikator.bulk') }}" id="bulkForm">
    @csrf
    <div class="flex flex-wrap -mx-3">
        <div class="flex-none w-full max-w-full px-3">
            <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
                <div class="p-6 pb-0 mb-0 bg-white border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                    <div class="flex flex-wrap -mx-3">
                        <div class="flex-none w-1/2 max-w-full px-3">
                            <h6>Data Pendaftar</h6>
                            <p class="mb-0 text-sm leading-normal">Verifikasi data calon siswa</p>
                        </div>
                        <div class="flex-none w-1/2 max-w-full px-3 text-right">
                            <div class="flex justify-end space-x-2">
                                <select name="bulk_action" class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-auto appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow">
                                    <option value="">Pilih Aksi</option>
                                    <option value="verified">Terima Terpilih</option>
                                    <option value="rejected">Tolak Terpilih</option>
                                </select>
                                <button type="submit" class="inline-block px-4 py-2 mb-0 font-bold text-center text-white uppercase align-middle transition-all border-0 rounded-lg cursor-pointer hover:scale-102 active:opacity-85 hover:shadow-soft-xs leading-pro text-xs ease-soft-in tracking-tight-soft shadow-soft-md bg-150 bg-x-25 bg-gradient-to-tl from-purple-700 to-pink-500">
                                    Jalankan
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex-auto px-0 pt-0 pb-2">
                    <div class="p-0 overflow-x-auto">
                        <table class="items-center w-full mb-0 align-top border-gray-200 text-slate-500">
                            <thead class="align-bottom">
                                <tr>
                                    <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                        <input type="checkbox" id="selectAll" class="rounded border-gray-300">
                                    </th>
                                    <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">No Pendaftaran</th>
                                    <th class="px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Nama Lengkap</th>
                                    <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">NISN</th>
                                    <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Jurusan</th>
                                    <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Status</th>
                                    <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pendaftar as $item)
                                <tr>
                                    <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                        <input type="checkbox" name="selected_ids[]" value="{{ $item->id }}" class="selectItem rounded border-gray-300">
                                    </td>
                                    <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                        <h6 class="mb-0 text-sm leading-normal">{{ $item->no_pendaftaran }}</h6>
                                    </td>
                                    <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                        <div class="flex px-2 py-1">
                                            <div>
                                                <div class="inline-flex items-center justify-center mr-4 text-white transition-all duration-200 ease-soft-in-out text-sm h-9 w-9 rounded-xl bg-gradient-to-tl from-blue-600 to-cyan-400">
                                                    <i class="fas fa-user"></i>
                                                </div>
                                            </div>
                                            <div class="flex flex-col justify-center">
                                                <h6 class="mb-0 text-sm leading-normal">{{ $item->dataSiswa->nama ?? 'N/A' }}</h6>
                                                <p class="mb-0 text-xs leading-tight text-slate-400">{{ $item->dataSiswa->nisn ?? 'N/A' }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                        <span class="text-xs font-semibold leading-tight text-slate-400">{{ $item->dataSiswa->nisn ?? 'N/A' }}</span>
                                    </td>
                                    <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                        <span class="bg-gradient-to-tl from-blue-600 to-cyan-400 px-2.5 text-xs rounded-1.8 py-1.4 inline-block whitespace-nowrap text-center align-baseline font-bold uppercase leading-none text-white">
                                            {{ $item->jurusan->nama }}
                                        </span>
                                    </td>
                                    <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                        @if($item->status === 'pending')
                                            <span class="bg-gradient-to-tl from-red-500 to-yellow-400 px-2.5 text-xs rounded-1.8 py-1.4 inline-block whitespace-nowrap text-center align-baseline font-bold uppercase leading-none text-white">Menunggu Verifikasi</span>
                                        @elseif($item->status === 'verified')
                                            <span class="bg-gradient-to-tl from-green-600 to-lime-400 px-2.5 text-xs rounded-1.8 py-1.4 inline-block whitespace-nowrap text-center align-baseline font-bold uppercase leading-none text-white">Diterima</span>
                                        @elseif($item->status === 'rejected')
                                            <span class="bg-gradient-to-tl from-slate-600 to-slate-300 px-2.5 text-xs rounded-1.8 py-1.4 inline-block whitespace-nowrap text-center align-baseline font-bold uppercase leading-none text-white">Ditolak</span>
                                        @else
                                            <span class="bg-gradient-to-tl from-slate-600 to-slate-300 px-2.5 text-xs rounded-1.8 py-1.4 inline-block whitespace-nowrap text-center align-baseline font-bold uppercase leading-none text-white">{{ ucfirst($item->status) }}</span>
                                        @endif
                                    </td>
                                    <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                        <a href="{{ route('admin.verifikator.show', $item->id) }}" class="inline-block px-4 py-2 mb-0 font-bold text-center uppercase align-middle transition-all bg-transparent border border-solid rounded-lg shadow-none cursor-pointer leading-pro text-xs ease-soft-in tracking-tight-soft bg-150 bg-x-25 border-fuchsia-500 bg-none text-fuchsia-500 hover:border-fuchsia-500">
                                            <i class="fas fa-eye mr-1"></i>Detail
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="px-6 py-4">
                        {{ $pendaftar->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

<script>
document.getElementById('selectAll').addEventListener('change', function() {
    const checkboxes = document.querySelectorAll('.selectItem');
    checkboxes.forEach(checkbox => checkbox.checked = this.checked);
});
</script>
@endsection