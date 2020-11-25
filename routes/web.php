<?php

Route::get('/', function () {
    return view('Login/index');
});
Route::get('/Dashboard', [App\Http\Controllers\Dashboard::class, 'index']);


Route::post('login', [App\Http\Controllers\AuthController::class, 'index'])->name('login.check_login');

Route::get('pdf', [App\Http\Controllers\BarangController::class, 'pdf']);

// barang
Route::get('barang', [App\Http\Controllers\BarangController::class, 'index']);
Route::get('barang/show', [App\Http\Controllers\BarangController::class, 'show_barang'])->name('show.barang');
Route::get('barang/{id}', [App\Http\Controllers\BarangController::class, 'get_barang']);
Route::get('add_barang', [App\Http\Controllers\BarangController::class, 'linkadd_barang']);
Route::get('barang/hapus/{id}', [App\Http\Controllers\BarangController::class, 'remove']);
Route::get('show_barang', [App\Http\Controllers\BarangController::class, 'get_barang_based_on_today'])->name('act.barang');
Route::post('barang/edit', [App\Http\Controllers\BarangController::class, 'edit']);
Route::post('act_barang', [App\Http\Controllers\BarangController::class, 'actbarang'])->name('act.actbarang');


// supplier
Route::get('supplier', [App\Http\Controllers\SupplierController::class, 'index']);
Route::get('get_supplier', [App\Http\Controllers\SupplierController::class, 'get_supplier_based_on_today'])->name('act.getsupplier');
Route::get('add_supplier', [App\Http\Controllers\SupplierController::class, 'create']);
Route::post('act_supplier', [App\Http\Controllers\SupplierController::class, 'act_supplier'])->name('act.supplier');

// Request
Route::get('/request', [App\Http\Controllers\RequestController::class, 'index']);
Route::get('/request_form', [App\Http\Controllers\RequestController::class, 'request_form']);
Route::post('/req_item', [App\Http\Controllers\RequestController::class, 'act_req_item']);

// Request_check
Route::get('request_check', [App\Http\Controllers\Request_Check::class, 'index']);
Route::get('request_check/detail/{id}', [App\Http\Controllers\Request_Check::class, 'detail']);
Route::get('request_check/show', [App\Http\Controllers\Request_Check::class, 'show_req'])->name('show.req');
Route::get('request_check/pdf/{id}', [App\Http\Controllers\Request_Check::class, 'pdf']);
Route::get('request_approve/{act}/{id}', [App\Http\Controllers\Request_Check::class, 'act_approve']);

// users
Route::get('/user', [App\Http\Controllers\TUserController::class, 'index']);
