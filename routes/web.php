<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\isActiveUser;

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

//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/',"GirisController@index")->name('giris-sayfasi')->middleware('isactiveuser');
Route::post('/kayit',"GirisController@kayit")->name("kullanici.kayit");
Route::post('/giris',"GirisController@giris")->name('kullanici.giris');
Route::get('/cikis',"GirisController@cikis")->name("kullanici.cikis");
Route::get('/yapilacaklar',"YapilacaklarController@index")->name('yapilacaklar')->middleware('isnotactiveuser');
Route::get("/yapilacak-sil/{id?}","YapilacaklarController@delete")->name('yapilacaklar.sil')->middleware('isnotactiveuser');
Route::post("/yapilacak-ekle","YapilacaklarController@insert")->name("yapilacaklar.ekle")->middleware('isnotactiveuser');
Route::get("/yapilacak-yap/{id?}","YapilacaklarController@do")->name("yapilacaklar.yap")->middleware('isnotactiveuser');
Route::post("/yapilacak-guncelle/{id?}","YapilacaklarController@update")->name("yapilacaklar.guncelle")->middleware('isnotactiveuser');

