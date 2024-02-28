<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class AuctionController extends Controller
{
    public function index()
    {
        $news = News::all();
        return view('auctions.index');
    }
}
