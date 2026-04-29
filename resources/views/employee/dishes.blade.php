@extends('employee.layout.layout')
@section('title', 'Goodpay kassa')

@section('content')
    <div class="flex-1 border rounded p-2 mx-50 my-5">
        @foreach($dishesByType as $type => $dishList)
            <div class="mb-4">
                <h1 class="font-bold text-xl">{{ $type }}</h1>

                <table class="w-full">
                    @foreach($dishList as $dish)
                        <tr class="hover:bg-gray-100">
                            <td class="w-[10%]">
                                {{ $dish->menu_number . $dish->menu_affix . "." }}
                            </td>

                            <td class="w-[70%]">
                                {{ $dish->name }}
                                @if($dish->description)
                                    <i>({{ $dish->description }})</i>
                                @endif

                            </td>

                            <td class="w-[10%] text-right">
                                @php $discount = $dish->activeDiscount(); @endphp

                                @if($discount)
                                    <div>
                                        <span class="line-through text-black/50">
                                            € {{ number_format($dish->price, 2, ',', '.') }}
                                        </span>
                                    </div>

                                    <div class="text-red-600 font-bold">
                                        € {{ number_format($dish->discountedPrice(), 2, ',', '.') }}
                                    </div>

                                    <div class="text-xs text-red-500">
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
        @endforeach
    </div>
@endsection
