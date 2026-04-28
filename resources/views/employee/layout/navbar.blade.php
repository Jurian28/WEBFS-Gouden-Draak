<div class="flex items-center justify-between border-b p-3">

    <img
        src="{{ asset('images/logos/goodpay.png') }}"
        alt="goodpay logo"
        class="h-10"
    >

    @if(auth()->check() && auth()->user()->role('employee'))
        <div class="flex gap-2">

            <a href="{{ route('employee') }}" class="border px-3 py-1 rounded inline-block hover:bg-gray-200">
                Kassa
            </a>

            <a href="{{ route('discounts') }}" class="border px-3 py-1 rounded inline-block hover:bg-gray-200">
                Aanbiedingen
            </a>

            <a href="{{ route('dishes') }}" class="border px-3 py-1 rounded inline-block hover:bg-gray-200">
                Gerechten
            </a>

            <a href="{{ route('sales') }}" class="border px-3 py-1 rounded inline-block hover:bg-gray-200">
                Verkoop Overzicht
            </a>

            <a href="{{ route('employee.tables') }}" class="border px-3 py-1 rounded inline-block hover:bg-gray-200">
                Tafels
            </a>

            <form action="{{ route('logout') }}" method="POST" class="inline hover:bg-gray-200">
                @csrf

                <button type="submit" class="border px-3 py-1 rounded">
                    Log Uit
                </button>
            </form>

        </div>
    @endif

</div>
