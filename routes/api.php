<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BanController;
use App\Http\Controllers\Admin\AccountController;

use App\Http\Controllers\ServerController;
use App\Http\Controllers\StaffController;

/**
 * /admin endpoints
 */
Route::group(['prefix' => '/admin', 'middleware' => 'auth:sanctum'], function() {
    Route::get('/init', [ AdminController::class, 'getInit']);
    Route::post('/login', [AccountController::class, 'doLogin'])->withoutMiddleware('auth:sanctum');

    Route::get('/bans', [ BanController::class, 'getBans']);
    Route::post('/ban/proof', [ BanController::class, 'doAddProof']);
    Route::get('/ban/{id}', [ BanController::class, 'getBan'])->whereNumber('id');
    Route::get('/player/{uuid}', [ BanController::class, 'getPlayer'])->where(['uuid' => '[a-fA-F0-9]{32}']);
    Route::post('/player/{uuid}/unban', [ BanController::class, 'doUnban'])->where(['uuid' => '[a-fA-F0-9]{32}']);
});

Route::get('/server', [ ServerController::class, 'getServer' ]);
Route::get('/staff', [ StaffController::class, 'getStaff' ]);