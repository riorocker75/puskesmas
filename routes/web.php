<?php

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

// controller admin route
use App\Http\Controllers\AdminCtrl;
use App\Http\Controllers\PasienCtrl;
use App\Http\Controllers\KapusCtrl;
use App\Http\Controllers\LoginCtrl;






Route::get('/', [AdminCtrl::class,'index']);

// Login
Route::get('/login', [LoginCtrl::class,'index']);
Route::post('/login/cek', [LoginCtrl::class,'cek_login']);

Route::get('/logout', [LoginCtrl::class,'logout']);





// daftar pasien
Route::get('/daftar/pasien', [AdminCtrl::class,'pasien']);
Route::post('/daftar/pasien/act', [AdminCtrl::class,'pasien_act']);

Route::get('/dashboard/pasien/data', [AdminCtrl::class,'pasien_data']);
Route::get('/dashboard/pasien/edit', [AdminCtrl::class,'pasien_edit']);
Route::post('/dashboard/pasien/update', [AdminCtrl::class,'pasien_update']);
Route::get('/dashboard/pasien/delete', [AdminCtrl::class,'pasien_delete']);


// data pegawai
Route::get('/dashboard/pegawai/data', [AdminCtrl::class,'pegawai']);
Route::get('/dashboard/pegawai/add', [AdminCtrl::class,'pegawai_add']);
Route::post('/dashboard/pegawai/act', [AdminCtrl::class,'pegawai_act']);

Route::get('/dashboard/pegawai/edit', [AdminCtrl::class,'pegawai_edit']);
Route::post('/dashboard/pegawai/update', [AdminCtrl::class,'pegawai_update']);
Route::get('/dashboard/pegawai/delete', [AdminCtrl::class,'pegawai_delete']);


// Data poli
Route::get('/dashboard/poli/data', [AdminCtrl::class,'poli']);
Route::post('/dashboard/poli/act', [AdminCtrl::class,'poli_act']);
Route::get('/dashboard/poli/edit/{id}', [AdminCtrl::class,'poli_edit']);
Route::post('/dashboard/poli/update', [AdminCtrl::class,'poli_update']);
Route::get('/dashboard/poli/delete/{id}', [AdminCtrl::class,'poli_delete']);


// data rekam medis
Route::get('/dashboard/rekam/data', [AdminCtrl::class,'rekam']);
Route::get('/dashboard/rekam/add', [AdminCtrl::class,'rekam_add']);
Route::post('/dashboard/rekam/act', [AdminCtrl::class,'rekam_act']);
Route::get('/dashboard/rekam/edit/{id}', [AdminCtrl::class,'rekam_edit']);
Route::post('/dashboard/rekam/update', [AdminCtrl::class,'rekam_update']);
Route::get('/dashboard/rekam/delete/{id}', [AdminCtrl::class,'rekam_delete']);

// cetak rekam kwitansi
Route::get('/dashboard/rekam/kwitansi/{id}', [AdminCtrl::class,'cetak_kwitansi']);

// cetak surat rujuk
Route::get('/dashboard/rekam/surat/{id}', [AdminCtrl::class,'cetak_rujukan']);


// cek rujukan ajax
Route::post('/ajax/cek_rujuk', [AdminCtrl::class,'cek_rujuk']);


// bagian kapus
// cetak pasien
Route::get('/dashboard/kapus', [KapusCtrl::class,'index']);
Route::get('/kapus/pasien', [KapusCtrl::class,'pasien']);
Route::post('/kapus/pasien/cetak', [KapusCtrl::class,'pasien_cetak']);

// pegwai
Route::get('/kapus/pegawai', [KapusCtrl::class,'pegawai']);


// poli
Route::get('/kapus/poli', [KapusCtrl::class,'poli']);

// rujukan
Route::get('/kapus/rujukan', [KapusCtrl::class,'rujukan']);

