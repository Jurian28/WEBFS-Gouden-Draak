@extends('employee.layout.layout')
@section('title', 'Create Discount')

@section('content')
    <div class="max-w-2xl mx-auto bg-white p-8 rounded-2xl shadow-lg">
        <h2 class="text-2xl font-semibold mb-6 text-gray-800">Create Discount</h2>

        <form method="POST" action="{{ route('discounts.store') }}" class="space-y-6">
            @csrf

            <!-- Select dishes -->
            <div>
                <label for="dishes" class="block text-sm font-medium text-gray-700 mb-2">
                    Select Dishes
                </label>
                <select name="dishes[]" id="dishes" multiple size="15"
                        class="w-full rounded-xl border border-gray-200 bg-gray-50 px-3 py-2
                       shadow-sm transition
                       focus:bg-white focus:border-blue-500 focus:ring-2 focus:ring-blue-100
                       outline-none">
                    @foreach($dishes as $dish)
                        <option value="{{ $dish->id }}">
                            {{ $dish->name }}
                        </option>
                    @endforeach
                </select>
                <p class="text-xs text-gray-500 mt-1">Hold Ctrl (or Cmd) to select multiple</p>
            </div>

            <!-- Discount percentage -->
            <div>
                <label for="percentage" class="block text-sm font-medium text-gray-700 mb-2">
                    Discount Percentage
                </label>
                <div class="relative">
                    <input
                        type="number"
                        name="percentage"
                        id="percentage"
                        min="1"
                        max="100"
                        required
                        placeholder="e.g. 20"
                        class="w-full rounded-xl border border-gray-200 bg-gray-50 px-3 py-2 pr-10
                           shadow-sm transition
                           focus:bg-white focus:border-blue-500 focus:ring-2 focus:ring-blue-100
                           outline-none"
                    >
                    <span class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 text-sm">
                    %
                </span>
                </div>
            </div>

            <!-- Start time -->
            <div>
                <label for="start_time" class="block text-sm font-medium text-gray-700 mb-2">
                    Start Time
                </label>
                <input
                    type="datetime-local"
                    name="start_time"
                    id="start_time"
                    required
                    class="w-full rounded-xl border border-gray-200 bg-gray-50 px-3 py-2
                       shadow-sm transition
                       focus:bg-white focus:border-blue-500 focus:ring-2 focus:ring-blue-100
                       outline-none"
                >
            </div>

            <!-- End time -->
            <div>
                <label for="end_time" class="block text-sm font-medium text-gray-700 mb-2">
                    End Time
                </label>
                <input
                    type="datetime-local"
                    name="end_time"
                    id="end_time"
                    required
                    class="w-full rounded-xl border border-gray-200 bg-gray-50 px-3 py-2
                       shadow-sm transition
                       focus:bg-white focus:border-blue-500 focus:ring-2 focus:ring-blue-100
                       outline-none"
                >
            </div>

            <!-- Submit -->
            <div class="pt-2">
                <button type="submit"
                        class="w-full bg-blue-600 text-white py-2.5 px-4 rounded-xl font-medium
                       shadow-md hover:bg-blue-700 hover:shadow-lg
                       active:scale-[0.99] transition">
                    Save Discount
                </button>
            </div>
        </form>
    </div>
@endsection
