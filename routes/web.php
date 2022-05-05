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
Route::get('/listings/create',[ListingController::class, 'create'])->middleware('auth');

//Store Listings Form
Route::post('/listings',[ListingController::class, 'store'])->middleware('auth');

//Edit Listings Form
Route::get('/listings/{listing}/edit',[ListingController::class, 'edit'])->middleware('auth');

//Update Listings Form
Route::put('/listings/{listing}',[ListingController::class, 'update'])->middleware('auth');;

//Delete Listings Form
Route::delete('/listings/{listing}',[ListingController::class, 'destroy'])->middleware('auth');;

//Manage Listings
Route::get('/listings/manage', [ListingController::class,'manage'])->middleware('auth');

//Show Single Listings
Route::get('/listings/{listing}',[ListingController::class, 'show']);



//Show  Register / create form
Route::get('/register', [UserController::class,'create'])->middleware('guest');

//Create  New User
Route::post('/users', [UserController::class,'store']);

//Logout User
Route::post('/logout', [UserController::class,'logout'])->middleware('auth');;

//Show Login
Route::get('/login', [UserController::class,'login'])->name('login')->middleware('guest');;

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
