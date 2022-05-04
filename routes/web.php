<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    $listings = \App\Models\Listing::all();
    return view('listings', compact('listings'));

});

Route::get('/listings/{id}', function ($id) {
    $listing = \App\Models\Listing::find($id);
    return view('listing', compact('listing'));

});
