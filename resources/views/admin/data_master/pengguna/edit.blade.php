@extends('layouts.admin')

@section('title', 'Edit Pengguna')

@section('content')
<div class="flex flex-wrap -mx-3">
    <div class="flex-none w-full max-w-full px-3">
        <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
            <div class="p-6 pb-0 mb-0 bg-white border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                <div class="flex items-center justify-between">
                    <h6 class="font-bold">Edit Pengguna</h6>
                    <a href="{{ route('admin.pengguna.index') }}" class="inline-block px-6 py-3 font-bold text-center text-white uppercase align-middle transition-all bg-transparent rounded-lg cursor-pointer leading-pro text-xs ease-soft-in shadow-soft-md bg-150 bg-gradient-to-tl from-gray-900 to-slate-800 hover:shadow-soft-xs active:opacity-85 hover:scale-102 tracking-tight-soft bg-x-25">
                        <i class="fas fa-arrow-left mr-2"></i>Kembali
                    </a>
                </div>
            </div>
            <div class="flex-auto px-6 pt-0 pb-6">
                <form method="POST" action="{{ route('admin.pengguna.update', $pengguna) }}">
                    @csrf
                    @method('PUT')
                    <div class="flex flex-wrap -mx-3 mt-6">
                        <div class="w-full max-w-full px-3 mb-6 md:w-1/2 md:flex-none">
                            <label for="nama" class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700">Nama Lengkap <span class="text-red-500">*</span></label>
                            <input type="text" name="nama" id="nama" value="{{ old('nama', $pengguna->nama) }}" class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow" required>
                            @error('nama')
                                <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="w-full max-w-full px-3 mb-6 md:w-1/2 md:flex-none">
                            <label for="email" class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700">Email <span class="text-red-500">*</span></label>
                            <input type="email" name="email" id="email" value="{{ old('email', $pengguna->email) }}" class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow" required>
                            @error('email')
                                <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="flex flex-wrap -mx-3">
                        <div class="w-full max-w-full px-3 mb-6 md:w-1/2 md:flex-none">
                            <label for="hp" class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700">No. HP <span class="text-red-500">*</span></label>
                            <input type="text" name="hp" id="hp" value="{{ old('hp', $pengguna->hp) }}" class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow" required>
                            @error('hp')
                                <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="w-full max-w-full px-3 mb-6 md:w-1/2 md:flex-none">
                            <label for="role" class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700">Role <span class="text-red-500">*</span></label>
                            <select name="role" id="role" class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow" required>
                                <option value="">Pilih Role</option>
                                <option value="admin" {{ old('role', $pengguna->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                                <option value="verifikator_adm" {{ old('role', $pengguna->role) == 'verifikator_adm' ? 'selected' : '' }}>Verifikator Administrasi</option>
                                <option value="keuangan" {{ old('role', $pengguna->role) == 'keuangan' ? 'selected' : '' }}>Keuangan</option>
                                <option value="kepsek" {{ old('role', $pengguna->role) == 'kepsek' ? 'selected' : '' }}>Kepala Sekolah</option>
                                <option value="pendaftar" {{ old('role', $pengguna->role) == 'pendaftar' ? 'selected' : '' }}>Pendaftar</option>
                            </select>
                            @error('role')
                                <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="flex flex-wrap -mx-3">
                        <div class="w-full max-w-full px-3 mb-6 md:w-1/2 md:flex-none">
                            <label for="password" class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700">Password</label>
                            <input type="password" name="password" id="password" class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow" placeholder="Kosongkan jika tidak diubah">
                            @error('password')
                                <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="w-full max-w-full px-3 mb-6 md:w-1/2 md:flex-none">
                            <label for="aktif" class="inline-block mb-2 ml-1 font-bold text-xs text-slate-700">Status</label>
                            <select name="aktif" id="aktif" class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 transition-all focus:border-fuchsia-300 focus:outline-none focus:transition-shadow">
                                <option value="1" {{ old('aktif', $pengguna->aktif) == 1 ? 'selected' : '' }}>Aktif</option>
                                <option value="0" {{ old('aktif', $pengguna->aktif) == 0 ? 'selected' : '' }}>Nonaktif</option>
                            </select>
                        </div>
                    </div>
                    <div class="flex justify-end gap-2 mt-4">
                        <a href="{{ route('admin.pengguna.index') }}" class="inline-block px-6 py-3 font-bold text-center uppercase align-middle transition-all bg-transparent border border-solid rounded-lg shadow-none cursor-pointer leading-pro text-xs ease-soft-in bg-150 hover:scale-102 active:opacity-85 tracking-tight-soft bg-x-25 border-slate-700 text-slate-700 hover:bg-slate-700 hover:text-white">
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