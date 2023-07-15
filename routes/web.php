<?php
use App\Http\Controllers\PengirimanController as PC;

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

Route::middleware(['auth'])->group(function (){
    
    Route::resource('kurir', KurirController::class);
    Route::resource('barang', BarangController::class);
    Route::resource('lokasi', LokasiController::class);
    Route::resource('pengiriman', PengirimanController::class);
    Route::put('pengiriman/approve/{id}', [PC::class, 'approve']);
    Route::get('/', 'HomeController@index')->name('home');
 });

 Auth::routes();
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
