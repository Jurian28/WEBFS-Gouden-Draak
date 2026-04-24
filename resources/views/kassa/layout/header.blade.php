@vite(['resources/css/app.css'])
@vite(['resources/js/app.js'])

<div class="flex items-center justify-between border-b p-3">

    <img
        src="{{ asset('images/logos/goodpay.png') }}"
        alt="goodpay logo"
        class="h-10"
    >

    @if(auth()->check())
        <div class="flex gap-2">

            <button class="border px-3 py-1 rounded">
                Kassa
            </button>

            <button class="border px-3 py-1 rounded">
                Gerechten
            </button>

            <button class="border px-3 py-1 rounded">
                Verkoop Overzicht
            </button>


            <a class="border px-3 py-1 rounded">
                Log Uit
            </a>

        </div>
    @endif

</div>
