<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class AuctionController extends Controller
{
    public function list()
    {
        return view('admin.auctions.list');
    }

}
