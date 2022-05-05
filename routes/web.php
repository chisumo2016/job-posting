<?php

use App\Http\Controllers\ListingController;
use App\Http\Controllers\UserController;
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

//Delete Listings Form
Route::delete('/listings/{listing}',[ListingController::class, 'destroy']);

//Show Single Listings
Route::get('/listings/{listing}',[ListingController::class, 'show']);

//Show  Register / create form
Route::get('/register', [UserController::class,'create']);

//Create  New User
Route::post('/users', [UserController::class,'store']);

//Logout User
Route::post('/logout', [UserController::class,'logout']);

//Login User
Route::get('/login', [UserController::class,'login']);

//Login User
Route::post('/users/authenticate', [UserController::class,'authenticate']);




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
