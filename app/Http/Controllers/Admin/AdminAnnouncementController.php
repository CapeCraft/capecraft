<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Announcement;
use App\Http\Controllers\Controller;

class AdminAnnouncementController extends Controller {

    /**
     * Get an announcement by id
     *
     * @param  mixed $request
     * @param  mixed $id
     * @return void
     */
    public function getAnnouncement(Request $request, $id) {
        return Announcement::find($id);
    }

    /**
     * Edit the announcement by id
     *
     * @param  mixed $request
     * @param  mixed $id
     * @return void
     */
    public function doEditAnnouncement(Request $request, $id) {
        $request->validate([
            'title' => 'required|min:10|max:150',
            'severity' => 'required|in:1,2,3',
            'content' => 'required',
        ]);

        $announcement = Announcement::find($id);
        $announcement->title = $request->title;
        $announcement->severity = $request->severity;
        $announcement->content = $request->content;
        $announcement->save();

        cache()->tags(['announcement'])->flush();
        return response()->json(['success' => true]);
    }

    /**
     * Delete an announcement by id
     *
     * @param  mixed $request
     * @param  mixed $id
     * @return void
     */
    public function doDeleteAnnouncement(Request $request, $id) {
        Announcement::find($id)->delete();
        cache()->tags(['announcement'])->flush();
        return response()->json(['success' => true]);
    }

    /**
     * Create the new announcement
     *
     * @param  mixed $request
     * @return void
     */
    public function doNewAnnouncement(Request $request) {
        $request->validate([
            'title' => 'required|min:10|max:150',
            'severity' => 'required|in:1,2,3',
            'content' => 'required',
        ]);

        $announcement = new Announcement;
        $announcement->title = $request->title;
        $announcement->severity = $request->severity;
        $announcement->content = $request->content;
        $announcement->save();

        cache()->tags(['announcement'])->flush();
        return response()->json(['success' => true]);
    }

}
