<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexController1 extends Controller
{

    public function loadView($view)
    {
        return view('Admin/'.$view);
    }
}
