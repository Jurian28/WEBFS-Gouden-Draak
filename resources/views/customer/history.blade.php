@extends('customer.layout.layout')

@section('title', 'Goodpay kassa')

@section('content')

    <div class="max-w-4xl mx-auto mt-6 px-4">

        <h2 class="text-2xl font-semibold mb-6">Geschiedenis</h2>

        @foreach($orders as $order)
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 mb-4 overflow-hidden">

                <div class="flex items-center justify-between p-4">

                    {{-- Collapsible --}}
                    <details class="w-full group">

                        <summary class="flex justify-between items-center cursor-pointer list-none">

                            <div class="flex flex-col">
                                <div class="flex items-center gap-3">
                                <span class="font-semibold text-gray-800">
                                    Order #{{ $order->id }}
                                </span>
                                    <span class="text-sm text-gray-400">
                                    {{ $order->created_at->format('H:i') }}
                                </span>
                                </div>
                            </div>

                            <div class="text-sm text-gray-500">
                                {{ $order->sales->count() }} items
                            </div>

                            <form method="POST" action="{{ route('history.order.select', ['order_id' => $order->id]) }}" class="ml-4">
                                @csrf

                                <button type="submit"
                                        class="bg-green-500 hover:bg-green-600 text-white text-sm font-medium px-4 py-2 rounded-lg shadow-sm transition active:scale-95">
                                    Select
                                </button>

                            </form>

                        </summary>

                        {{-- Content --}}
                        <div class="mt-4 space-y-2">

                            @if($order->sales->count())
                                <div class="divide-y divide-gray-100 rounded-lg border border-gray-100">

                                    @foreach($order->sales as $sale)
                                        <div class="flex justify-between items-center px-4 py-3 hover:bg-gray-50 transition">

                                            <div class="flex items-center gap-2">
                                            <span class="font-medium text-gray-800">
                                                {{ $sale->dish->name ?? 'Unknown dish' }}
                                            </span>

                                                <span class="text-sm text-gray-400">
                                                x{{ $sale->amount }}
                                            </span>
                                            </div>

                                            <div class="font-medium text-gray-700">
                                                €{{ number_format($sale->price * $sale->amount, 2) }}
                                            </div>

                                        </div>
                                    @endforeach

                                </div>
                            @else
                                <p class="text-sm text-gray-400 px-2">No sales in this order.</p>
                            @endif

                        </div>

                    </details>


                </div>

            </div>
        @endforeach

    </div>

@endsection
