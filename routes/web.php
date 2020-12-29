<?php

use Illuminate\Support\Facades\Route;

Route::get('/discord', function() {
    return redirect('https://discord.gg/62MCajz');
});

Route::get('/donate', function() {
    return redirect('https://capecraft.buycraft.net');
});

Route::get('/{any}', function () {
    return view('base');
})->where('any', '.*');
