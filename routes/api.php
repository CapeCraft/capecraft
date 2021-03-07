<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BanController;
use App\Http\Controllers\Admin\ProofController;
use App\Http\Controllers\Admin\PlayerController;
use App\Http\Controllers\Admin\AccountController;

use App\Http\Controllers\ServerController;
use App\Http\Controllers\StaffController;

/**
 * /admin endpoints
 */
Route::group(['prefix' => '/admin', 'middleware' => 'auth:sanctum'], function() {
    Route::get('/init', [ AdminController::class, 'getInit' ]);
    Route::post('/login', [ AccountController::class, 'doLogin' ])->withoutMiddleware('auth:sanctum');

    Route::post('/account/bio', [ AccountController::class, 'doBioUpdate' ]);
    Route::post('/account/password', [ AccountController::class, 'doPasswordUpdate' ]);

    Route::get('/bans', [ BanController::class, 'getBans' ]);
    Route::post('/bans/search', [ BanController::class, 'doBanSearch' ]);
    Route::get('/ban/{id}', [ BanController::class, 'getBan' ])->whereNumber('id');
    Route::post('/ban/{id}/delete', [ BanController::class, 'deleteBan' ])->whereNumber('id');

    Route::post('/proof', [ ProofController::class, 'doAddProof' ]);
    Route::post('/proof/{id}/delete', [ ProofController::class, 'doDeleteProof' ]);

    Route::get('/player/{uuid}', [ PlayerController::class, 'getPlayer' ])->where(['uuid' => '[a-fA-F0-9]{32}']);
    Route::post('/player/{uuid}/unban', [ PlayerController::class, 'doUnban' ])->where(['uuid' => '[a-fA-F0-9]{32}']);

});

Route::get('/server', [ ServerController::class, 'getServer' ]);
Route::get('/staff', [ StaffController::class, 'getStaff' ]);