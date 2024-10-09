<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
class ProfileDataController extends Controller
{

    public function show(Request $request): View
    {
        return view('profiel', [
            'user' => $request->user(),
        ]);
    }
}
