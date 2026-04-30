<div class="border rounded bg-white p-2">

    <div class="font-semibold text-sm mb-2">
        {{ $day->format('D d M') }}
    </div>

    {{-- ADD SHIFT BUTTON --}}
    <button
        onclick="document.getElementById('modal-{{ $day->toDateString() }}').classList.remove('hidden')"
        class="text-xs bg-blue-500 text-white px-2 py-1 rounded w-full mb-2">
        + Add shift
    </button>

    {{-- SHIFTS --}}
    <div class="space-y-2">
        @foreach($shifts as $shift)
            <div class="text-xs border rounded p-2 bg-gray-50">

                <div class="font-semibold">
                    {{ $shift->employee->name }}
                </div>

                <div class="text-gray-600">
                    {{ $shift->start_time }} - {{ $shift->end_time }}
                </div>

                <div class="text-gray-500 mt-1">
                    Tables: {{ $shift->tables->pluck('number')->join(', ') }}
                </div>

            </div>
        @endforeach
    </div>

    {{-- MODAL --}}
    @include('admin.schedule.partials.shift-modal', [
        'day' => $day,
        'employees' => $employees,
        'tables' => $tables,
    ])

</div>
