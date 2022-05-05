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

        $validator['user_id'] = auth()->id();

        Listing::create($validator);

        return redirect('/')->with('message', 'Listing Created Successfully');
    }

    public  function  edit(Listing $listing)
    {
        return view('listings.edit', compact('listing'));
    }

    public  function  update(Request $request, Listing $listing)
    {
        // Make sure logged in user owner
        if ($listing->user_id != auth()->id()){
            abort(403, 'Unauthorized Action');
        }
        //dd($request->file('logo'));
        $validator = $request->validate([
            'title'         => 'required',
            'company'       => 'required',
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

        $validator['user_id'] = auth()->id();

        $listing->update($validator);

        return back()->with('message', 'Listing Updated Successfully');
    }

    public  function destroy(Listing $listing)
    {
        // Make sure logged in user owner
        if ($listing->user_id != auth()->id()){
            abort(403, 'Unauthorized Action');
        }

        $listing->delete();

        return redirect('/')->with('message', 'Listing deleted successfully');
    }

    public  function  manage()
    {
        $listings = auth()->user()->listings()->get();
        return view('listings.manage',compact('listings'));
    }
}
