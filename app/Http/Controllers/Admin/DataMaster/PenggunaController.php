<?php

namespace App\Http\Controllers\Admin\DataMaster;

use App\Http\Controllers\Controller;
use App\Models\Pengguna;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PenggunaController extends Controller
{
    public function index()
    {
        $penggunas = Pengguna::all();
        return view('admin.data_master.pengguna.index', compact('penggunas'));
    }

    public function create()
    {
        return view('admin.data_master.pengguna.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'email' => 'required|email|unique:penggunas',
            'hp' => 'required',
            'password' => 'required|min:6',
            'role' => 'required|in:admin,verifikator_adm,keuangan,kepsek,pendaftar'
        ]);

        $data = $request->all();
        $data['password_hash'] = Hash::make($request->password);
        unset($data['password']);

        Pengguna::create($data);
        return redirect()->route('admin.pengguna.index')->with('success', 'Pengguna berhasil ditambahkan');
    }

    public function edit(Pengguna $pengguna)
    {
        return view('admin.data_master.pengguna.edit', compact('pengguna'));
    }

    public function update(Request $request, Pengguna $pengguna)
    {
        $request->validate([
            'nama' => 'required',
            'email' => 'required|email|unique:penggunas,email,' . $pengguna->id,
            'hp' => 'required',
            'role' => 'required|in:admin,verifikator_adm,keuangan,kepsek,pendaftar'
        ]);

        $data = $request->except('password');
        if ($request->password) {
            $data['password_hash'] = Hash::make($request->password);
        }

        $pengguna->update($data);
        return redirect()->route('admin.pengguna.index')->with('success', 'Pengguna berhasil diupdate');
    }

    public function destroy(Pengguna $pengguna)
    {
        $pengguna->delete();
        return redirect()->route('admin.pengguna.index')->with('success', 'Pengguna berhasil dihapus');
    }
}