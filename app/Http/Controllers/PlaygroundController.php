<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class PlayGroundController extends Controller
{
    public function index(): View
    {

        return view('playground.index', [

        ]);

    }

}
