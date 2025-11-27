<?php

namespace App\Http\Controllers\Admin\DataMaster;

use App\Http\Controllers\Controller;
use App\Models\Wilayah;
use Illuminate\Http\Request;

class WilayahController extends Controller
{
    public function index()
    {
        // Get wilayah data that are actually used by registrants
        $wilayahs = Wilayah::whereHas('dataSiswa')->get();
        
        return view('admin.data_master.wilayah.index', compact('wilayahs'));
    }



    public function edit(Wilayah $wilayah)
    {
        return view('admin.data_master.wilayah.edit', compact('wilayah'));
    }

    public function update(Request $request, Wilayah $wilayah)
    {
        $request->validate([
            'provinsi' => 'required',
            'kabupaten' => 'required',
            'kecamatan' => 'required',
            'kelurahan' => 'required',
            'kodepos' => 'nullable'
        ]);

        $wilayah->update($request->all());
        return redirect()->route('admin.wilayah.index')->with('success', 'Wilayah berhasil diupdate');
    }

    public function destroy(Wilayah $wilayah)
    {
        $wilayah->delete();
        return redirect()->route('admin.wilayah.index')->with('success', 'Wilayah berhasil dihapus');
    }
}