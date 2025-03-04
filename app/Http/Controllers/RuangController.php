<?php

namespace App\Http\Controllers;

use App\Models\Ruangan;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Str;

class RuangController extends Controller
{
    public function index()
    {
        $ruangan = Ruangan::orderBy('plant', 'asc')->get();
        return view('superadmin.master.ruangan.index', compact('ruangan'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'nama_ruang' => 'required|string|max:255',
            'plant' => 'required|integer'
        ]);
        if ($request) {
            $cek = Ruangan::where('nama_ruang', $request->nama_ruang)->where('plant', $request->plant)->exists();
            if ($cek) {
                Alert::error('Gagal', 'Ruangan Sudah Ada');
                return redirect()->back();
            } else {
                Ruangan::create([
                    'nama_ruang' => $request->nama_ruang,
                    'plant' => $request->plant,
                ]);
                Alert::success('Sukses', 'Berhasil Menambahkan Ruangan');
                return redirect()->back();
            }
        }
    }
    public function destroy($id)
    {
        $data = Ruangan::find($id);
        if($data){
            $data->delete();
            Alert::success('Sukses', 'Berhasil Menghapus Ruangan');
            return redirect()->route('ruangan.index');
        }else{
            Alert::error('Gagal', 'Data Ruangan Tidak Ditemukan');
            return redirect()->route('ruangan.index');
        }
    }
}
