<?php

use App\Http\Controllers\ACDataContoller;
use App\Http\Controllers\CleaningController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PerbaikanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\RuangController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\VendorController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use League\CommonMark\Extension\CommonMark\Node\Inline\Strong;
use RealRashid\SweetAlert\Facades\Alert;

Route::middleware('auth')->group(function () {
    // Route Superadmin
    Route::group(
        [
            'middleware' => function ($request, $next) {
                // Cek Role
                if (Auth::check() && Auth::user()->role == 'Operator') {
                    Alert::error('Akses Di Tolak !!!', 'Anda Tidak memiliki Akses Ke Halaman tersebut');
                    return redirect()->back();
                }
                return $next($request);
            }
        ],
        function () {
            // Daftar Route
            Route::resource('/data/ruangan', RuangController::class)->except('show', 'index');
            Route::resource('/data/users', UsersController::class)->except('show');
            Route::resource('/data/vendor', VendorController::class)->except('show', 'index');
            Route::post('/ac/perbaikan/pengajuan/{id}/acc', [PerbaikanController::class, 'acc'])->name('pengajuan.acc');
            Route::get('/report/harian', [ReportController::class, 'harian'])->name('report.harian');
            Route::post('/report/harian/filter=by-day', [ReportController::class, 'filterhari'])->name('filter.hari');
            Route::get('/report/bulanan', [ReportController::class, 'bulanan'])->name('report.bulanan');
            Route::post('/report/bulanan/filter=by-month', [ReportController::class, 'filterbulan'])->name('filter.bulan');
            Route::get('/report/bulanan/cetak', [ReportController::class, 'cetak'])->name('report.cetak');
            Route::post('/report/bulanan/cetak/filtering-date', [ReportController::class, 'filtercetak'])->name('filter.cetak');
        }
    );


    Route::get('/', [DashboardController::class, 'index'])->name('/');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('/profile', ProfileController::class)->except('destroy');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/change-avatar', [ProfileController::class, 'avatar'])->name('change.avatar');
    Route::resource('/master/ac', ACDataContoller::class);
    Route::resource('/ac/perbaikan/pengajuan', PerbaikanController::class)->except('show');
    Route::get('/ac/perbaikan/proses', [PerbaikanController::class, 'proses'])->name('proses.index');
    Route::get('/ac/perbaikan/proses/{id}', [PerbaikanController::class, 'show'])->name('proses.show');
    Route::post('/ac/perbaikan/proses/{id}/selesai', [PerbaikanController::class, 'success'])->name('perbaikan.selesai');
    Route::get('/ac/perbaikan/selesai', [PerbaikanController::class, 'selesai'])->name('selesai.index');
    Route::get('/ac/perbaikan/selesai/{id}', [PerbaikanController::class, 'detailselesai'])->name('selesai.detail');
    Route::post('/ac/perbaikan/selesai/{id}/uploadfoto/', [PerbaikanController::class, 'uploadfoto'])->name('proses.foto');
    Route::get('/ac/cleaning/{id}/detail', [CleaningController::class, 'detail'])->name('cleaning.detail');
    Route::resource('/ac/cleaning', CleaningController::class);
    Route::post('/ac/cleaning/{id}/detail/uploadfoto/', [CleaningController::class, 'uploadfoto'])->name('cleaning.foto');
    Route::post('/ac/cleaning/{id}/detail/selesai', [CleaningController::class, 'success'])->name('cleaning.selesai');
    Route::get('/master/ac/cetak', [ACDataContoller::class, 'cetak'])->name('ac.cetak');
    Route::get('/master/vendor', [VendorController::class, 'index'])->name('vendor.index');
    Route::get('/master/ruangan', [RuangController::class, 'index'])->name('ruangan.index');
    Route::get('/about', function () {
        return view('about');
    })->name('about');
});
// Reset Password Superadmin
Route::get('/login-repair', function () {
    $users = User::get();
    foreach ($users as $user) {
        $user->update([
            'password' => Hash::make($user->show_pw),
        ]);
    }
    Alert::success('Berhasil', 'Sistem Login telah di perbaiki');
    return redirect()->route('login');
});

use Carbon\Carbon;

Route::get('/get-time', function () {
    return response()->json([
        'time' => Carbon::now()->isoFormat('dddd, DD MMMM YYYY HH:mm:ss')
    ]);
});

require __DIR__ . '/auth.php';
