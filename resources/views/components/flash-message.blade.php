@if (session()->has('message'))
    {{-- This checks if the 'message' attribute we assigned in the controller is available.
    That is if a new input into the database was successfully created. --}}
    <div class="fixed top-0 left-1/2 transform -translate-x-1/2 bg-laravel text-white px-48 py-3">
        <p>
            {{ session('message') }}
            {{-- This extracts the 'message' from the ListingController --}}
        </p>
    </div>
@endif
