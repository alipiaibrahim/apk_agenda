<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AgendaController;
use App\Http\Controllers\TemaController;
use App\Models\Guru;
use App\Models\User;
use App\Models\Agenda;
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

$user = Auth::user();
// Mengambil hanya data id user saja
$user = Auth::id();
if (Auth::check()) {
    // Pengguna telah berhasil masuk
}
Route::get('/', function () {
    return view('auth.login');
});
// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('admin/home', [AdminController::class, 'index'])
    ->name('admin.home')
    ->middleware('is_admin');
// Route::get('admin/guru', [App\Http\Controllers\GuruController::class, 'index'])
//     ->name('admin.guru');
// // ->middleware('is_admin');

// //route tambah 
// Route::post('admin/guru', [GuruController::class, 'tambah_guru'])
//     ->name('admin.guru.submit');
// // ->middleware('is_admin');

// //route edit
// Route::patch('admin/guru', [GuruController::class, 'update_guru'])
//     ->name('admin.guru.update');
// // ->middleware('is_admin');
// Route::get('admin/ajaxadmin/dataGuru/{id}', [GuruController::class, 'getDataGuru']);

// //route delete
// Route::delete('/admin/guru', [GuruController::class, 'delete_guru'])
//     ->name('admin.guru.delete');
//     // ->middleware('is_admin');


Route::get('admin/user', [App\Http\Controllers\UserController::class, 'index'])
    ->name('admin.pengguna');
// ->middleware('is_admin');

//route tambah 
Route::post('admin/user', [UserController::class, 'submit_user'])
    ->name('admin.pengguna.submit');
// ->middleware('is_admin');

//route edit
Route::patch('admin/user', [UserController::class, 'update'])
    ->name('admin.pengguna.update');
// ->middleware('is_admin');
Route::get('admin/ajaxadmin/dataUser/{id}', [UserController::class, 'getDataUser']);

//route delete
Route::delete('/admin/user', [UserController::class, 'delete_user'])
    ->name('admin.pengguna.delete');
// ->middleware('is_admin');


Route::get('admin/agenda', [App\Http\Controllers\AgendaController::class, 'index'])
    ->name('admin.agenda');
// ->middleware('is_admin');

//route tambah 
Route::post('admin/agenda', [AgendaController::class, 'tambah_agenda'])
    ->name('admin.agenda.submit');
// ->middleware('is_admin');

//route edit
Route::patch('admin/agenda', [AgendaController::class, 'update_agenda'])
    ->name('admin.agenda.update');
// ->middleware('is_admin');
Route::get('admin/ajaxadmin/dataAgenda/{id}', [AgendaController::class, 'getDataAgenda']);

//route delete
Route::delete('/admin/agenda', [AgendaController::class, 'delete_agenda'])
    ->name('admin.agenda.delete');
// ->middleware('is_admin');


Route::get('admin/tema', [App\Http\Controllers\TemaController::class, 'index'])
    ->name('admin.tema');
// ->middleware('is_admin');

//route tambah 
Route::post('admin/tema', [TemaController::class, 'tambah_tema'])
    ->name('admin.tema.submit');
// ->middleware('is_admin');

//route edit
Route::patch('admin/tema', [TemaController::class, 'update_tema'])
    ->name('admin.tema.update');
// ->middleware('is_admin');
Route::get('admin/ajaxadmin/dataTema/{id}', [temaController::class, 'getDataTema']);

//route delete
Route::delete('/admin/tema', [TemaController::class, 'delete_tema'])
    ->name('admin.tema.delete');
    // ->middleware('is_admin');