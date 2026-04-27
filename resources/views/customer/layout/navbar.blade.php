<div class="flex items-center justify-between border-b p-3">
    <img
        src="{{ asset('images/logos/goodpay.png') }}"
        alt="goodpay logo"
        class="h-10"
    >

    <div class="flex gap-2">
        @if(auth()->check() && auth()->user()->role('customer'))
            <a href="{{ route('orderPage') }}"
                @class([
                    'pointer-events-none' => request()->routeIs('orderPage'), // disabled so customer doesn't reset the page on accident
                    'border px-3 py-1 rounded inline-block hover:bg-gray-200'
                ]) >
                Bestellen
            </a>




            <a href="{{ route('history') }}" class="border px-3 py-1 rounded inline-block hover:bg-gray-200">
                Geschiedenis
            </a>
        @endif
    </div>

</div>
