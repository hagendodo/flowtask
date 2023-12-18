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
    $datas = DB::table('members as t1')
        ->select([
            'nim',
            'nowa',
            'nama',
            'harapan',
            'bidang',
            DB::raw("CONVERT_TZ(created_at, 'UTC', 'Asia/Jakarta') AS waktu_pendaftaran"),
        ])
        ->where('created_at', function ($query) {
            $query->select(DB::raw('MIN(created_at)'))
                ->from('members as t2')
                ->whereColumn('t1.nim', 't2.nim')
                ->whereRaw('LENGTH(t1.nim) > 8 AND LENGTH(t1.nowa) > 8');
        })
        ->orderBy('waktu_pendaftaran', 'desc')
        ->paginate(10);

    $total = Member::where(DB::raw('LENGTH(nim)'), '>', 8)->distinct()->count('nim');
    return view('member.index', compact(['datas', 'total']));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/total-member', function () {
    $total = Member::where(DB::raw('LENGTH(nim)'), '>', 8)->distinct()->count('nim');
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
        return DB::table('members as t1')
            ->select([
                DB::raw('ROW_NUMBER() OVER (ORDER BY created_at) AS row_num'),
                'nim',
                'nowa',
                'nama',
                'harapan',
                'bidang',
                DB::raw("CONVERT_TZ(created_at, 'UTC', 'Asia/Jakarta') AS waktu_pendaftaran"),
            ])
            ->where('created_at', function ($query) {
                $query->select(DB::raw('MIN(created_at)'))
                    ->from('members as t2')
                    ->whereColumn('t1.nim', 't2.nim')
                    ->whereRaw('LENGTH(t1.nim) > 8 AND LENGTH(t1.nowa) > 8');
            })
            ->get();
    });
});

Route::middleware('cors')->resource('/member', MemberController::class);

require __DIR__.'/auth.php';
