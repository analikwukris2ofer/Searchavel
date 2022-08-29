<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('listings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            //The onDelete('cascade') means that If we have a user who creates a set of listings
            //and this user is deleted, then the listings
            // created by this user will be deleted if this user is deleted.
            //constrained means that only the ids available in the users table will have listings.
            $table->string('title');
            $table->string('logo')->nullable();
            // we dont actually store the image on the database only the path to the file on the database
            //nullable means that if it does not have an image then it is fine. that is it can be null.
            $table->string('tags');
            $table->string('company');
            $table->string('location');
            $table->string('email');
            $table->string('website');
            $table->string('description');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('listings');
    }
};
