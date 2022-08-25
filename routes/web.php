<?php

use App\Http\Controllers\ListingController;
use App\Models\Listing;
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
Route::get('/listings/{listing}', [ListingController::class, 'show']);

