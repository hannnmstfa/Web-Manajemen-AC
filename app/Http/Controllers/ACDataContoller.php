<?php

namespace App\Http\Controllers;

use App\Models\AC;
use App\Models\Report;
use App\Models\Ruangan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Str;

class ACDataContoller extends Controller
{
    private function convertromawi($bulan)
    {
        $romawi = [
            1 => 'I',
            2 => 'II',
            3 => 'III',
            4 => 'IV',
            5 => 'V',
            6 => 'VI',
            7 => 'VII',
            8 => 'VIII',
            9 => 'IX',
            10 => 'X',
            11 => 'XI',
            12 => 'XII'
        ];
        return $romawi[(int) $bulan] ?? null; // Pastikan validasi input angka bulan
    }

    public function index()
    {
        $ac = AC::orderBy('kode_inv', 'desc')->orderBy('plant', 'desc')->get();
        $jumlah = AC::count();
        return view('superadmin.ac.index', compact('ac', 'jumlah'));
    }
    public function create()
    {
        $ruangan = Ruangan::all();
        return view('superadmin.ac.create', compact('ruangan'));
    }
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'nama_ac' => 'required|string|max:255',
            'tgl_pemasangan' => 'required|date',
            'ruangan_id' => 'required|integer',
            'spesifikasi' => 'required|string',
            'tempat_beli' => 'nullable|string',
            'pk' => 'required|string',
            'foto_nota' => 'nullable|file|mimes:jpg,png,jpeg,svg,webp',
            'foto_petugas' => 'nullable|file|mimes:jpg,png,jpeg,svg,webp',
            'foto_pemasangan' => 'nullable|file|mimes:jpg,png,jpeg,svg,webp',
            'foto_pemeriksa' => 'nullable|file|mimes:jpg,png,jpeg,svg,webp',
            'foto_indoor' => 'nullable|file|mimes:jpg,png,jpeg,svg,webp',
            'foto_outdoor' => 'nullable|file|mimes:jpg,png,jpeg,svg,webp',
        ]);

        if ($request) {
            if ($request->hasFile('foto_nota')) {
                $ekstensi = $request->file('foto_nota')->getClientOriginalExtension();
                $nota = 'Nota-' . Str::random(20) . '.' . $ekstensi;
                $request->file('foto_nota')->move(public_path('/storage/image/ac/'), $nota);
            }
            if ($request->hasFile('foto_petugas')) {
                $ekstensi = $request->file('foto_petugas')->getClientOriginalExtension();
                $petugas = 'Petugas-' . Str::random(20) . '.' . $ekstensi;
                $request->file('foto_petugas')->move(public_path('/storage/image/ac/'), $petugas);
            }
            if ($request->hasFile('foto_pemasangan')) {
                $ekstensi = $request->file('foto_pemasangan')->getClientOriginalExtension();
                $pemasangan = 'Pemasangan-' . Str::random(20) . '.' . $ekstensi;
                $request->file('foto_pemasangan')->move(public_path('/storage/image/ac/'), $pemasangan);
            }
            if ($request->hasFile('foto_pemeriksa')) {
                $ekstensi = $request->file('foto_pemeriksa')->getClientOriginalExtension();
                $pemeriksa = 'Pemeriksa-' . Str::random(20) . '.' . $ekstensi;
                $request->file('foto_pemeriksa')->move(public_path('/storage/image/ac/'), $pemeriksa);
            }
            if ($request->hasFile('foto_indoor')) {
                $ekstensi = $request->file('foto_indoor')->getClientOriginalExtension();
                $indoor = 'Indoor-' . Str::random(20) . '.' . $ekstensi;
                $request->file('foto_indoor')->move(public_path('/storage/image/ac/'), $indoor);
            }
            if ($request->hasFile('foto_outdoor')) {
                $ekstensi = $request->file('foto_outdoor')->getClientOriginalExtension();
                $outdoor = 'Outdoor-' . Str::random(20) . '.' . $ekstensi;
                $request->file('foto_outdoor')->move(public_path('/storage/image/ac/'), $outdoor);
            }
            // Ambil Data Ruangan
            $ruang = Ruangan::where('id', $request->ruangan_id)->first();
            // Ambil data terakhir
            $data_terakhir = AC::orderBy('kode_inv', 'desc')
                ->where('plant', $ruang->plant)->first();
            if ($data_terakhir) {
                $data_terakhir = (int) strtok($data_terakhir->kode_inv, '/'); //Ambil pemisah /
            } else {
                $data_terakhir = 0;
            }
            $no_baru = $data_terakhir + 1;

            // Konvert Romawi
            $bulan = Carbon::parse($request->tgl_pemasangan)->isoFormat('M');
            $tahun = Carbon::parse($request->tgl_pemasangan)->isoFormat('YY');
            $bulan = $this->convertromawi($bulan);

            // Format Kode Inventory
            $kode_inv = str_pad($no_baru, 2, '0', STR_PAD_LEFT) . '/SIK-' . $ruang->plant . '/' . $bulan . '/' . $tahun;

            $ac = AC::create([
                'kode_inv' => $kode_inv,
                'tgl_pemasangan' => $request->tgl_pemasangan,
                'nama_ac' => $request->nama_ac,
                'ruangan_id' => $request->ruangan_id,
                'plant' => $ruang->plant,
                'spesifikasi' => $request->spesifikasi,
                'tempat_beli' => $request->tempat_beli,
                'pk' => $request->pk,
                'foto_nota' => $nota ?? null,
                'foto_petugas' => $petugas ?? null,
                'foto_pemasangan' => $pemasangan ?? null,
                'foto_pemeriksa' => $pemeriksa ?? null,
                'foto_indoor' => $indoor ?? null,
                'foto_outdoor' => $outdoor ?? null,
            ]);
            Report::create([
                'kategori' => 'pemasangan',
                'ac_id' => $ac->id,
                'tanggal' => $request->tgl_pemasangan,
            ]);
            Alert::success('Sukses', 'Berhasil Menambahkan AC');
            return redirect()->route('ac.index');
        }
    }
    public function edit($id)
    {
        $ac = AC::find($id);
        $ruangan = Ruangan::all();
        return view('superadmin.ac.edit', compact('ac', 'ruangan'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_ac' => 'required|string|max:255',
            'tgl_pemasangan' => 'required|date',
            'ruangan_id' => 'required|integer',
            'spesifikasi' => 'required|string',
            'tempat_beli' => 'nullable|string',
            'pk' => 'required|string',
            'foto_nota' => 'nullable|file|mimes:jpg,png,jpeg,svg,webp',
            'foto_petugas' => 'nullable|file|mimes:jpg,png,jpeg,svg,webp',
            'foto_pemasangan' => 'nullable|file|mimes:jpg,png,jpeg,svg,webp',
            'foto_pemeriksa' => 'nullable|file|mimes:jpg,png,jpeg,svg,webp',
            'foto_indoor' => 'nullable|file|mimes:jpg,png,jpeg,svg,webp',
            'foto_outdoor' => 'nullable|file|mimes:jpg,png,jpeg,svg,webp',
        ]);

        if ($request) {
            $ac = AC::find($id);
            if ($request->hasFile('foto_nota')) {
                $ekstensi = $request->file('foto_nota')->getClientOriginalExtension();
                $nota = 'Nota-' . Str::random(20) . '.' . $ekstensi;
                if ($ac->foto_nota !== null) {
                    unlink(public_path('/storage/image/ac/' . $ac->foto_nota));
                }
                $request->file('foto_nota')->move(public_path('/storage/image/ac/'), $nota);
            }
            if ($request->hasFile('foto_petugas')) {
                $ekstensi = $request->file('foto_petugas')->getClientOriginalExtension();
                $petugas = 'Petugas-' . Str::random(20) . '.' . $ekstensi;
                if ($ac->foto_petugas !== null) {
                    unlink(public_path('/storage/image/ac/' . $ac->foto_petugas));
                }
                $request->file('foto_petugas')->move(public_path('/storage/image/ac/'), $petugas);
            }
            if ($request->hasFile('foto_pemasangan')) {
                $ekstensi = $request->file('foto_pemasangan')->getClientOriginalExtension();
                $pemasangan = 'Pemasangan-' . Str::random(20) . '.' . $ekstensi;
                if ($ac->foto_pemasangan !== null) {
                    unlink(public_path('/storage/image/ac/' . $ac->foto_pemasangan));
                }
                $request->file('foto_pemasangan')->move(public_path('/storage/image/ac/'), $pemasangan);
            }
            if ($request->hasFile('foto_pemeriksa')) {
                $ekstensi = $request->file('foto_pemeriksa')->getClientOriginalExtension();
                $pemeriksa = 'Pemeriksa-' . Str::random(20) . '.' . $ekstensi;
                if ($ac->foto_pemeriksa !== null) {
                    unlink(public_path('/storage/image/ac/' . $ac->foto_pemeriksa));
                }
                $request->file('foto_pemeriksa')->move(public_path('/storage/image/ac/'), $pemeriksa);
            }
            if ($request->hasFile('foto_indoor')) {
                $ekstensi = $request->file('foto_indoor')->getClientOriginalExtension();
                $indoor = 'Indoor-' . Str::random(20) . '.' . $ekstensi;
                if ($ac->foto_indoor !== null) {
                    unlink(public_path('/storage/image/ac/' . $ac->foto_indoor));
                }
                $request->file('foto_indoor')->move(public_path('/storage/image/ac/'), $indoor);
            }
            if ($request->hasFile('foto_outdoor')) {
                $ekstensi = $request->file('foto_outdoor')->getClientOriginalExtension();
                $outdoor = 'Outdoor-' . Str::random(20) . '.' . $ekstensi;
                if ($ac->foto_indoor !== null) {
                    unlink(public_path('/storage/image/ac/' . $ac->foto_outdoor));
                }
                $request->file('foto_outdoor')->move(public_path('/storage/image/ac/'), $outdoor);
            }

            $ac = AC::find($id);
            // Ambil Data Ruangan
            $ruang = Ruangan::where('id', $request->ruangan_id)->first();
            if ($ac->plant !== $ruang->plant) {
                // Ambil data terakhir
                $data_terakhir = AC::orderBy('kode_inv', 'desc')
                    ->where('plant', $ruang->plant)->first();
                if ($data_terakhir) {
                    $data_terakhir = (int) strtok($data_terakhir->kode_inv, '/'); //Ambil pemisah /
                } else {
                    $data_terakhir = 0;
                }
                $no_baru = $data_terakhir + 1;

                // Konvert Romawi
                $bulan = Carbon::parse($request->tgl_pemasangan)->isoFormat('M');
                $tahun = Carbon::parse($request->tgl_pemasangan)->isoFormat('YY');
                $bulan = $this->convertromawi($bulan);

                // Format Kode Inventory
                $kode_inv = str_pad($no_baru, 2, '0', STR_PAD_LEFT) . '/SIK-' . $ruang->plant . '/' . $bulan . '/' . $tahun;
                $ac->update([
                    'kode_inv' => $kode_inv,
                ]);
            }
            if ($ac->tgl_pemasangan !== $request->tgl_pemasangan) {
                // Konvert Romawi
                $bulan = Carbon::parse($request->tgl_pemasangan)->isoFormat('M');
                $tahun = Carbon::parse($request->tgl_pemasangan)->isoFormat('YY');
                $bulan = $this->convertromawi($bulan);
                $angka = (int) strtok($ac->kode_inv, '/');
                $kode_inv = str_pad($angka, 2, '0', STR_PAD_LEFT) . '/SIK-' . $ruang->plant . '/' . $bulan . '/' . $tahun;
                $ac->update([
                    'kode_inv' => $kode_inv,
                ]);
                $report = Report::where('ac_id', $ac->id)
                ->where('kategori', 'pemasangan')->first();
                $report->update([
                    'tanggal' => $request->tgl_pemasangan,
                ]);
            }
            $ac->update([
                'nama_ac' => $request->nama_ac,
                'tgl_pemasangan' => $request->tgl_pemasangan,
                'ruangan_id' => $request->ruangan_id,
                'spesifikasi' => $request->spesifikasi,
                'tempat_beli' => $request->tempat_beli,
                'plant' => $ruang->plant,
                'pk' => $request->pk,
                'foto_nota' => $nota ?? $ac->foto_nota,
                'foto_petugas' => $petugas ?? $ac->foto_petugas,
                'foto_pemasangan' => $pemasangan ?? $ac->foto_pemasangan,
                'foto_pemeriksa' => $pemeriksa ?? $ac->foto_pemeriksa,
                'foto_indoor' => $indoor ?? $ac->foto_indoor,
                'foto_outdoor' => $outdoor ?? $ac->foto_outdoor,
            ]);

            Alert::success('Sukses', 'Data Berhasil Diperbarui');
            return redirect()->route('ac.index');
        } else {
            Alert::error('Gagal', 'Tidak Dapat Memperbarui Data');
            return redirect()->route('ac.index');
        }
    }
    public function destroy($id)
    {
        $ac = AC::find($id);
        if ($ac) {
            if ($ac->foto_nota !== null) {
                unlink(public_path('/storage/image/ac/' . $ac->foto_nota));
            }
            if ($ac->foto_petugas !== null) {
                unlink(public_path('/storage/image/ac/' . $ac->foto_petugas));
            }
            if ($ac->foto_pemasangan !== null) {
                unlink(public_path('/storage/image/ac/' . $ac->foto_pemasangan));
            }
            if ($ac->foto_pemeriksa !== null) {
                unlink(public_path('/storage/image/ac/' . $ac->foto_pemeriksa));
            }
            if ($ac->foto_indoor !== null) {
                unlink(public_path('/storage/image/ac/' . $ac->foto_indoor));
            }
            if ($ac->foto_outdoor !== null) {
                unlink(public_path('/storage/image/ac/' . $ac->foto_outdoor));
            }
            $report = Report::where('created_at', $ac->created_at)->first();
            if ($report) {
                $report->delete();
            }
            $ac->delete();
            Alert::success('Sukses', 'Berhasil Menghapus AC');
            return redirect()->back();
        } else {
            Alert::error('Gagal', 'Data Tidak Ditemukan');
            return redirect()->back();
        }
    }
    public function show($id)
    {
        $ac = AC::find($id);
        return view('superadmin.ac.detail', compact('ac'));
    }
    public function cetak(Request $request)
    {
        $filter = $request->get('plant', 'default');
        switch ($filter) {
            case 'plant2':
                $ac = AC::where('plant', 2)->orderBy('kode_inv', 'asc')->get();
                break;
            case 'plant3':
                $ac = AC::where('plant', 3)->orderBy('kode_inv', 'asc')->get();
                break;
            default:
                $ac = AC::orderBy('plant', 'asc')->get();
                break;
        }
        $jumlah = AC::count();
        return view('superadmin.ac.cetak', compact('ac', 'jumlah'));
    }
}
