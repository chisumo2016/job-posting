<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ListingController extends Controller
{
    public  function  index()
    {
       //dd(request('tag'));
        $listings = Listing::latest()
                ->filter(request(['tag','search']))
                ->get();
        return view('listings.index', compact('listings'));
    }

    public  function  show(Listing $listing)
    {
        return view('listings.show', compact('listing'));
    }

    public function  create()
    {
        return view('listings.create');
    }

    public  function  store(Request $request)
    {
        $validator = $request->validate([
            'title'         => 'required',
            'company'       => ['required', Rule::unique('listings','company')],
            'location'      => 'required',
            'website'       => 'required',
            'email'         => ['required','email'],
            'tags'          => 'required',
            'description'   => 'required',
        ]);

        Listing::create($validator);

        return redirect('/');
    }
}
