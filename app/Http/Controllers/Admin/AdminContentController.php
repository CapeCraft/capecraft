<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Content;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminContentController extends Controller {

    /**
     * Get all content
     *
     * @param  mixed $request
     * @return void
     */
    public function getAllContent() {
        $content = Content::select('slug', 'name')->get();

        //Success
        return response()->json([ 'success' => true, 'content' => $content ], 200);
    }

    /**
     * Get a specific content
     *
     * @param  mixed $request
     * @param  mixed $slug
     * @return void
     */
    public function getContent(Request $request, $slug) {
        $content = Content::where('slug', $slug)->first();
        if($content !=  null) {
            return response()->json([ 'success' => true, 'content' => $content ], 200);
        } else {
            return response()->json([ 'success' => false ], 400);
        }
    }

    /**
     * Save some content
     *
     * @param  mixed $request
     * @param  mixed $slug
     * @return void
     */
    public function doSaveContent(Request $request, $slug) {
        $content = Content::where('slug', $slug)->first();
        $content->content = $request->content;
        $content->save();
        return response()->json([ 'success' => true ], 200);
    }
}