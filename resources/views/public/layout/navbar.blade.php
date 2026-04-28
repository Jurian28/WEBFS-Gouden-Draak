<div class="flex flex-wrap justify-between items-center mb-12">
    <!-- LEFT IMAGE -->
    <img
        src="{{ asset('images/logos/dragon-small.png') }}"
        alt="Golden Dragon"
        class="h-[200px] object-contain"
    >

    <!-- CENTER CONTENT -->
    <div class="text-center flex-1">

        <h2 class="m-0 text-[40px] font-bold text-[#ffff00] font-[chinese_takeawayregular]">
            Chinees Indische Specialiteiten
        </h2>

        <h1 class="m-0 text-[50px] font-bold text-[#ffff00] font-[chinese_takeawayregular]">
            De Gouden Draak
        </h1>

        <!-- NAV -->
        <nav class="flex justify-center gap-1 bg-[#ff0000] p-2 pt-4 mt-4 flex-wrap">

            <a href="{{ route('public.menu') }}"
               class="text-white text-center px-8 py-2 border border-white bg-gradient-to-b from-cyan-300 to-blue-700 no-underline hover:opacity-90">
                Menukaart
            </a>

            <a href="{{ route('public.news') }}"
               class="text-white text-center px-8 py-2 border border-white bg-gradient-to-b from-cyan-300 to-blue-700 no-underline hover:opacity-90">
                Nieuws
            </a>

            <a href="{{ route('public.contact') }}"
               class="text-white text-center px-8 py-2 border border-white bg-gradient-to-b from-cyan-300 to-blue-700 no-underline hover:opacity-90">
                Contact
            </a>

        </nav>

    </div>

    <!-- RIGHT IMAGE -->
    <img
        src="{{ asset('images/logos/dragon-small-flipped.png') }}"
        alt="Golden Dragon"
        class="h-[200px] object-contain"
    >

</div>
