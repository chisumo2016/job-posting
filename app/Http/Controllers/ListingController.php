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
                ->paginate(6);
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
        //dd($request->file('logo'));
        $validator = $request->validate([
            'title'         => 'required',
            'company'       => ['required', Rule::unique('listings','company')],
            'location'      => 'required',
            'website'       => 'required',
            'email'         => ['required','email'],
            'tags'          => 'required',
            'description'   => 'required',
        ]);
        //File Upload
        if ($request->hasFile('logo')){
            $validator['logo'] = $request->file('logo')->store('logos','public');
        }

        Listing::create($validator);

        return redirect('/')->with('message', 'Listing Created Successfully');
    }
}
