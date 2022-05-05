<?php

use App\Http\Controllers\ListingController;
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

//All Listings
Route::get('/',  [ListingController::class, 'index']);

//Create Listings Form
Route::get('/listings/create',[ListingController::class, 'create']);

//Store Listings Form
Route::post('/listings',[ListingController::class, 'store']);

//Edit Listings Form
Route::get('/listings/{listing}/edit',[ListingController::class, 'edit']);

//Update Listings Form
Route::put('/listings/{listing}',[ListingController::class, 'update']);


//Show Single Listings
Route::get('/listings/{listing}',[ListingController::class, 'show']);





/*
 * Common Resource Routes:
 * index    -   Show all Listings
 * create   -   Show/Display form to create new Listing
 * show     -   Show single listing

 * store    -   Store new Listing
 * edit     -   Show form to edit listing
 * Update   -   Update Listing
 * destroy -    Delete Listing
 */
