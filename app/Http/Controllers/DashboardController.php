<?php

namespace App\Http\Controllers;

use App\Models\AC;
use App\Models\Perbaikan;
use App\Models\Report;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        $jumlah = AC::all()->count();
        $normal = AC::where('status', 'normal')->count();
        $pengajuan = Perbaikan::where('status', 'pengajuan')->count();
        $perbaikan = Perbaikan::where('status', 'proses')->count();
        $report = Report::whereRaw("DATE_FORMAT(tanggal, '%Y-%m-%d') = ?", [date('Y-m-d')])->get();
        return view('dashboard', compact('jumlah', 'normal', 'pengajuan', 'perbaikan', 'report'));
    }
}
