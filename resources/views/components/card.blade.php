<div {{ $attributes->merge(['class' => 'bg-gray-50 border border-gray-200 rounded p-6']) }}>
    {{-- This can be used to merge any other classes that we add using the attributes property. --}}
    {{ $slot }}
</div>
