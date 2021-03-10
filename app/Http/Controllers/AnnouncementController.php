<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Announcement;

class AnnouncementController extends Controller {

    /**
     * Get announcements
     *
     * @return void
     */
    public function getAnnouncements(Request $request) {
        $page = $request->input('page');
        $cache = cache()->tags(['announcement'])->remember("announcement_$page", 604800, function() {
            return Announcement::orderBy('id', 'DESC')->paginate(10);
        });
        return response()->json($cache);
    }

}
