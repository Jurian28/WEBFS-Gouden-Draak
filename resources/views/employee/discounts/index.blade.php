@extends('employee.layout.layout')
@section('title', 'Discount Overview')

@section('content')
    <div class="max-w-5xl mx-auto p-6">

        <!-- Header -->
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-semibold text-gray-800">Discounts</h1>

            <a href="{{ route('discounts.create.form') }}"
               class="bg-blue-600 text-white px-4 py-2 rounded-xl shadow hover:bg-blue-700 transition">
                + Create Discount
            </a>
        </div>

        <!-- Table -->
        <div class="bg-white rounded-2xl shadow overflow-hidden">
            <table class="w-full text-left">
                <thead class="bg-gray-50 border-b">
                <tr class="text-sm text-gray-600">
                    <th class="p-4">Percentage</th>
                    <th class="p-4">Dishes</th>
                    <th class="p-4">Start</th>
                    <th class="p-4">End</th>
                    <th class="p-4">Status</th>
                </tr>
                </thead>

                <tbody class="divide-y">
                @forelse($discounts as $discount)
                    <tr class="hover:bg-gray-50">

                        <!-- Percentage -->
                        <td class="p-4 font-medium text-gray-800">
                            {{ $discount->percentage }}%
                        </td>

                        <!-- Dishes -->
                        <td class="p-4">
                            <div class="flex flex-wrap gap-2">
                                @foreach($discount->dishes as $dish)
                                    <span class="bg-gray-100 text-gray-700 text-xs px-2 py-1 rounded-lg">
                                        {{ $dish->name }}
                                    </span>
                                @endforeach
                            </div>
                        </td>

                        <!-- Start -->
                        <td class="p-4 text-sm text-gray-600">
                            {{ \Carbon\Carbon::parse($discount->start_time)->format('d M Y H:i') }}
                        </td>

                        <!-- End -->
                        <td class="p-4 text-sm text-gray-600">
                            {{ \Carbon\Carbon::parse($discount->end_time)->format('d M Y H:i') }}
                        </td>

                        <!-- Status -->
                        <td class="p-4">
                            @php
                                $now = now();
                            @endphp

                            @if($now->between($discount->start_time, $discount->end_time))
                                <span class="bg-green-100 text-green-700 text-xs px-2 py-1 rounded-lg">
                                    Active
                                </span>
                            @elseif($now->lt($discount->start_time))
                                <span class="bg-yellow-100 text-yellow-700 text-xs px-2 py-1 rounded-lg">
                                    Upcoming
                                </span>
                            @else
                                <span class="bg-gray-200 text-gray-600 text-xs px-2 py-1 rounded-lg">
                                    Expired
                                </span>
                            @endif
                        </td>

                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="p-6 text-center text-gray-500">
                            No discounts found.
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
