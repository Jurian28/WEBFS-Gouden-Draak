<div class="p-2 bg-[#ff0000]">
    <div class="flex flex-col w-full">

        {{-- TOP --}}
        <div class="flex">

            {{-- TOP LEFT (correct) --}}
            <span
                class="block w-[91px] h-[91px] bg-no-repeat bg-contain bg-center"
                style="background-image: url('{{ asset('images/corner-piece.svg') }}');">
            </span>

            <div class="flex-1 flex flex-col">
                <span class="h-[4px] bg-[#ffff00] mb-[25px]"></span>
                <span class="h-[4px] bg-[#ffff00]"></span>
            </div>

            {{-- TOP RIGHT (FIXED) --}}
            <span
                class="block w-[91px] h-[91px] bg-no-repeat bg-contain bg-center"
                style="
                background-image: url('{{ asset('images/corner-piece.svg') }}');
                transform: rotate(90deg);
                transform-origin: center;
            ">
            </span>

        </div>

        {{-- MIDDLE --}}
        <div class="flex">

            {{-- LEFT --}}
            <div class="w-[91px] flex flex-row">
                <span class="w-[4px] bg-[#ffff00] mr-[25px]"></span>
                <span class="w-[4px] bg-[#ffff00]"></span>
            </div>

            {{-- CONTENT --}}
            <div class="flex-1 flex flex-col justify-center min-h-[200px]">
                {{ $slot }}
            </div>

            {{-- RIGHT --}}
            <div class="flex flex-row pl-[1px] mr-[-0.5px] ml-[58px]">
                <span class="w-[4px] bg-[#ffff00] mr-[25px]"></span>
                <span class="w-[4px] bg-[#ffff00]"></span>
            </div>

        </div>

        {{-- BOTTOM --}}
        <div class="flex">

            {{-- BOTTOM LEFT (FIXED) --}}
            <span
                class="block w-[91px] h-[91px] bg-no-repeat bg-contain bg-center"
                style="
                background-image: url('{{ asset('images/corner-piece.svg') }}');
                transform: rotate(270deg);
                transform-origin: center;
            ">
            </span>

            <div class="flex-1 flex flex-col">
                <span class="h-[4px] bg-[#ffff00] mb-[25px] mt-[58px]"></span>
                <span class="h-[4px] bg-[#ffff00]"></span>
            </div>

            {{-- BOTTOM RIGHT (FIXED) --}}
            <span
                class="block w-[91px] h-[91px] bg-no-repeat bg-contain bg-center"
                style="
                background-image: url('{{ asset('images/corner-piece.svg') }}');
                transform: rotate(180deg);
                transform-origin: center;
            ">
            </span>
        </div>
    </div>
</div>
