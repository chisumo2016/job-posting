<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;

class ListingController extends Controller
{
    public  function  index()
    {
        $listings = Listing::all();
        return view('listings.index', compact('listings'));
    }

    public  function  show(Listing $listing)
    {
        return view('listings.show', compact('listing'));
    }
}
