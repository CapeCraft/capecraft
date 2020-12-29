<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ServerController;
use App\Http\Controllers\StaffController;

Route::get('/server', [ ServerController::class, 'getServer' ]);
Route::get('/staff', [ StaffController::class, 'getStaff' ]);