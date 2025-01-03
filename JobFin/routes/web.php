<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\BakatController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\TeknisController;
use App\Http\Controllers\PenempatanController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MateriController;
use App\Http\Controllers\PengelolaController;

Route::get('/', function () {
    return view('welcome');
});

Route::get("/home", function(){return view("page.home");})->name("page.home");

Route::get('/login', [SessionController::class, 'index'])->name('login');
Route::post('/login', [SessionController::class, 'login'])->name('login.auth');
Route::post('/logout', [SessionController::class, 'logout'])->name('logout');

Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'store'])->name('register.store');

Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');

Route::get("/teknis", function(){return view("page.testTeknis.teknisHome");})->name("page.testTeknis.teknisHome");
Route::get('/teknis/soal', [TeknisController::class, 'index'])->name('page.testTeknis.teknisSoal');
Route::post('/teknis/submit', [TeknisController::class, 'submit'])->name('teknis.submit');
Route::get('/teknis/hasil', [TeknisController::class, 'hasil'])->name('teknis.hasil');
Route::post('/teknis/feedback-teknis', [TeknisController::class, 'submitFeedback'])->name('teknis.feedback.submit');
Route::delete('/teknis/feedback-teknis', [TeknisController::class, 'deleteFeedback'])->name('teknis.feedback.delete');

Route::get("/bakat", function(){return view("page.testMinatBakat.bakatHome");})->name("page.testMinatBakat.bakatHome");
Route::get('/bakat/soal', [BakatController::class, 'showSoal'])->name('bakat.soal');
Route::post('/bakat/submit', [BakatController::class, 'submitJawaban'])->name('submit.bakat');
Route::get('/bakat/hasil', [BakatController::class, 'showHasil'])->name('hasil.bakat');
Route::post('/bakat/feedback', [BakatController::class, 'submitFeedback'])->name('bakat.feedback.submit');
Route::delete('/bakat/feedback', [BakatController::class, 'deleteFeedback'])->name('bakat.feedback.delete');

Route::get('/hasil-penempatan', [PenempatanController::class, 'index'])->name('hasil.penempatan');

Route::get('/home', [MateriController::class, 'getMateri'])->name('page.home');

Route::get('/admin/materi/create', [AdminController::class, 'createMateri'])->name('admin.materi.create');
Route::post('/admin/materi', [AdminController::class, 'storeMateri'])->name('admin.materi.store');
Route::get('/admin/materi/{id}/edit', [AdminController::class, 'editMateri'])->name('admin.materi.edit');
Route::put('/admin/materi/{id}', [AdminController::class, 'updateMateri'])->name('admin.materi.update');
Route::delete('/admin/materi/{id}', [AdminController::class, 'deleteMateri'])->name('admin.materi.delete');

Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
Route::get('/admin/edit/{id}', [AdminController::class, 'edit'])->name('admin.edit');
Route::put('/admin/update/{id}', [AdminController::class, 'update'])->name('admin.update');
Route::delete('/admin/delete/{id}', [AdminController::class, 'delete'])->name('admin.delete');

Route::get('/pengelola/home', [PengelolaController::class, 'index'])->name('pengelola.home');
Route::get('/pengelola/edit/{id}', [PengelolaController::class, 'edit'])->name('pengelola.edit');
Route::put('/pengelola/update/{id}', [PengelolaController::class, 'update'])->name('pengelola.update');
Route::post('/pengelola/store', [PengelolaController::class, 'store'])->name('pengelola.store');
Route::delete('/pengelola/delete/{id}', [PengelolaController::class, 'delete'])->name('pengelola.delete');
