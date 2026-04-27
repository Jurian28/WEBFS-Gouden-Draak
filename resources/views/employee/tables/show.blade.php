@extends('employee.layout.layout')

@section('content')

    <h1 class="text-xl font-bold">
        Table {{ $group->table->number }} - Active Session
    </h1>

    <hr class="my-4">

    <h2 class="font-bold">Guests</h2>

    <ul class="mb-4">
        @foreach($group->guests as $guest)
            <li>{{ $guest->name ?? 'Unknown' }} ({{ $guest->age ?? '?' }})</li>
        @endforeach
    </ul>

    <h3 class="font-bold mb-2">Add guest</h3>

    <form method="POST" action="{{ route('table.guest.add', [$group->id]) }}" class="space-y-2">
        @csrf

        <input type="text" name="name" placeholder="Name" class="border p-1 w-full">
        <input type="number" name="age" placeholder="Age" class="border p-1 w-full">

        <button class="bg-green-500 text-white px-3 py-1 rounded">
            Add
        </button>
    </form>

    <hr class="my-4">

    <form method="POST" action="{{ route('table.finish', [$group->id]) }}">
        @csrf
        <button class="bg-red-500 text-white px-3 py-1 rounded">
            Finish table session
        </button>
    </form>

@endsection
