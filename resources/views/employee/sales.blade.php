@extends('employee.layout.layout')
@section('title', 'Goodpay kassa')

@section('content')

    <div class="max-w-6xl mx-auto p-6 space-y-6">

        {{-- FILTER CARD --}}
        <div class="bg-white shadow rounded-xl p-4 flex flex-col md:flex-row md:items-end gap-4">

            <form action="{{ route('salesOverview') }}" method="GET" class="flex flex-col md:flex-row gap-3 w-full">

                <div class="flex flex-col">
                    <label class="text-sm text-gray-600">Start datum</label>
                    <input type="date" name="start"
                           class="border rounded-lg px-3 py-2 focus:ring focus:ring-blue-200">
                </div>

                <div class="flex flex-col">
                    <label class="text-sm text-gray-600">Eind datum</label>
                    <input type="date" name="end"
                           class="border rounded-lg px-3 py-2 focus:ring focus:ring-blue-200">
                </div>

                <div class="flex items-end">
                    <button type="submit"
                            class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
                        Maak
                    </button>
                </div>

            </form>
        </div>

        {{-- SUMMARY CARDS --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

            <div class="bg-white shadow rounded-xl p-4">
                <p class="text-gray-500 text-sm">Omzet</p>
                <p class="text-2xl font-bold">€ {{ number_format($revenue, 2, ',', '.') }}</p>
            </div>

            <div class="bg-white shadow rounded-xl p-4">
                <p class="text-gray-500 text-sm">BTW</p>
                <p class="text-2xl font-bold">€ {{ number_format($vat, 2, ',', '.') }}</p>
            </div>

            <div class="bg-white shadow rounded-xl p-4">
                <p class="text-gray-500 text-sm">Excl. BTW</p>
                <p class="text-2xl font-bold">€ {{ number_format($exclVat, 2, ',', '.') }}</p>
            </div>

        </div>

        {{-- TABLE --}}
        @isset($sales)
            <div class="bg-white shadow rounded-xl overflow-hidden">

                <div class="p-4 border-b">
                    <h2 class="font-semibold text-gray-700">Verkopen</h2>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-sm">

                        <thead class="bg-gray-50 text-left text-gray-600">
                        <tr>
                            <th class="p-3">Datum</th>
                            <th class="p-3">Gerecht</th>
                            <th class="p-3">Prijs</th>
                            <th class="p-3">Aantal</th>
                            <th class="p-3">Subtotaal</th>
                        </tr>
                        </thead>

                        <tbody class="divide-y">
                        @foreach($sales as $sale)
                            <tr class="hover:bg-gray-50">

                                <td class="p-3 text-gray-700">
                                    {{ $sale->created_at->format('Y-m-d H:i') }}
                                </td>

                                <td class="p-3 font-medium text-gray-800">
                                    {{ $sale->dish->name }}
                                </td>

                                <td class="p-3">
                                    € {{ number_format($sale->dish->price, 2, ',', '.') }}
                                </td>

                                <td class="p-3">
                                    {{ $sale->amount }}
                                </td>

                                <td class="p-3 font-semibold">
                                    € {{ number_format($sale->dish->price * $sale->amount, 2, ',', '.') }}
                                </td>

                            </tr>
                        @endforeach
                        </tbody>

                    </table>
                </div>

            </div>
        @endisset

    </div>

@endsection
