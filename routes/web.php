<?php

use App\Http\Controllers\KaryawanController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

// Route::get('/home', 
// [App\Http\Controllers\HomeController::class, 'index'])
// ->name('home');

Route::get('/home', 
[KaryawanController::class, 'index'])
->name('home');

// URL : karyawan/create -> GET
Route::get('/karyawan/create', 
[KaryawanController::class, 'create'])
->name('karyawan.create');
 
// URL : karyawan/store -> POST
Route::post('/karyawan/store', 
[KaryawanController::class, 'store'])
->name('karyawan.store');

// URL : kayrawan/{id}/edit -> GET
Route::get('/karyawan/{id}/edit', 
[KaryawanController::class, 'edit'])
->name('karyawan.edit');

// URL : karyawan/{id}/update -> PUT
Route::put('/karyawan/{id}/update', 
[KaryawanController::class, 'update'])
->name('karyawan.update');

// URL : karyawan/{id}/delete -> DELETE
Route::delete('/karyawan/{id}/delete', 
[KaryawanController::class, 'destroy'])
->name('karyawan.delete');


// URL : karyawan/download/excel -> GET
Route::get('/karyawan/download/excel', [KaryawanController::class, 'downloadExcel'])
->name('karyawan.download.excel');

// URL : karyawan/download/pdf -> GET
Route::get('/karyawan/download/pdf', [KaryawanController::class, 'downloadPdf'])
->name('karyawan.download.pdf');