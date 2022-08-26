@if (session()->has('message'))
    {{-- This checks if the 'message' attribute we assigned in the controller is available.
    That is if a new input into the database was successfully created. --}}
    <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)" x-show="show"
        class="fixed top-0 left-1/2 transform -translate-x-1/2 bg-laravel text-white px-48 py-3">
        {{-- x-data and x-init both come from alpine js. The x-data attribute controls the show. The x-init controls
        the number of milliseconds the element will show for, the x-show simply outputs the show from the x-data. --}}
        <p>
            {{ session('message') }}
            {{-- This extracts the 'message' from the ListingController --}}
        </p>
    </div>
@endif
