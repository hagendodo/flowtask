<?php

use App\Http\Controllers\MemberController;
use App\Http\Controllers\ProfileController;
use App\Models\Member;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $datas = DB::table('members')
        ->select([
            'nim',
            'nowa',
            'nama',
            'harapan',
            'bidang',
            DB::raw("CONVERT_TZ(created_at, 'UTC', 'Asia/Jakarta') AS waktu_pendaftaran"),
        ])
        ->orderBy('waktu_pendaftaran', 'desc')
        ->paginate(10);

    $total = Member::count();
    return view('member.index', compact(['datas', 'total']));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/total-member', function () {
    $total = Member::count();
    return response()->json([
        'data' => [
            'total' => $total,
        ],
    ]);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/get-data', function(){
        return DB::table('members')
            ->select([
                'nim',
                'nowa',
                'nama',
                'harapan',
                'bidang',
                DB::raw("CONVERT_TZ(created_at, 'UTC', 'Asia/Jakarta') AS waktu_pendaftaran"),
            ])
            ->orderBy('waktu_pendaftaran')
            ->get();
    });

    Route::get('/cek-member/{nim}', function ($nim) {
        $memberExists = Member::where('nim', $nim)->exists();

        return response()->json(['exists' => $memberExists]);
    });
});

Route::middleware('cors')->resource('/member', MemberController::class);

require __DIR__.'/auth.php';
