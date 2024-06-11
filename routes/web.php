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
Route::get('/', [\App\Http\Controllers\HomeController::class, 'home'])->name('homepage.home');

//pendaftaran (sign up)
Route::resource('/sign-up', \App\Http\Controllers\PendaftaranController::class);

Auth::routes([
	'register' => false
]);

Route::group(['prefix' => 'dashboard','middleware' => ['web', 'auth']],function(){

	//dashboard
	Route::get('/', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard.index');

	//data-permohonan
	Route::get('/data-permohonan/select', [\App\Http\Controllers\PermohonanController::class, 'select'])->name('data-permohonan.select');
	Route::resource('/data-permohonan', \App\Http\Controllers\PermohonanController::class);

	//roles
	Route::get('/roles/select', [\App\Http\Controllers\RoleController::class, 'select'])->name('roles.select');
	Route::resource('/roles', \App\Http\Controllers\RoleController::class);

	//users
	Route::get('/users/change-password', [\App\Http\Controllers\UserController::class, 'change_password'])->name('users.change_password');
    Route::post('/users/update-password', [\App\Http\Controllers\UserController::class, 'update_password'])->name('users.update_password');
    Route::get('/users/edit-profil/{user}', [\App\Http\Controllers\UserController::class, 'edit_profil'])->name('users.edit_profil');
    Route::put('/users/update-profil/{user}', [\App\Http\Controllers\UserController::class, 'update_profil'])->name('users.update_profil');
	Route::resource('/users', \App\Http\Controllers\UserController::class);

	//provinsi
    Route::get('/provinsi-pemohon', [\App\Http\Controllers\ProvinsiController::class, 'select_pemohon'])->name('provinsi.select_pemohon');
    Route::get('/provinsi-perusahaan', [\App\Http\Controllers\ProvinsiController::class, 'select_perusahaan'])->name('provinsi.select_perusahaan');

	//pengajuan-permohonan
	Route::resource('/pengajuan-permohonan', \App\Http\Controllers\PengajuanPermohonanController::class);

	//data-pemohon
	Route::put('/data-pemohon/disetujui/{data_pemohon}', [\App\Http\Controllers\PemohonController::class, 'disetujui'])->name('data-pemohon.disetujui');
	Route::put('/data-pemohon/tidak_disetujui/{data_pemohon}', [\App\Http\Controllers\PemohonController::class, 'tidak_disetujui'])->name('data-pemohon.tidak_disetujui');
	Route::resource('/data-pemohon', \App\Http\Controllers\PemohonController::class);
});