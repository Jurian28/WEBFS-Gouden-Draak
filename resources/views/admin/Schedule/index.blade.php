@extends('admin.layout.layout')

@section('title', 'Schedule')

@section('content')

    <div class="p-6 space-y-4">

        {{-- WEEK NAV --}}
        <div class="flex justify-between items-center">
            <a class="px-3 py-1 bg-gray-200 rounded"
               href="?week_start={{ $startOfWeek->copy()->subWeek()->toDateString() }}">
                ← Prev
            </a>

            <div class="font-bold text-lg">
                Week of {{ $startOfWeek->format('d M Y') }}
            </div>

            <a class="px-3 py-1 bg-gray-200 rounded"
               href="?week_start={{ $startOfWeek->copy()->addWeek()->toDateString() }}">
                Next →
            </a>
        </div>

        {{-- GRID --}}
        <div class="grid grid-cols-7 gap-3">
            @foreach($days as $day)
                @include('admin.schedule.partials.day', [
                    'day' => $day,
                    'shifts' => $shifts[$day->toDateString()] ?? collect(),
                    'employees' => $employees,
                    'tables' => $tables,
                ])
            @endforeach

        </div>

    </div>

@endsection
