<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Carbon\Carbon;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class ReportController extends Controller
{
    public function harian()
    {
        $harian = Report::all();
        return view('superadmin.report.harian', compact('harian'));
    }
    public function filterhari(Request $request)
    {
        $tanggal = $request->tanggal;
        $harian = Report::where('tanggal', 'LIKE', $tanggal . '%')->exists();
        if ($harian) {
            $harian = Report::where('tanggal', 'LIKE', $tanggal . '%')->get();
            $tanggal = Report::where('tanggal', 'LIKE', $tanggal . '%')->first();
            $tanggal = Carbon::parse($tanggal->tanggal)->isoFormat('YYYY-MM-DD');
            // dd($tanggal);
            return view('superadmin.report.filter-hari', compact('harian', 'tanggal'));
        } else {
            Alert::error('Not Found', 'Tidak ditemukan Data pada tanggal tersebut');
            return redirect()->route('report.harian');
        }
    }
    public function bulanan()
    {
        $bulan = date('Y-m');
        $bulanan = Report::where('tanggal', 'LIKE', $bulan . '%')->get();
        return view('superadmin.report.bulanan', compact('bulanan', 'bulan'));
    }
    public function filterbulan(Request $request)
    {
        $cek = Report::where('tanggal', 'LIKE', $request->bulan . '%')->exists();
        if ($cek) {
            $bulanan = Report::where('tanggal', 'LIKE', $request->bulan . '%')->get();
            $bulan = Report::where('tanggal', 'LIKE', $request->bulan . '%')->first();
            $bulan = Carbon::parse($bulan->tanggal)->isoFormat('YYYY-MM');
            return view('superadmin.report.filter-bulan', compact('bulanan', 'bulan'));
        } else {
            Alert::error('Not Found', 'Tidak ditemukan Data pada bulan tersebut');
            return redirect()->route('report.bulanan');
        }
    }
    public function cetak()
    {
        $bulan = date('Y-m');
        $bulanan = Report::where('tanggal', 'LIKE', $bulan . '%')->get();
        return view('superadmin.report.cetak', compact('bulanan', 'bulan'));
    }
    public function filtercetak(Request $request)
    {
        $bulanan = Report::where('tanggal', 'LIKE', $request->bulan . '%')->get();
        $bulan = Report::where('tanggal', 'LIKE', $request->bulan . '%')->first();
        $bulan = Carbon::parse($request->bulan)->isoFormat('YYYY-MM');
        return view('superadmin.report.filter-cetak', compact('bulanan', 'bulan'));
    }
}
