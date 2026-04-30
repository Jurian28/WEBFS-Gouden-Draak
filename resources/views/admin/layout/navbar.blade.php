<div class="flex items-center justify-between border-b p-3">

    <img
        src="{{ asset('images/logos/goodpay.png') }}"
        alt="goodpay logo"
        class="h-10"
    >

    @if(auth()->check() && auth()->user()->role('admin'))
        <div class="flex gap-2">

            <a href="{{ route('admin.dishes.index') }}" class="border px-3 py-1 rounded inline-block hover:bg-gray-200">
                Gerechten
            </a>

            <a href="{{ route('admin.schedule.index') }}" class="border px-3 py-1 rounded inline-block hover:bg-gray-200">
                Rooster
            </a>
            <a href="{{ route('admin.employees.index') }}" class="border px-3 py-1 rounded inline-block hover:bg-gray-200">
                Medewerkers
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
