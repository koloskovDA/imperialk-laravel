<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Auction;

class AuctionController extends Controller
{
    public function list()
    {
        return view('admin.auctions.list');
    }

    public function show($auctionId)
    {
        $auction = Auction::find($auctionId)->with('lots')->first();

        return view('admin.auctions.show', ['auction' => $auction]);
    }

}
