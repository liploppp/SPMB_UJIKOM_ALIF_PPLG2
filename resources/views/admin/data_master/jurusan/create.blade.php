@extends('layouts.admin')

@section('title', 'Tambah Jurusan')

@section('content')
<div class="flex flex-wrap -mx-3">
    <div class="flex-none w-full max-w-full px-3">
        <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
            <div class="p-6 pb-0 mb-0 bg-white border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                <div class="flex flex-wrap -mx-3">
                    <div class="flex-none w-1/2 max-w-full px-3">
                        <h6>Tambah Jurusan Baru</h6>
                        <p class="mb-0 text-sm leading-normal">Buat jurusan baru untuk sistem PPDB</p>
                    </div>
                    <div class="flex-none w-1/2 max-w-full px-3 text-right">
                        <a href="{{ route('admin.jurusan.index') }}" class="inline-block px-6 py-3 mb-0 font-bold text-center uppercase align-middle transition-all bg-transparent border border-solid rounded-lg shadow-none cursor-pointer leading-pro text-xs ease-soft-in tracking-tight-soft bg-150 bg-x-25 border-slate-600 bg-none text-slate-600 hover:border-slate-600">
                            <i class="fas fa-arrow-left mr-2"></i>Kembali
                        </a>
                    </div>
                </div>
            </div>
            <div class="flex-auto px-6 pt-0 pb-6">
                <form method="POST" action="{{ route('admin.jurusan.store') }}">
                    @csrf
                    <div class="flex flex-wrap -mx-3">
                        <div class="w-full max-w-full px-3 md:w-1/2 md:flex-none">
                            <div class="mb-4">
                                <label for="kode" class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700">Kode Jurusan</label>
                                <input type="text" name="kode" id="kode" value="{{ old('kode') }}" class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow" placeholder="Contoh: TKJ, RPL, MM" required>
                                @error('kode')
                                    <p class="mt-2 text-xs text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="w-full max-w-full px-3 md:w-1/2 md:flex-none">
                            <div class="mb-4">
                                <label for="kuota" class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700">Kuota</label>
                                <input type="number" name="kuota" id="kuota" value="{{ old('kuota') }}" class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow" placeholder="Jumlah kuota siswa" required>
                                @error('kuota')
                                    <p class="mt-2 text-xs text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-wrap -mx-3">
                        <div class="w-full max-w-full px-3">
                            <div class="mb-4">
                                <label for="nama" class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700">Nama Jurusan</label>
                                <input type="text" name="nama" id="nama" value="{{ old('nama') }}" class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow" placeholder="Nama lengkap jurusan" required>
                                @error('nama')
                                    <p class="mt-2 text-xs text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-end space-x-2">
                        <a href="{{ route('admin.jurusan.index') }}" class="inline-block px-6 py-3 mb-0 font-bold text-center uppercase align-middle transition-all bg-transparent border border-solid rounded-lg shadow-none cursor-pointer leading-pro text-xs ease-soft-in tracking-tight-soft bg-150 bg-x-25 border-slate-600 bg-none text-slate-600 hover:border-slate-600">
                            Batal
                        </a>
                        <button type="submit" class="inline-block px-6 py-3 mb-0 font-bold text-center text-white uppercase align-middle transition-all border-0 rounded-lg cursor-pointer hover:scale-102 active:opacity-85 hover:shadow-soft-xs leading-pro text-xs ease-soft-in tracking-tight-soft shadow-soft-md bg-150 bg-x-25 bg-gradient-to-tl from-blue-600 to-cyan-400">
                            <i class="fas fa-save mr-2"></i>Simpan
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection