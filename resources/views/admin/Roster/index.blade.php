@extends('admin.layout.layout')

@section('title', 'Rooster')

@section('content')
    <div class="p-6 space-y-6">

        {{-- Add employee --}}
        <div class="bg-white p-4 rounded shadow">
            <form method="POST" action="{{ route('admin.employees.store') }}" class="flex gap-2">
                @csrf
                <input type="text" name="name" placeholder="Employee name"
                       class="border p-2 rounded w-64">
                <button class="bg-blue-500 text-white px-4 py-2 rounded">
                    Add
                </button>
            </form>
        </div>

        {{-- Roster --}}
        <div class="overflow-x-auto bg-white rounded shadow">
            <table class="table-auto w-full text-sm border-collapse">
                <thead class="bg-gray-100">
                <tr>
                    <th class="p-3 text-left">Table</th>

                    @foreach($days as $day)
                        <th class="p-3 text-center">
                            <div class="font-semibold">
                                {{ $day->format('D') }}
                            </div>
                            <div class="text-xs text-gray-500">
                                {{ $day->format('d M') }}
                            </div>
                        </th>
                    @endforeach
                </tr>
                </thead>

                <tbody>
                @foreach($tables as $table)
                    <tr class="border-t">
                        <td class="p-3 font-semibold bg-gray-50">
                            Table {{ $table->number }}
                        </td>

                        @foreach($days as $day)
                            @php
                                $key = $day->toDateString() . '-' . $table->id;
                                $current = $rosters[$key] ?? null;
                            @endphp

                            <td class="p-2 align-top">
                                <div class="border rounded p-2 bg-gray-50">

                                    {{-- CURRENT ASSIGNMENT --}}
                                    @if($current && $current->employee)
                                        <div class="text-xs mb-2">
                                            <div class="font-semibold text-green-700">
                                                {{ $current->employee->name }}
                                            </div>

                                            @if($current->start_time && $current->end_time)
                                                <div class="text-gray-500">
                                                    {{ $current->start_time }} - {{ $current->end_time }}
                                                </div>
                                            @endif
                                        </div>
                                    @else
                                        <div class="text-xs text-gray-400 mb-2">
                                            No assignment
                                        </div>
                                    @endif

                                    {{-- FORM --}}
                                    <form method="POST" action="{{ route('admin.roster.assign') }}" class="space-y-1">
                                        @csrf

                                        <input type="hidden" name="table_id" value="{{ $table->id }}">
                                        <input type="hidden" name="date" value="{{ $day->toDateString() }}">

                                        <select name="employee_id" class="border p-1 w-full text-xs">
                                            <option value="">-- select --</option>

                                            @foreach($employees as $employee)
                                                <option value="{{ $employee->id }}"
                                                        @if($current && $current->employee_id == $employee->id) selected @endif>
                                                    {{ $employee->name }}
                                                </option>
                                            @endforeach
                                        </select>

                                        <div class="flex gap-1">
                                            <input type="time" name="start_time"
                                                   value="{{ $current->start_time ?? '' }}"
                                                   class="border p-1 w-full text-xs">

                                            <input type="time" name="end_time"
                                                   value="{{ $current->end_time ?? '' }}"
                                                   class="border p-1 w-full text-xs">
                                        </div>

                                        <button class="bg-green-500 text-white text-xs px-2 py-1 rounded w-full">
                                            Save
                                        </button>
                                    </form>

                                </div>
                            </td>
                        @endforeach
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

    </div>
@endsection
