<?php

namespace App\Http\Controllers;

use App\Models\Auction;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function welcome()
    {
        $newestAuctions = Auction::with('product')
            ->latest()
            ->take(5) // or however many you want to display
            ->get();

        return view('welcome', compact('newestAuctions'));
    }
}
