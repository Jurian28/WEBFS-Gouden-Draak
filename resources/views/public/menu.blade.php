@extends('public.layout.layout')

@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <div class="border border-black bg-[floralwhite] max-w-5xl mx-auto py-10 px-6 text-center text-lg font-semibold">

        <h1 class="text-3xl font-extrabold mb-6">
            Menukaart
        </h1>

        <!-- FILTERS -->
        <div class="mb-8 text-sm space-x-4">
            <a href="{{ route('public.menu') }}" class="underline">Alles</a>
            <a href="{{ route('public.menu', ['filter' => 'favorites']) }}" class="underline">Alleen favorieten</a>
            <a href="{{ route('public.menu', ['sort' => 'alpha']) }}" class="underline">A-Z (alleen favorieten alfabetisch)</a>
        </div>

        @foreach($types as $type)

            @if($type->sorted_dishes->count())

                <div class="mb-12">

                    <h2 class="underline text-2xl font-bold mb-6 uppercase">
                        {{ $type->name }}
                    </h2>

                    <table class="w-[60%] mx-auto text-lg">

                        @foreach($type->sorted_dishes as $dish)
                            <tr class="border-b border-black/10">

                                <td class="text-left font-bold py-2">

                                    <!-- FAVORIET TOGGLE FORM -->
                                    <form method="POST" action="{{ route('public.favorites.toggle') }}" class="inline">
                                        @csrf
                                        <input type="hidden" name="dish_id" value="{{ $dish->id }}">

                                        <button type="submit" class="mr-2 text-red-500 cursor-pointer">
                                            <i class="{{ in_array($dish->id, $favorites) ? 'fas fa-heart' : 'far fa-heart' }}"></i>
                                        </button>
                                    </form>

                                    {{ $dish->menu_number }}{{ $dish->menu_affix }}
                                    {{ $dish->name }}

                                    @if($dish->description)
                                        <div class="text-sm font-normal text-black/70">
                                            {{ $dish->description }}
                                        </div>
                                    @endif
                                </td>

                                <td class="text-right font-bold whitespace-nowrap py-2">

                                    @php $discount = $dish->activeDiscount(); @endphp

                                    @if($discount)
                                        <div>
                                        <span class="line-through text-black/50">
                                            € {{ number_format($dish->price, 2, ',', '.') }}
                                        </span>
                                        </div>

                                        <div class="text-red-600">
                                            € {{ number_format($dish->discountedPrice(), 2, ',', '.') }}
                                        </div>

                                        <div class="text-xs text-red-500 font-normal">
                                            -{{ $discount->percentage }}%
                                        </div>
                                    @else
                                        € {{ number_format($dish->price, 2, ',', '.') }}
                                    @endif

                                </td>

                            </tr>
                        @endforeach

                    </table>

                </div>

            @endif

        @endforeach

    </div>

@endsection
