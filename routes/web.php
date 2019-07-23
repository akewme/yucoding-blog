<?php


Route::get('/', function () {
    return view('frontend.index');
});

Route::get('/blog', function () {
    return view('frontend.blog');
});


Auth::routes();

Route::get('auth/{provider}', 'Auth\AuthController@redirectToProvider');
Route::get('auth/{provider}/callback', 'Auth\AuthController@handleProviderCallback');


Route::middleware(['auth'])->group(function () {

    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/artikel', 'ArtikelController@index')->name('artikel');
    Route::get('/tambah-artikel', 'ArtikelController@tambahArtikel')->name('tambah-artikel');
    Route::post('/artikel', 'ArtikelController@tambah')->name('tambah-artikel');
    Route::post('/artikel/edit', 'ArtikelController@edit')->name('edit-artikel');
    Route::post('/artikel/delete', 'ArtikelController@delete')->name('delete-artikel');
    Route::get('/artikel/semua/datatables', 'ArtikelController@datatables')->name('semua-data-artikel');


});
include "group/komentar.php";

Route::get("/{slug}","ArtikelController@singleArtikel");
