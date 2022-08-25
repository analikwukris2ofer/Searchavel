<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;

class ListingController extends Controller
{
    //Get and show all listings
    public function index(){
        // dd($request);
        // dd(request()->tag);
        return view('listings.index', [
            // 'heading' => 'Latest Listings',
            // 'listings' => Listing::all()
            //all() retrieves using a random order
            'listings' => Listing::latest()->filter(request(['tag', 'search']))->get()
            //This sorts by the latest posts. The scopefilter function from the Listing model is what 
            //enables you to be able to filter. Whatever you pay into the filters will be sent to the
            //Listing model and passed in as the $filters parameter. 
            //The 'search' parameter is coming from the 'searchbox' in the listings page which is a partials

        ]);

    }

    //Show single listing
    public function show(Listing $listing){
        return view('listings.show', [
            // The listing comes from the function using route model binding and as a result if the 
            //path does not exist it will automatically throw an error.
            'listing' => $listing
        ]);

    }
}
//Common Resource Routes:
//index - Show all listings
//show - Show single listing
//create - Show form to create new listing
//store - Store new listing
//edit - Show form to edit listing
//update - Update listing
//destroy - Delete listing