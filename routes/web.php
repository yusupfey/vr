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
Route::get('show', [App\Http\Controllers\SupplierController::class, 'show_data'])->name('show.supplier');
Route::get('get_supplier', [App\Http\Controllers\SupplierController::class, 'get_supplier_based_on_today'])->name('act.getsupplier');
Route::get('get_supplier/{id}', [App\Http\Controllers\SupplierController::class, 'showdata_id']);
Route::get('add_supplier', [App\Http\Controllers\SupplierController::class, 'create']);
Route::get('supplier/hapus/{id}', [App\Http\Controllers\SupplierController::class, 'remove']);
Route::post('act_supplier', [App\Http\Controllers\SupplierController::class, 'act_supplier'])->name('act.supplier');
Route::post('supplier/update', [App\Http\Controllers\SupplierController::class, 'update']);

// Request
Route::get('/request', [App\Http\Controllers\RequestController::class, 'index']);
Route::get('/request_form', [App\Http\Controllers\RequestController::class, 'request_form']);
Route::get('/request/get_supplier/{id}', [App\Http\Controllers\RequestController::class, 'get_barang_where_supplier']);
Route::post('/req_item', [App\Http\Controllers\RequestController::class, 'act_req_item']);

// Request_check
Route::get('request_check', [App\Http\Controllers\Request_Check::class, 'index']);
Route::get('request_check/detail/{id}', [App\Http\Controllers\Request_Check::class, 'detail']);
Route::get('request_check/show', [App\Http\Controllers\Request_Check::class, 'show_req'])->name('show.req');
Route::get('request_check/pdf/{id}', [App\Http\Controllers\Request_Check::class, 'pdf']);
Route::get('request_approve/{act}/{id}', [App\Http\Controllers\Request_Check::class, 'act_approve']);

Route::post('/terima_barang', [App\Http\Controllers\Request_Check::class, 'terima_barang']);

// users
Route::get('/user', [App\Http\Controllers\TUserController::class, 'index']);
Route::get('/user/data', [App\Http\Controllers\TUserController::class, 'show_user'])->name('show.user');
Route::get('/user/position', [App\Http\Controllers\TUserController::class, 'select']);
Route::get('/user/{nik}', [App\Http\Controllers\TUserController::class, 'get_where']);
Route::get('/user/hapus/{nik}', [App\Http\Controllers\TUserController::class, 'remove']);
Route::post('/user/{act}', [App\Http\Controllers\TUserController::class, 'act']);


Route::get('/account', [App\Http\Controllers\LogUserController::class, 'index']);
Route::get('/account/show', [App\Http\Controllers\LogUserController::class, 'show_user'])->name('show.userAccount');
Route::get('/account/nik', [App\Http\Controllers\LogUserController::class, 'select']);
Route::get('/account/{nik}', [App\Http\Controllers\LogUserController::class, 'get_where']);
Route::get('/account/hapus/{id}', [App\Http\Controllers\LogUserController::class, 'remove']);
Route::post('/account/{act}', [App\Http\Controllers\LogUserController::class, 'act']);


Route::get('/report/pr', [App\Http\Controllers\ReportController::class, 'DataPr']);
Route::get('/report/terimabarang', [App\Http\Controllers\ReportController::class, 'DataTb']);
Route::get('/report/detailTb/{id}', [App\Http\Controllers\ReportController::class, 'detail']);
Route::get('/Report/pdf/{id}', [App\Http\Controllers\ReportController::class, 'pdf']);
