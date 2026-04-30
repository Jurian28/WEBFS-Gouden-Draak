<div id="modal-{{ $day->toDateString() }}"
     class="hidden fixed inset-0 bg-black/40 flex items-center justify-center">

    <div class="bg-white p-4 rounded w-96">

        <form method="POST" action="{{ route('admin.schedule.shifts.store') }}">
            @csrf

            <input type="hidden" name="date" value="{{ $day->toDateString() }}">

            <div class="mb-2">
                <label class="text-xs">Employee</label>
                <select name="employee_id" class="w-full border p-1">
                    @foreach($employees as $employee)
                        <option value="{{ $employee->id }}">
                            {{ $employee->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="flex gap-2 mb-2">
                <input type="time" name="start_time" class="border p-1 w-full">
                <input type="time" name="end_time" class="border p-1 w-full">
            </div>

            <div class="mb-2">
                <div class="text-xs mb-1">Tables</div>

                <div class="grid grid-cols-2 gap-1 max-h-32 overflow-auto">
                    @foreach($tables as $table)
                        <label class="text-xs">
                            <input type="checkbox" name="tables[]" value="{{ $table->id }}">
                            Table {{ $table->number }}
                        </label>
                    @endforeach
                </div>
            </div>

            <div class="flex justify-between mt-3">
                <button type="button"
                        onclick="document.getElementById('modal-{{ $day->toDateString() }}').classList.add('hidden')"
                        class="text-xs px-2 py-1 bg-gray-200 rounded">
                    Cancel
                </button>

                <button class="text-xs px-3 py-1 bg-green-500 text-white rounded">
                    Save
                </button>
            </div>

        </form>

    </div>
</div>
