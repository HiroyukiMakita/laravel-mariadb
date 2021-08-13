<?php

namespace App\Http\Controllers\Example;

use App\Example;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReadController extends Controller
{
    public function __invoke()
    {
        $examples = Example::all();
        return view('pages.read')->with('arrays', $examples->toArray());
    }
}
