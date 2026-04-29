@extends('employee.layout.layout')
@section('content')
    <h1 class="text-xl font-bold mb-4">Tables</h1>

    <div class="grid grid-cols-3 gap-4">

        @foreach($tables as $table)
            <form method="POST" action="{{ route('table.start') }}" class="border p-4 rounded">
                @csrf

                <div class="font-bold mb-2">
                    Table {{ $table->number }}
                </div>

                <input type="hidden" name="table_id" value="{{ $table->id }}">

                <label class="block mb-2">
                    <input type="checkbox" name="deluxe" value="1">
                    DELUXE menu
                </label>

                <button class="bg-blue-500 text-white px-3 py-1 rounded">
                    Start session
                </button>
            </form>
        @endforeach

    </div>

@endsection
