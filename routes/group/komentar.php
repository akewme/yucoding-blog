<?php
// Komentar
// get All Komentar
Route::get('/komentars/{id}', "Api\KomentarController@getKomentars");

Route::middleware(['auth'])->group(function () {
    // Get Reply
    Route::get('/reply/{id}', "Api\KomentarController@getKomentar");
    // Tambah Komentar
    Route::post("/tambah-komentar","Api\KomentarController@tambahKomentar");
    // Edit Komentar
    Route::post("/edit-komentar/{id}","Api\KomentarController@editKomentar");
    // Hapus Komentar
    Route::get("/hapus-komentar/{id}","Api\KomentarController@hapusKomentar");
});

?>