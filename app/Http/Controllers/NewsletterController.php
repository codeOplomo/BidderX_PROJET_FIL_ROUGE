<?php

namespace App\Http\Controllers;

use App\Models\NewsletterSubscriber;
use Illuminate\Http\Request;

class NewsletterController extends Controller
{
    public function subscribe(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:newsletter_subscribers',
        ]);

        NewsletterSubscriber::create($request->only('email'));

        return back()->with('success', 'You have been subscribed to our newsletter!');
    }
}
