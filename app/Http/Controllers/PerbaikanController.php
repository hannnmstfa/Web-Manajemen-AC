<?php

namespace App\Http\Controllers;

use App\Models\AC;
use App\Models\Perbaikan;
use App\Models\Report;
use App\Models\Vendor;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Str;

class PerbaikanController extends Controller
{
    public function index()
    {
        $vendor = Vendor::all();
        $pengajuan = Perbaikan::where('status', 'pengajuan')->get();
        $proses = Perbaikan::where('status', 'proses')->get();
        return view('superadmin.perbaikan.index', compact('pengajuan', 'vendor', 'proses'));
    }
    public function create()
    {
        $ac = AC::where('status', 'normal')->get();
        return view('superadmin.perbaikan.create', compact('ac'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'ac_id' => 'required|integer',
            'tgl_pengajuan' => 'required|date',
            'permasalahan' => 'required|string',
            'indikasi' => 'required|string'
        ]);
        if ($request) {
            Perbaikan::create([
                'ac_id' => $request->ac_id,
                'tgl_pengajuan' => $request->tgl_pengajuan,
                'permasalahan' => $request->permasalahan,
                'indikasi' => $request->indikasi,
            ]);
            Alert::success('Sukses', 'Berhasil Mengajukan Perbaikan');
            return redirect()->route('pengajuan.index');
        }
    }
    public function acc(Request $request, $id)
    {
        $pengajuan = Perbaikan::find($id);
        $ac = AC::where('id', $pengajuan->ac_id)->first();
        if ($pengajuan) {
            $pengajuan->update([
                'vendor_id' => $request->vendor_id,
                'status' => 'proses',
            ]);
            $ac->update([
                'status' => 'perbaikan'
            ]);
            Alert::success('Berhasil', 'Pengajuan Telah disetujui');
            return redirect()->back();
        } else {
            Alert::error('Gagal', 'Data Tidak Ditemukan');
            return redirect()->back();
        }
    }
    public function edit($id)
    {
        $pengajuan = Perbaikan::find($id);
        $ac = AC::where('status', 'normal')->get();
        return view('superadmin.perbaikan.edit', compact('pengajuan', 'ac'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'ac_id' => 'required|integer',
            'tgl_pengajuan' => 'required|date',
            'permasalahan' => 'required|string',
            'indikasi' => 'required|string'
        ]);
        if($request){
            $pengajuan = Perbaikan::find($id);
            $pengajuan->update([
                'ac_id' => $request->ac_id,
                'tgl_pengajuan' => $request->tgl_pengajuan,
                'permasalahan' => $request->permasalahan,
                'indikasi' => $request->indikasi,
            ]);
            Alert::success('Sukses', 'Berhasil Menyimpan Perubahan');
            return redirect()->route('pengajuan.index');
        }else{
            Alert::error('Gagal', 'Tidak dapat memperbarui data');
            return redirect()->route('pengajuan.index');
        }
    }
    public function destroy($id){
        $pengajuan = Perbaikan::find($id);
        if($pengajuan){
            $pengajuan->delete();
            Alert::success('Sukses', 'Berhasil Menghapus Pengajuan');
            return redirect()->back();
        }else{
            Alert::error('Gagal', 'Data Tidak ditemukan');
            return redirect()->back();
        }
    }
    public function proses(){
        $proses = Perbaikan::where('status', 'proses')->get();
        return view('superadmin.perbaikan.proses', compact('proses'));
    }
    public function show($id){
        $proses = Perbaikan::find($id);
        return view('superadmin.perbaikan.detail', compact('proses'));
    }
    public function uploadfoto(Request $request, $id){
        $request->validate([
            'foto_petugas'=> 'nullable|file|mimes:jpeg,jpg,png,webp,svg',
            'foto_perbaikan'=> 'nullable|file|mimes:jpeg,jpg,png,webp,svg',
            'foto_pemeriksa'=> 'nullable|file|mimes:jpeg,jpg,png,webp,svg',
        ]);
        // dd($request->all(), $id);
        if($request){
            $perbaikan = Perbaikan::find($id);
            if($request->hasFile('foto_petugas')){
                if($perbaikan->foto_petugas !== null){
                    unlink(public_path('/storage/image/perbaikan/' . $perbaikan->foto_petugas));
                }
                $ekstensi = $request->file('foto_petugas')->getClientOriginalExtension();
                $foto_petugas = 'Petugas-' . Str::random(20) . '.' . $ekstensi;
                $request->file('foto_petugas')->move(public_path('/storage/image/perbaikan/'), $foto_petugas);
                $perbaikan->foto_petugas = $foto_petugas;
                $perbaikan->save();
                Alert::success('Berhasil', 'Foto Petugas Berhasil di Upload');
                return redirect()->back();
            }
            if($request->hasFile('foto_perbaikan')){
                if($perbaikan->foto_perbaikan !== null){
                    unlink(public_path('/storage/image/perbaikan/' . $perbaikan->foto_perbaikan));
                }
                $ekstensi = $request->file('foto_perbaikan')->getClientOriginalExtension();
                $foto_perbaikan = 'Perbaikan-' . Str::random(20) . '.' . $ekstensi;
                $request->file('foto_perbaikan')->move(public_path('/storage/image/perbaikan/'), $foto_perbaikan);
                $perbaikan->foto_perbaikan = $foto_perbaikan;
                $perbaikan->save();
                Alert::success('Berhasil', 'Foto Perbaikan Berhasil di Upload');
                return redirect()->back();
            }
            if($request->hasFile('foto_pemeriksa')){
                if($perbaikan->foto_pemeriksa !== null){
                    unlink(public_path('/storage/image/perbaikan/' . $perbaikan->foto_pemeriksa));
                }
                $ekstensi = $request->file('foto_pemeriksa')->getClientOriginalExtension();
                $foto_pemeriksa = 'Pemeriksa-' . Str::random(20) . '.' . $ekstensi;
                $request->file('foto_pemeriksa')->move(public_path('/storage/image/perbaikan/'), $foto_pemeriksa);
                $perbaikan->foto_pemeriksa = $foto_pemeriksa;
                $perbaikan->save();
                Alert::success('Berhasil', 'Foto pemeriksa Berhasil di Upload');
                return redirect()->back();
            }
        }
    }
    public function success(Request $request, $id){
        $request->validate([
            'tgl_selesai'=> 'required|date'
        ]);
        if($request){
            $perbaikan = Perbaikan::find($id);
            if($perbaikan->foto_petugas && $perbaikan->foto_perbaikan && $perbaikan->foto_pemeriksa !== null){
                $perbaikan->update([
                    'tgl_selesai' => $request->tgl_selesai,
                    'status'=> 'selesai',
                ]);
                $ac = AC::where('id', $perbaikan->ac_id)->first();
                $ac->status = 'normal';
                $ac->update();
                Report::create([
                    'kategori'=> 'perbaikan',
                    'ac_id'=> $ac->id,
                    'tanggal'=> $request->tgl_selesai,
                ]);
                Alert::success('Berhasil', 'AC Selesai diperbaiki');
                return redirect()->route('proses.index');
            }else{
                Alert::error('Gagal', 'Silahkan Lengkapi Semua Foto');
                return redirect()->back();
            }
        }
    }
    public function selesai(){
        $selesai = Perbaikan::where('status', 'selesai')->get();
        return view('superadmin.perbaikan.selesai', compact('selesai'));
    }
    public function detailselesai($id){
        $selesai = Perbaikan::find($id);
        return view('superadmin.perbaikan.detail-selesai', compact('selesai'));
    }
}
