<?php

namespace App\Http\Controllers\Admin\DataMaster;

use App\Http\Controllers\Controller;
use App\Models\Jurusan;
use Illuminate\Http\Request;

class JurusanController extends Controller
{
    public function index()
    {
        $jurusans = Jurusan::all();
        return view('admin.data_master.jurusan.index', compact('jurusans'));
    }

    public function create()
    {
        return view('admin.data_master.jurusan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode' => 'required|unique:jurusans',
            'nama' => 'required',
            'kuota' => 'required|integer'
        ]);

        Jurusan::create($request->all());
        return redirect()->route('admin.jurusan.index')->with('success', 'Jurusan berhasil ditambahkan');
    }

    public function edit(Jurusan $jurusan)
    {
        return view('admin.data_master.jurusan.edit', compact('jurusan'));
    }

    public function update(Request $request, Jurusan $jurusan)
    {
        $request->validate([
            'kode' => 'required|unique:jurusans,kode,' . $jurusan->id,
            'nama' => 'required',
            'kuota' => 'required|integer'
        ]);

        $jurusan->update($request->all());
        return redirect()->route('admin.jurusan.index')->with('success', 'Jurusan berhasil diupdate');
    }

    public function destroy(Jurusan $jurusan)
    {
        $jurusan->delete();
        return redirect()->route('admin.jurusan.index')->with('success', 'Jurusan berhasil dihapus');
    }
}