@extends('public.layout.layout')

@section('content')

    <div class="border border-black bg-[floralwhite] max-w-5xl mx-auto py-10 px-6 text-center text-lg font-semibold">

        <h1 class="text-3xl font-extrabold mb-10">
            Menukaart
        </h1>

        @foreach($types as $type)
            @if($type->dishes->count())

                <div class="mb-12">

                    <!-- TYPE TITLE -->
                    <h2 class="underline text-2xl font-bold mb-6 uppercase">
                        {{ $type->name }}
                    </h2>

                    <!-- DISH LIST -->
                    <table class="w-[60%] mx-auto text-lg">
                        @foreach($type->dishes as $dish)
                            <tr class="border-b border-black/10">

                                <!-- DISH NAME -->
                                <td class="text-left font-bold py-2">
                                    {{ $dish->menu_number }}{{ $dish->menu_affix }}
                                    {{ $dish->name }}
                                    @if($dish->description)
                                        <div class="text-sm font-normal text-black/70">
                                            {{ $dish->description }}
                                        </div>
                                    @endif
                                </td>

                                <!-- PRICE -->
                                <td class="text-right font-bold whitespace-nowrap py-2">
                                    € {{ number_format($dish->price, 2, ',', '.') }}
                                </td>

                            </tr>
                        @endforeach
                    </table>

                </div>

            @endif
        @endforeach

    </div>

@endsection
