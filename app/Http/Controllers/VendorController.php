<?php

namespace App\Http\Controllers;

use App\Models\Vendor;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class VendorController extends Controller
{
    public function index(){
        $vendor = Vendor::all();
        return view('superadmin.master.vendor.index', compact('vendor'));
    }
    public function destroy($id){
        $vendor = Vendor::find($id);
        if($vendor){
            $vendor->delete();
            Alert::success('Sukses', 'Berhasil Menghapus data Vendor');
            return redirect()->back();
        }else{
            Alert::error('Gagal', 'Data Tidak Ditemukan');
            return redirect()->back();
        }
    }
    public function create(){
        return view('superadmin.master.vendor.create');
    }
    public function store(Request $request){
        $request->validate([
            'nama_vendor'=> 'required|string|max:255',
            'alamat'=> 'required|string',
            'phone'=> 'nullable|string'
        ]);
        if($request){
            Vendor::create([
                'nama_vendor'=> $request->nama_vendor,
                'alamat'=> $request->alamat,
                'phone'=> $request->phone
            ]);
            Alert::success('Sukses', 'Berhasil Menambahkan Vendor');
            return redirect()->route('vendor.index');
        }else{
            Alert::error('Gagal', 'Tidak Dapat Menambahkan Vendor');
            return redirect()->back();
        }
    }
    public function edit($id){
        $vendor = Vendor::find($id);
        return view('superadmin.master.vendor.edit', compact('vendor'));
    }
    public function update(Request $request, $id){
        $request->validate([
            'nama_vendor'=> 'required|string|max:255',
            'alamat'=> 'required|string',
            'phone'=> 'nullable|string'
        ]);
        if($request){
            $vendor = Vendor::find($id);
            $vendor->update([
                'nama_vendor'=> $request->nama_vendor,
                'alamat'=> $request->alamat,
                'phone'=> $request->phone
            ]);
            Alert::success('Sukses', 'Berhasil Mengupdate Vendor');
            return redirect()->route('vendor.index');
        }else{
            Alert::error('Gagal', 'Tidak Dapat Mengupdate Vendor');
            return redirect()->back();
        }
    }
}
