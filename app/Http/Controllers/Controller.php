<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController {
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Outputs with json errors
     *
     * @param  mixed $errors
     * @return void
     */
    public function withJsonErrors($errors) {
        if(is_array($errors)) {
            return response()->json(['success' => false, 'errors' => $errors ], 400);
        } else {
            return response()->json(['success' => false, 'errors' => [[ $errors ]]], 400);
        }
    }
}
