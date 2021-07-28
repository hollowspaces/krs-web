<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KrsController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\MataKuliahController;

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

// auth
Route::group(['middleware' => 'guest'], function() {
    Route::get('/login', [AuthController::class, 'getLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'doLogin']);
});
Route::get('/logout', [AuthController::class, 'doLogout'])->middleware('auth');

Route::group(['middleware' => 'auth'], function() {
    // pages
    Route::get('/', [PagesController::class, 'getIndex']);
    
    Route::group(['middleware' => 'role:admin'], function() {
        // mahasiswa
        Route::group(['prefix' => 'mahasiswa'], function() {
            Route::any('/json', [MahasiswaController::class, 'json'])->name('mahasiswa.json');
        });
        Route::resource('mahasiswa', MahasiswaController::class);
    });
    
    Route::group(['middleware' => 'role:admin'], function() {
        // kelas
        Route::group(['prefix' => 'kelas'], function() {
            Route::any('/json', [KelasController::class, 'json'])->name('kelas.json');
        });
        Route::resource('kelas', KelasController::class);
    });
    
    // mata kuliah
    Route::group(['prefix' => 'mata-kuliah'], function() {
        Route::any('/json', [MataKuliahController::class, 'json'])->name('mata-kuliah.json');
        Route::post('/kontrak', [MataKuliahController::class, 'kontrak']);
        Route::delete('/remove-kontrak', [MataKuliahController::class, 'removeKontrak']);
    });
    Route::resource('mata-kuliah', MataKuliahController::class);
    
    // krs
    Route::group(['prefix' => 'krs'], function() {
        Route::any('/json', [KrsController::class, 'json'])->name('krs.json');
    });
    Route::resource('krs', KrsController::class)->only('index', 'show', 'destroy');
});

