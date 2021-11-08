<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\JenjangController;
use App\Http\Controllers\SekolahController;
use App\Http\Controllers\KecamatanController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [WebController::class, 'index']);

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

// kecamatan
Route::get('/kecamatan', [KecamatanController::class, 'index'])->name('kecamatan');
Route::get('/kecamatan/add', [KecamatanController::class, 'add']);
Route::post('/kecamatan/insert', [KecamatanController::class, 'insert']);
Route::get('/kecamatan/edit/{kecamatan}', [KecamatanController::class, 'edit']);
Route::post('/kecamatan/update/{kecamatan}', [KecamatanController::class, 'update']);
Route::post('/kecamatan/delete/{kecamatan}', [KecamatanController::class, 'delete']);

// jenjang
Route::get('/jenjang', [JenjangController::class, 'index'])->name('jenjang');
Route::get('/jenjang/add', [JenjangController::class, 'add']);
Route::post('/jenjang/insert', [JenjangController::class, 'insert']);
Route::get('/jenjang/edit/{slug}', [JenjangController::class, 'edit']);
Route::post('/jenjang/update/{slug}', [JenjangController::class, 'update']);
Route::post('/jenjang/delete/{slug}', [JenjangController::class, 'delete']);

// sekolah
Route::get('/sekolah', [SekolahController::class, 'index'])->name('sekolah');
Route::get('/sekolah/add', [SekolahController::class, 'add']);
Route::post('/sekolah/insert', [SekolahController::class, 'insert']);
Route::get('/sekolah/edit/{slug}', [SekolahController::class, 'edit']);
Route::post('/sekolah/update/{slug}', [SekolahController::class, 'update']);
Route::post('/sekolah/delete/{slug}', [SekolahController::class, 'delete']);

// user
Route::get('/user', [UserController::class, 'index'])->name('user');
Route::get('/user/add', [UserController::class, 'add']);
Route::post('/user/insert', [UserController::class, 'insert']);
Route::get('/user/edit/{username}', [UserController::class, 'edit']);
Route::post('/user/update/{username}', [UserController::class, 'update']);
Route::post('/user/delete/{username}', [UserController::class, 'delete']);

// frontend
Route::get('/kecamatan/{slug}', [WebController::class, 'kecamatan']);
Route::get('/jenjang/{slug}', [WebController::class, 'jenjang']);
Route::get('/detailsekolah/{slug}', [WebController::class, 'sekolah']);
