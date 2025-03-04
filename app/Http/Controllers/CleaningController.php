<?php

namespace App\Http\Controllers;
use App\Models\AC;
use App\Models\Cleaning;
use App\Models\Report;
use App\Models\Vendor;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Str;

class CleaningController extends Controller
{
    // Menampilkan daftar cleaning yang masih dalam proses
    public function index()
    {
        $proses = Cleaning::where('status', 'proses')->orderBy('tgl_planing', 'desc')->get();
        $selesai = Cleaning::where('status', 'selesai')->orderBy('tgl_actual', 'desc')->get();
        return view('superadmin.cleaning.index', compact('proses', 'selesai'));
    }

    // Menampilkan form tambah data cleaning
    public function create()
    {
        $vendor = Vendor::all();
        $ac = AC::all();
        return view('superadmin.cleaning.create', compact('ac', 'vendor'));  // Mengirim data AC ke view
    }


    // Menyimpan data cleaning baru
    public function store(Request $request)
    {
        $request->validate([
            'tgl_planing' => 'required|date',
            'ac_id' => 'required|integer',
            'vendor_id' => 'required|integer',
        ]);

        Cleaning::create([
            'tgl_planing' => $request->tgl_planing,
            'ac_id' => $request->ac_id,
            'vendor_id' => $request->vendor_id,
        ]);

        return redirect()->route('cleaning.index')->with('success', 'Data Cleaning berhasil ditambahkan!');
    }


    public function edit($id)
    {
        $proses = Cleaning::find($id);
        $vendor = Vendor::all();
        $ac = AC::all();
        return view('superadmin.cleaning.edit', compact('proses', 'vendor', 'ac'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'tgl_planing' => 'required|date',
            'ac_id' => 'required|integer',
            'vendor_id' => 'required|integer',
        ]);
        if ($request) {
            $proses = Cleaning::find($id);
            $proses->update([
                'tgl_planing' => $request->tgl_planing,
                'ac_id' => $request->ac_id,
                'vendor_id' => $request->vendor_id,
            ]);
            Alert::success('Berhasil', 'Data Planing Berhasil di edit');
            return redirect()->route('cleaning.index');
        } else {
            Alert::error('Gagal', 'Tidak Dapat Mengubah Data');
            return redirect()->route('cleaning.index');
        }
    }
    public function detail($id)
    {
        $proses = Cleaning::find($id);
        return view('superadmin.cleaning.rincian', compact('proses'));
    }
    public function success(Request $request, $id)
    {
        $request->validate([
            'tgl_actual' => 'required|date'
        ]);
        if ($request) {
            $cleaning = Cleaning::find($id);
            if ($cleaning->foto_petugas && $cleaning->foto_cleaning && $cleaning->foto_pemeriksa !== null) {
                $cleaning->update([
                    'tgl_actual' => $request->tgl_actual,
                    'status' => 'selesai',
                ]);
                $ac = AC::where('id', $cleaning->ac_id)->first();
                Report::create([
                    'kategori' => 'cleaning',
                    'ac_id' => $ac->id,
                    'tanggal'=> $request->tgl_actual,
                ]);
                Alert::success('Berhasil', 'AC Selesai di Cleaning');
                return redirect()->route('cleaning.index');
            } else {
                Alert::error('Gagal', 'Silahkan Lengkapi Semua Foto');
                return redirect()->back();
            }
        }
    }
    public function uploadfoto(Request $request, $id)
    {
        $request->validate([
            'foto_petugas' => 'nullable|file|mimes:jpeg,jpg,png,webp,svg',
            'foto_cleaning' => 'nullable|file|mimes:jpeg,jpg,png,webp,svg',
            'foto_pemeriksa' => 'nullable|file|mimes:jpeg,jpg,png,webp,svg',
        ]);
        // dd($request->all(), $id);
        if ($request) {
            $cleaning = Cleaning::find($id);
            if ($request->hasFile('foto_petugas')) {
                if ($cleaning->foto_petugas !== null) {
                    unlink(public_path('/storage/image/cleaning/' . $cleaning->foto_petugas));
                }
                $ekstensi = $request->file('foto_petugas')->getClientOriginalExtension();
                $foto_petugas = 'Petugas-' . Str::random(20) . '.' . $ekstensi;
                $request->file('foto_petugas')->move(public_path('/storage/image/cleaning/'), $foto_petugas);
                $cleaning->foto_petugas = $foto_petugas;
                $cleaning->save();
                Alert::success('Berhasil', 'Foto Petugas Berhasil di Upload');
                return redirect()->back();
            }
            if ($request->hasFile('foto_cleaning')) {
                if ($cleaning->foto_cleaning !== null) {
                    unlink(public_path('/storage/image/cleaning/' . $cleaning->foto_cleaning));
                }
                $ekstensi = $request->file('foto_cleaning')->getClientOriginalExtension();
                $foto_cleaning = 'Cleaning-' . Str::random(20) . '.' . $ekstensi;
                $request->file('foto_cleaning')->move(public_path('/storage/image/cleaning/'), $foto_cleaning);
                $cleaning->foto_cleaning = $foto_cleaning;
                $cleaning->save();
                Alert::success('Berhasil', 'Foto Cleaning Berhasil di Upload');
                return redirect()->back();
            }
            if ($request->hasFile('foto_pemeriksa')) {
                if ($cleaning->foto_pemeriksa !== null) {
                    unlink(public_path('/storage/image/cleaning/' . $cleaning->foto_pemeriksa));
                }
                $ekstensi = $request->file('foto_pemeriksa')->getClientOriginalExtension();
                $foto_pemeriksa = 'Pemeriksa-' . Str::random(20) . '.' . $ekstensi;
                $request->file('foto_pemeriksa')->move(public_path('/storage/image/cleaning/'), $foto_pemeriksa);
                $cleaning->foto_pemeriksa = $foto_pemeriksa;
                $cleaning->save();
                Alert::success('Berhasil', 'Foto Pemeriksa Berhasil di Upload');
                return redirect()->back();
            }
        }
    }
    public function show($id){
        $detail = Cleaning::find($id);
        return view('superadmin.cleaning.detail', compact('detail'));
    }
}
