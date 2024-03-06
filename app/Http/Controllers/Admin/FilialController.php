<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FilialController extends Controller
{
    public function list()
    {
        return view('admin.filials.list');
    }
}
