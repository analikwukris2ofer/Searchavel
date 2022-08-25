@props(['tagsCsv'])

@php
$tags = explode(',', $tagsCsv);
// The explode function in php takes in a command seperated list and turns it into an array
//dividing it along the ',' and store it into the $tags variable.
@endphp

<ul class="flex">
    @foreach ($tags as $tag)
        <li class="flex items-center justify-center bg-black text-white rounded-xl py-1 px-3 mr-2 text-xs">
            <a href="/?tag={{ $tag }}">{{ $tag }}</a>
        </li>
    @endforeach
    {{-- <li class="flex items-center justify-center bg-black text-white rounded-xl py-1 px-3 mr-2 text-xs">
        <a href="#">API</a>
    </li>
    <li class="flex items-center justify-center bg-black text-white rounded-xl py-1 px-3 mr-2 text-xs">
        <a href="#">Backend</a>
    </li>
    <li class="flex items-center justify-center bg-black text-white rounded-xl py-1 px-3 mr-2 text-xs">
        <a href="#">Vue</a>
    </li> --}}
</ul>
