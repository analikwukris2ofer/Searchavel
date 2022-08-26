<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ListingController extends Controller
{
    //Get and show all listings
    public function index(){
        // dd($request);
        // dd(request()->tag);
        // dd(Listing::latest()->filter(request(['tag', 'search']))->paginate(2));
        return view('listings.index', [
            // 'heading' => 'Latest Listings',
            // 'listings' => Listing::all()
            //all() retrieves using a random order
            // 'listings' => Listing::latest()->filter(request(['tag', 'search']))->get()
            //This sorts by the latest posts. The scopefilter function from the Listing model is what 
            //enables you to be able to filter. Whatever you pay into the filters will be sent to the
            //Listing model and passed in as the $filters parameter. 
            //The 'search' parameter is coming from the scopefilter function in the Listing model
            //The filter function filters elements according to the items in the request in accordance with
            //the criteria set at the Listings model page.
            'listings' => Listing::latest()->filter(request(['tag', 'search']))->paginate(6)
            //Paginate takes in the number of elements we want per page.
            // 'listings' => Listing::latest()->filter(request(['tag', 'search']))->simplePaginate(6)
            //This is similar to Paginate except that it has the next and previous buttons instead of numbers.
     
        ]);

    }

    //Show single listing
    public function show(Listing $listing){
        // uses route model binding to automatically identify and pull out the selected record using the id from the database
        return view('listings.show', [
            // The listing comes from the function using route model binding and as a result if the 
            //path does not exist it will automatically throw an error.
            'listing' => $listing
        ]);

    }

    //Show Create Form
    public function create() {
        return view('listings.create');
    }

    //Store Listing Data
    public function store(Request $request) {
        // when we submit a form we usually get a token
        // dd($request->all());
        //dd($request->file('logo'));
        $formFields = $request->validate([
            // These values are the name attributes from the form
            'title' => 'required',
            'company' => ['required', Rule::unique('listings','company')],
            // This basically says that when company is used in the listings table the company field should be unique.
            'location' => 'required',
            'website' => 'required',
            'email' => ['required', 'email'],
            //This means that the email is required and it has to be formatted as an email.
            'tags' => 'required',
            'description' => 'required'
        ]);

        if($request->hasFile('logo')) {
            //This checks if the $request contains a file in the 'logo' name space
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
            //this will store in public since we have configured the filesystem file and it will create
            //a folder called logos in storage/app folder.  file('logo') is what we named it in the database.
        }

        Listing::create($formFields);
        // This creates a new input into the 'listing table' in the searchavel database

        // Session::flash('message', 'Listing Created');
        return redirect('/')->with('message', 'Listing created successfully!');
        //This redirects to the home page and creates a flash message
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