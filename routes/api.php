<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BanController;
use App\Http\Controllers\Admin\ProofController;
use App\Http\Controllers\Admin\PlayerController;
use App\Http\Controllers\Admin\AccountController;
use App\Http\Controllers\Admin\AdminStaffController;
use App\Http\Controllers\Admin\AdminContentController;
use App\Http\Controllers\Admin\AdminAnnouncementController;

use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\ServerController;
use App\Http\Controllers\UnbanController;
use App\Http\Controllers\StaffController;

/**
 * /admin endpoints
 */
Route::group(['prefix' => '/admin', 'middleware' => 'auth:sanctum'], function() {
    Route::get('/init', [ AdminController::class, 'getInit' ]);

    /**
     * /admin/account endpoints
     */
    Route::group(['prefix' => '/account'], function() {
        Route::post('/login', [ AccountController::class, 'doLogin' ])->withoutMiddleware('auth:sanctum');
        Route::get('/user', [ AccountController:: class, 'getUser' ]);
        Route::post('/bio', [ AccountController::class, 'doBioUpdate' ]);
        Route::post('/password', [ AccountController::class, 'doPasswordUpdate' ]);
    });

    Route::get('/bans', [ BanController::class, 'getBans' ]);
    Route::post('/bans/search', [ BanController::class, 'doBanSearch' ]);
    Route::get('/ban/{id}', [ BanController::class, 'getBan' ])->whereNumber('id');
    Route::post('/ban/{id}/delete', [ BanController::class, 'deleteBan' ])->whereNumber('id');

    Route::post('/proof', [ ProofController::class, 'doAddProof' ]);
    Route::post('/proof/{id}/delete', [ ProofController::class, 'doDeleteProof' ]);

    Route::get('/player/{uuid}', [ PlayerController::class, 'getPlayer' ])->where(['uuid' => '[a-fA-F0-9]{32}']);
    Route::get('/player/{uuid}/bans', [ PlayerController::class, 'getPlayerBans' ])->where(['uuid' => '[a-fA-F0-9]{32}']);
    Route::post('/player/{uuid}/unban', [ PlayerController::class, 'doUnban' ])->where(['uuid' => '[a-fA-F0-9]{32}']);

    /**
     * /announcements/account endpoints
     */
    Route::group(['prefix' => '/announcements'], function() {
        Route::get('/', [ AnnouncementController::class, 'getAnnouncements' ]);
        Route::get('/{id}', [ AdminAnnouncementController::class, 'getAnnouncement' ])->where(['id' => '[0-9]']);
        Route::post('/{id}/edit', [ AdminAnnouncementController::class, 'doEditAnnouncement' ])->where(['id' => '[0-9]']);
        Route::post('/{id}/delete', [ AdminAnnouncementController::class, 'doDeleteAnnouncement' ])->where(['id' => '[0-9]']);
        Route::post('/new', [ AdminAnnouncementController::class, 'doNewAnnouncement' ]);
    });

    /**
     * /staff/account endpoints
     */
    Route::group(['prefix' => '/staff'], function() {
        Route::get('/', [ AdminStaffController::class, 'getStaff' ]);
        Route::post('/create', [ AdminStaffController::class, 'doCreateStaff' ]);
        Route::post('/delete', [ AdminStaffController::class, 'doDeleteStaff' ]);
    });

    /**
     * /content/account endpoints
     */
    Route::group(['prefix' => '/content'], function() {
        Route::get('/', [ AdminContentController::class, 'getAllContent' ]);
        Route::get('/{slug}', [ AdminContentController::class, 'getContent' ]);
        Route::post('/{slug}/save', [ AdminContentController::class, 'doSaveContent' ]);
    });
});

Route::get('/announcements', [ AnnouncementController::class, 'getAnnouncements' ]);
Route::get('/content/{slug}', [ AdminContentController::class, 'getContent' ]);
Route::post('/unban', [ UnbanController::class, 'doUnban' ]);
Route::get('/server', [ ServerController::class, 'getServer' ]);
Route::get('/staff', [ StaffController::class, 'getStaff' ]);

if(config('app.debug')) {
    Route::get('/cache', function() {
        cache()->flush();
        return ['success' => true];
    });

    Route::get('/unban/{id}', function($id) {
        $unbanRequest = \App\Models\UnbanRequest::find($id);
        return new App\Mail\UnbanRequestMail($unbanRequest);
    });
}