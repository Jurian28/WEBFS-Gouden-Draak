@extends('admin.layout.layout')

@section('title', 'Employees')

@section('content')

    <div class="p-6 space-y-6 max-w-3xl">

        <h1 class="text-xl font-bold">Employees</h1>

        {{-- SUCCESS MESSAGE --}}
        @if(session('success'))
            <div class="bg-green-100 text-green-700 p-2 rounded">
                {{ session('success') }}
            </div>
        @endif

        {{-- ADD EMPLOYEE --}}
        <div class="bg-white p-4 rounded shadow">
            <form method="POST" action="{{ route('admin.employees.store') }}" class="flex gap-2">
                @csrf

                <input type="text"
                       name="name"
                       placeholder="New employee name"
                       class="border p-2 rounded w-full">

                <button class="bg-blue-500 text-white px-4 rounded">
                    Add
                </button>
            </form>
        </div>

        {{-- EMPLOYEE LIST --}}
        <div class="bg-white rounded shadow divide-y">

            @foreach($employees as $employee)
                <div class="p-4">

                    {{-- DISPLAY MODE --}}
                    <div class="flex justify-between items-center"
                         id="view-{{ $employee->id }}">

                        <div class="font-medium">
                            {{ $employee->name }}
                        </div>

                        <div class="space-x-2">

                            <button onclick="toggleEdit({{ $employee->id }})"
                                    class="text-blue-500 text-sm">
                                Edit
                            </button>

                            <form method="POST"
                                  action="{{ route('admin.employees.destroy', $employee) }}"
                                  class="inline">
                                @csrf
                                @method('DELETE')

                                <button class="text-red-500 text-sm"
                                        onclick="return confirm('Delete employee?')">
                                    Delete
                                </button>
                            </form>

                        </div>
                    </div>

                    {{-- EDIT MODE --}}
                    <div class="hidden"
                         id="edit-{{ $employee->id }}">

                        <form method="POST"
                              action="{{ route('admin.employees.update', $employee) }}"
                              class="flex gap-2 mt-2">
                            @csrf
                            @method('PUT')

                            <input type="text"
                                   name="name"
                                   value="{{ $employee->name }}"
                                   class="border p-2 rounded w-full">

                            <button class="bg-green-500 text-white px-3 rounded">
                                Save
                            </button>

                            <button type="button"
                                    onclick="toggleEdit({{ $employee->id }})"
                                    class="bg-gray-300 px-3 rounded">
                                Cancel
                            </button>
                        </form>

                    </div>

                </div>
            @endforeach

        </div>

    </div>

    {{-- SIMPLE TOGGLE SCRIPT --}}
    <script>
        function toggleEdit(id) {
            document.getElementById('view-' + id).classList.toggle('hidden');
            document.getElementById('edit-' + id).classList.toggle('hidden');
        }
    </script>

@endsection
