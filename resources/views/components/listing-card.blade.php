{{-- We define this as a component where we pass in props. --}}
@props(['listing'])

{{-- <div class="bg-gray-50 border border-gray-200 rounded p-6"> --}}
<x-card>
    <div class="flex">
        <img class="hidden w-48 mr-6 md:block" src="{{ asset('images/no-image.png') }}" alt="" />
        <div>
            <h3 class="text-2xl">
                <a href="/listings/{{ $listing->id }}">{{ $listing->title }}</a>
            </h3>
            <div class="text-xl font-bold mb-4">{{ $listing->company }}</div>
            {{-- here we we the listing-tags component, it is imported with the 'x' --}}
            <x-listing-tags :tagsCsv="$listing->tags" />

            <div class="text-lg mt-4">
                <i class="fa-solid fa-location-dot"></i> {{ $listing->location }}
            </div>
        </div>
    </div>
    {{-- </div> --}}
</x-card>
