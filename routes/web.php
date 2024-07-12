<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\EmailVerificationController;

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

Auth::routes(['verify' => true]);

Route::get('/email/verify', [EmailVerificationController::class, 'show'])->name('verification.notice');
Route::get('/email/verify/{id}/{hash}', [EmailVerificationController::class, 'verify'])->name('verification.verify')->middleware(['signed', 'throttle:6,1']);
Route::post('/email/resend', [EmailVerificationController::class, 'resend'])->name('verification.resend');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::view('about', 'about')->name('about');

    Route::get('users', [UserController::class, 'index'])->name('users.index');

    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

use App\Http\Controllers\KriteriaController;

Route::get('/kriteria', [KriteriaController::class, 'index'])->name('kriteria.index')->middleware('verified');
Route::post('/kriteria', [KriteriaController::class, 'store'])->name('kriteria.store')->middleware('verified');
Route::put('/kriteria/{kriteria}', [KriteriaController::class, 'update'])->name('kriteria.update')->middleware('verified');
Route::delete('/kriteria/{kriteria}', [KriteriaController::class, 'destroy'])->name('kriteria.destroy')->middleware('verified');

use App\Http\Controllers\AlternatifController;

Route::get('/alternatifs', [AlternatifController::class, 'index'])->name('alternatif.index')->middleware('verified');
Route::post('/alternatifs', [AlternatifController::class, 'store'])->name('alternatifs.store')->middleware('verified');
Route::put('/alternatifs/{alternatif}', [AlternatifController::class, 'update'])->name('alternatifs.update')->middleware('verified');
Route::delete('/alternatifs/{alternatif}', [AlternatifController::class, 'destroy'])->name('alternatifs.destroy')->middleware('verified');

use App\Http\Controllers\PenilaianController;

Route::get('/penilaian', [PenilaianController::class, 'index'])->name('penilaian.index')->middleware('verified');
Route::post('/penilaian', [PenilaianController::class, 'store'])->name('penilaian.store')->middleware('verified');
Route::put('/penilaian/{id}', [PenilaianController::class, 'update'])->name('penilaian.update')->middleware('verified');

Route::get('/pertihungan/saw', [PenilaianController::class, 'saw'])->name('perhitungan.saw')->middleware('verified');
