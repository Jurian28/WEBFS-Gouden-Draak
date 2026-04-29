<!doctype html>
<html>
<head>
    <title>The Golden Dragon</title>

    @routes
    @vite(['resources/css/app.css'])
    @vite(['resources/js/app.js'])

    <style>
        @keyframes scroll-left {
            from { transform: translateX(100%); }
            to { transform: translateX(-100%); }
        }
    </style>
</head>

<body class="bg-[#8b0000] m-[15px] mx-[50px] font-serif">

{{-- HEADER --}}
<div class="bg-[#ff0000] p-[5px] h-[50px] flex justify-evenly items-center">

    {{-- LEFT --}}
    <div class="flex items-center gap-2">
        <img src="{{ asset('images/logos/dragon-small.png') }}" class="h-[50px]" alt="">
        <span class="text-[#ffff00] text-[30px] font-chinese">
            De Gouden Draak
        </span>
        <img src="{{ asset('images/logos/dragon-small-flipped.png') }}" class="h-[50px]" alt="">
    </div>

    {{-- MARQUEE --}}
    <a href="{{ route('public.discounts') }}" class="text-[#ffff00] font-bold no-underline">
        <div class="overflow-hidden whitespace-nowrap w-[420px]">
            <div class="inline-block animate-[scroll-left_18s_linear_infinite] font-bold mt-[15px]">
                Welkom bij De Gouden Draak. Klik op deze tekst om de aanbiedingen van deze week te zien!
            </div>
        </div>
    </a>

    {{-- RIGHT --}}
    <div class="flex items-center gap-2">
        <img src="{{ asset('images/logos/dragon-small.png') }}" class="h-[50px]" alt="">
        <span class="text-[#ffff00] text-[30px] font-chinese">
            De Gouden Draak
        </span>
        <img src="{{ asset('images/logos/dragon-small-flipped.png') }}" class="h-[50px]" alt="">
    </div>

</div>

{{-- FRAME WRAPPER --}}
<x-layout.frame>

    @include('public.layout.navbar')

    <div class="mx-[54px] mb-[25px]">
        @yield('content')
    </div>

    <div class="text-center">
        <a href="{{route('public.contact')}}" class="text-[#ffff00] no-underline">
            Naar Contact
        </a>
    </div>

</x-layout.frame>

</body>
</html>
