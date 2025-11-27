<?php

namespace App\Http\Controllers\Admin\DataMaster;

use App\Http\Controllers\Controller;
use App\Models\Gelombang;
use Illuminate\Http\Request;

class GelombangController extends Controller
{
    public function index()
    {
        $gelombangs = Gelombang::all();
        return view('admin.data_master.gelombang.index', compact('gelombangs'));
    }

    public function create()
    {
        return view('admin.data_master.gelombang.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'tahun' => 'required',
            'tgl_mulai' => 'required|date',
            'tgl_selesai' => 'required|date|after:tgl_mulai',
            'biaya_daftar' => 'required|numeric'
        ]);

        Gelombang::create($request->all());
        return redirect()->route('admin.gelombang.index')->with('success', 'Gelombang berhasil ditambahkan');
    }

    public function edit(Gelombang $gelombang)
    {
        return view('admin.data_master.gelombang.edit', compact('gelombang'));
    }

    public function update(Request $request, Gelombang $gelombang)
    {
        $request->validate([
            'nama' => 'required',
            'tahun' => 'required',
            'tgl_mulai' => 'required|date',
            'tgl_selesai' => 'required|date|after:tgl_mulai',
            'biaya_daftar' => 'required|numeric'
        ]);

        $gelombang->update($request->all());
        return redirect()->route('admin.gelombang.index')->with('success', 'Gelombang berhasil diupdate');
    }

    public function destroy(Gelombang $gelombang)
    {
        $gelombang->delete();
        return redirect()->route('admin.gelombang.index')->with('success', 'Gelombang berhasil dihapus');
    }
}