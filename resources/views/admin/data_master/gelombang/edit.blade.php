@extends('layouts.admin')

@section('title', 'Edit Gelombang')

@section('content')
<div class="flex flex-wrap -mx-3">
    <div class="flex-none w-full max-w-full px-3">
        <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
            <div class="p-6 pb-0 mb-0 bg-white border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                <div class="flex items-center justify-between">
                    <h6 class="font-bold">Edit Gelombang</h6>
                    <a href="{{ route('admin.gelombang.index') }}" class="inline-block px-6 py-3 font-bold text-center text-white uppercase align-middle transition-all bg-transparent rounded-lg cursor-pointer leading-pro text-xs ease-soft-in shadow-soft-md bg-150 bg-gradient-to-tl from-gray-900 to-slate-800 hover:shadow-soft-xs active:opacity-85 hover:scale-102 tracking-tight-soft bg-x-25">
                        <i class="fas fa-arrow-left mr-2"></i>Kembali
                    </a>
                </div>
            </div>
            <div class="flex-auto px-6 pt-0 pb-6">
                <form method="POST" action="{{ route('admin.gelombang.update', $gelombang) }}">
                    @csrf
                    @method('PUT')
                    <div class="flex flex-wrap -mx-3 mt-6">
                        <div class="w-full max-w-full px-3 mb-6 md:w-1/2 md:flex-none">
                            <label for="nama" class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700">Nama Gelombang <span class="text-red-500">*</span></label>
                            <input type="text" name="nama" id="nama" value="{{ old('nama', $gelombang->nama) }}" class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow" required>
                            @error('nama')
                                <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="w-full max-w-full px-3 mb-6 md:w-1/2 md:flex-none">
                            <label for="tahun" class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700">Tahun <span class="text-red-500">*</span></label>
                            <input type="text" name="tahun" id="tahun" value="{{ old('tahun', $gelombang->tahun) }}" class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow" required>
                            @error('tahun')
                                <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="flex flex-wrap -mx-3">
                        <div class="w-full max-w-full px-3 mb-6 md:w-1/2 md:flex-none">
                            <label for="tgl_mulai" class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700">Tanggal Mulai <span class="text-red-500">*</span></label>
                            <input type="date" name="tgl_mulai" id="tgl_mulai" value="{{ old('tgl_mulai', $gelombang->tgl_mulai ? $gelombang->tgl_mulai->format('Y-m-d') : '') }}" class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow" required>
                            @error('tgl_mulai')
                                <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="w-full max-w-full px-3 mb-6 md:w-1/2 md:flex-none">
                            <label for="tgl_selesai" class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700">Tanggal Selesai <span class="text-red-500">*</span></label>
                            <input type="date" name="tgl_selesai" id="tgl_selesai" value="{{ old('tgl_selesai', $gelombang->tgl_selesai ? $gelombang->tgl_selesai->format('Y-m-d') : '') }}" class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow" required>
                            @error('tgl_selesai')
                                <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="flex flex-wrap -mx-3">
                        <div class="w-full max-w-full px-3 mb-6">
                            <label for="biaya_daftar" class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700">Biaya Pendaftaran <span class="text-red-500">*</span></label>
                            <input type="number" name="biaya_daftar" id="biaya_daftar" value="{{ old('biaya_daftar', $gelombang->biaya_daftar) }}" class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow" required>
                            @error('biaya_daftar')
                                <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="flex justify-end gap-2 mt-4">
                        <a href="{{ route('admin.gelombang.index') }}" class="inline-block px-6 py-3 font-bold text-center uppercase align-middle transition-all bg-transparent border border-solid rounded-lg shadow-none cursor-pointer leading-pro text-xs ease-soft-in bg-150 hover:scale-102 active:opacity-85 tracking-tight-soft bg-x-25 border-slate-700 text-slate-700 hover:bg-slate-700 hover:text-white">
                            Batal
                        </a>
                        <button type="submit" class="inline-block px-6 py-3 font-bold text-center text-white uppercase align-middle transition-all bg-transparent rounded-lg cursor-pointer leading-pro text-xs ease-soft-in shadow-soft-md bg-150 bg-gradient-to-tl from-purple-700 to-pink-500 hover:shadow-soft-xs active:opacity-85 hover:scale-102 tracking-tight-soft bg-x-25">
                            <i class="fas fa-save mr-2"></i>Update
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection