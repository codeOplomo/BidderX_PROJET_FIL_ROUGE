<?php

namespace App\Http\Controllers;

use App\Models\Auction;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function welcome(Request $request)
    {

        $timeframe = $request->input('timeframe', 7);
        $topSellers = User::topSellers($timeframe)->get();

        $newestAuctions = Auction::with('product')
            ->latest()
            ->take(5) // or however many you want to display
            ->get();

        return view('welcome', compact('newestAuctions', 'topSellers', 'timeframe'));
    }
}
