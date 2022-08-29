<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Listing extends Model
{
    use HasFactory;

    // protected $fillable = ['title', 'company', 'location', 'website', 'email', 'description', 'tags'];
    // here we fill in the properties that we want to allow mass assignment to. In other words when the create
    // form is filled in and the controller validates the data. Properties here can then be directly filled in
    // the database otherwise, laravel will return an error.
    public function scopeFilter($query, array $filters) {
        //this function works with the filter functionality in the ListingController

        // dd($filters['tag']);
        // http://127.0.0.1:8000/?tag=laravel
        if($filters['tag'] ?? false) {
            //the ?? checks if there is a value in the $filters['tag'] otherwise it will return false
            //however if there is a value then it would proceed into the block.
            $query->where('tags', 'like', '%' . request('tag') . '%');
            //The query is used to search the database and look in the tags column
            // http://127.0.0.1:8000/?tag=laravel
            //for the request from the web link shown above, in this case it will search for laravel 
            //in the 'tags' database column and return items that have the laravel tag. That is what the 'like' 
            //is used for.
        }

        if($filters['search'] ?? false) {
            $query->where('title', 'like', '%' . request('search') . '%')
            ->orWhere('description', 'like', '%' . request('search') . '%')
            //here the query will the search the database columns 'title' and 'description' and 'tags'
            //it will pick the value of the search from the URL.
            ->orWhere('tags', 'like', '%' . request('search') . '%');
        }
    }

    // Relationship To User
    public function user() {
        return $this->belongsTo(User::class, 'user_id');
        //creates a relationship between Listing and the User. This 'user_id' name has to be the same name you
        //used on the listings table migration.
    }
}
