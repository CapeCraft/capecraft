<?php

use Illuminate\Support\Facades\Route;

Route::get('/discord', function() {
    return redirect('https://discord.gg/62MCajz');
});

Route::get('/donate', function() {
    return redirect('https://capecraft.buycraft.net');
});

Route::get('/vote1', function() {
    return redirect('https://www.planetminecraft.com/server/capecraft-minecraft-survival-at-its-best/vote', 301);
});

Route::get('/vote2', function() {
    return redirect('http://minecraft-mp.com/server/189099/vote/', 301);
});

Route::get('/vote3', function() {
    return redirect('http://minecraftservers.org/vote/488669', 301);
});

Route::get('/{any}', function () {
    return view('base');
})->where('any', '.*');
