@extends('public.layout.layout')

@section('content')
    <div class="border border-black bg-[floralwhite] mb-[2px] pt-[18px] pb-[18px] text-center text-lg font-semibold">

        <h1 class="text-3xl font-extrabold mb-4">
            Bedankt voor uw bestelling
        </h1>

        <h3 class="text-xl font-semibold mb-6">
            Bestelnummer: #{{ $order->id }}
        </h3>

        <h3 class="mb-[30px] text-lg">
            Naam: <span class="font-bold">{{ $order->name }}</span>
        </h3>

        <h2 class="underline text-2xl font-bold mb-4">
            Uw bestelling
        </h2>

        <ul class="w-[60%] mx-auto text-lg">
            @foreach($order->sales as $sale)
                <li>
                        {{ $sale->dish->name . ' x' . $sale->amount }}
                </li>
            @endforeach
        </ul>

        <h3 class="mt-[40px] text-lg font-semibold">
            Laat deze QR code zien bij afhalen
        </h3>

        <div class="flex justify-center mt-4">
            <img src="{{ $qrCode }}" alt="qr code" style="width: 100px; height: 100px;">
        </div>

    </div>
@endsection
