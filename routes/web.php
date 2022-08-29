<?php

use App\Models\Listing;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ListingController;

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
// Route::get('/', function () {
//     // return view('listings', [
//     //     'heading' => 'Latest Listings',
//     //     'listings' => Listing::all()
//     // ]);
// });
Route::get('/', [ListingController::class, 'index']);

// Single Listing
// Route::get('/listings/{id}', function($id) {
//     $listing = Listing::find($id);

//     if($listing) {
//         return view('listing', [
//             'listing' => Listing::find($id)
//         ]);
//     } else {
//         abort('404');
//     }
    
// });

//Route model binding for single listings
// Route::get('/listings/{listing}', function(Listing $listing) {
//     // return view('listing', [
//     //     // The listing comes from the function using route model binding and as a result if the 
//     //     //path does not exist it will automatically throw an error.
//     //     'listing' => $listing
//     // ]);

// });

//Show Create Form
Route::get('/listings/create', [ListingController::class, 'create'])->middleware('auth');
//The auth middleware ensures that only authenticated users can visit this route.

//Store Listing Data
Route::post('/listings', [ListingController::class, 'store'])->middleware('auth');

// Show Edit Form
Route::get('/listings/{listing}/edit', [ListingController::class, 'edit'])->middleware('auth');

//Update Listing
Route::put('/listings/{listing}', [ListingController::class, 'update'])->middleware('auth');

//Delete Listing
Route::delete('/listings/{listing}', [ListingController::class, 'destroy'])->middleware('auth');

// Manage Listings
Route::get('/listings/manage', [ListingController::class, 'manage'])->middleware('auth');

//Single listing. Always make sure that this particular route is at the bottom
Route::get('/listings/{listing}', [ListingController::class, 'show']);


//Common Resource Routes:
//index - Show all listings
//show - Show single listing
//create - Show form to create new listing
//store - Store new listing
//edit - Show form to edit listing
//update - Update listing
//destroy - Delete listing

// Show Register/Create Form
Route::get('/register', [UserController::class, 'create'])->middleware('guest');
//only guests can access this route. That is unregistered/unauthenticated users.

// Create New User
Route::post('/users', [UserController::class, 'store']);

// Log User Out
Route::post('/logout', [UserController::class, 'logout'])->middleware('auth');;

// Show Login Form
Route::get('/login', [UserController::class, 'login'])->name('login')->middleware('guest');
//This names this route as 'login'. This important for the Authenticate.php file because if the user is not
//authorized and he clicks on a link with ->middleware('auth') he will automatically be redirected to this link.
//on the other hand if the user is authorized and he tries to go to a link with a middleware('guest')
//The RouteServiceProvider.php will be responsible for re-routing this user we can change the
//from   public const HOME = '/home'; to   public const HOME = '/'; to re-route the user

// Log In User
Route::post('/users/authenticate', [UserController::class, 'authenticate']);

