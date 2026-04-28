@extends('public.layout.layout')

@section('content')

    <div class="border border-black bg-[floralwhite] max-w-5xl mx-auto py-10 px-6 text-center text-lg">

        <h1 class="text-3xl font-extrabold mb-10">
            Current Discounts
        </h1>

        @if($discounts->isEmpty())

            <p class="text-lg">
                No discounts available at the moment.
            </p>

        @else

            <div class="space-y-10">

                @foreach($discounts as $discount)

                    <div class="border border-black/30 p-6">

                        <!-- TITLE -->
                        <h2 class="text-2xl font-bold mb-2">
                            {{ $discount->name }}
                        </h2>

                        <!-- DESCRIPTION -->
                        <p class="mb-4 text-black/70">
                            {{ $discount->description }}
                        </p>

                        <!-- BADGE -->
                        <div class="mb-6">
                        <span class="inline-block border border-black px-3 py-1 font-bold">
                            {{ $discount->percentage }}% OFF
                        </span>
                        </div>

                        <!-- DISHES -->
                        <h3 class="font-semibold mb-2">
                            Applies to:
                        </h3>

                        @if($discount->dishes->isEmpty())
                            <p class="text-black/60">
                                No dishes linked.
                            </p>
                        @else
                            <table class="mx-auto text-lg">
                                @foreach($discount->dishes as $dish)
                                    <tr>
                                        <td class="text-left font-medium py-1">
                                            • {{ $dish->name }}
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        @endif

                    </div>

                @endforeach

            </div>

        @endif

    </div>

@endsection
