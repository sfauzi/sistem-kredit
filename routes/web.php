<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PengajuanKreditController;

Route::get('/', function () {
    return view('welcome');
});


    Route::get(
        '/pengajuan/create',
        [PengajuanKreditController::class, 'create']
    )
        ->name('pengajuan.create');

    Route::post(
        '/pengajuan',
        [PengajuanKreditController::class, 'store']
    )
        ->name('pengajuan.store');

    Route::post(
        '/pengajuan/{id}/approval',
        [PengajuanKreditController::class, 'approval']
    )
        ->name('pengajuan.approval');
