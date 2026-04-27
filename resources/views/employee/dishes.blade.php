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

                            <td class="w-[10%]">
                                € {{ number_format($dish->price, 2, ',', '.') }}
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        @endforeach
    </div>
@endsection
