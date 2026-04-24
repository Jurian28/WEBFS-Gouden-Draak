@extends('kassa.layout.layout')
@section('title', 'Goodpay kassa')

@section('content')

    <form action="{{ route('salesOverview') }}" method="GET" class="mb-4">
        <input type="date" name="start">
        <input type="date" name="end">

        <button type="submit" class="border px-3 py-1 rounded">
            Send
        </button>
    </form>
    <div>
        <h1>Omzet: €{{ number_format($revenue, 2, ',', '.') }}</h1>
        <h1>BTW: €{{ number_format($vat, 2, ',', '.') }}</h1>
        <h1>excl. BTW: €{{ number_format($exclVat, 2, ',', '.') }}</h1>
    </div>

    @isset($sales)

        <div class="border border-blue-600 rounded p-2">

            <table class="w-full border-collapse">
                <thead>
                <tr class="border-b border-blue-600 text-left">
                    <th>Datum</th>
                    <th>Gerecht</th>
                    <th>Prijs</th>
                    <th>Aantal</th>
                    <th>Subtotaal</th>
                </tr>
                </thead>

                <tbody>
                @foreach($sales as $sale)
                    <tr class="border-b">
                        <td class="p-2">
                            {{ $sale->created_at->format('Y-m-d H:i') }}
                        </td>
                        <td class="p-2">
                            {{ $sale->dish->name }}
                        </td>
                        <td class="p-2">
                            € {{ number_format($sale->dish->price, 2, ',', '.') }}
                        </td>
                        <td class="p-2">
                            {{ $sale->amount }}
                        </td>
                        <td class="p-2">
                            € {{ number_format($sale->dish->price * $sale->amount, 2, ',', '.') }}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

        </div>

    @endisset

@endsection
