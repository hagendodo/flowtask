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
    return redirect()->route('dashboard');
});

Route::get('/dashboard', function () {
    $datas = DB::table('last_members')
        ->select([
            'nim',
            'nowa',
            'nama',
            'harapan',
            'bidang',
            'created_at',
        ])
        ->get();

    $total = DB::table('total_members')->where('id', 1)->value('total');
    return view('index', compact(['datas', 'total']));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/show-total', function () {
    $total = DB::table('total_members')->where('id', 1)->value('total');
    return view('total', compact(['total']));
})->middleware(['auth', 'verified'])->name('show_total');

Route::get('/all-members', function () {
    $datas = DB::table('members')
        ->select([
            'nim',
            'nowa',
            'nama',
            'harapan',
            'bidang',
            'created_at',
        ])
        ->orderBy('created_at', 'desc')
        ->paginate(10);

    $total = DB::table('total_members')->where('id', 1)->value('total');
    return view('member.index', compact(['datas', 'total']));
})->middleware(['auth', 'verified'])->name('all_members');

Route::get('/total-member', function () {
    $total = DB::table('total_members')->where('id', 1)->value('total');
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

    Route::get('/cek-member/{nim}', function ($nim) {
        $memberExists = Member::where('nim', $nim)->exists();

        return response()->json(['exists' => $memberExists]);
    });
});

Route::middleware('cors')->resource('/member', MemberController::class);

require __DIR__.'/auth.php';
