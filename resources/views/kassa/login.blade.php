@extends('kassa.layout.layout')
@section('title', 'Login')

@section('content')

    <div class="h-screen flex items-center justify-center bg-gray-100">

        <!-- LOGIN BOX -->
        <div class="w-full max-w-sm border-2 border-blue-600 rounded-lg p-6 bg-white">

            <div class="text-lg font-bold text-center mb-4">
                Inloggen
            </div>

            <form action="{{ route('authenticate') }}" method="POST" class="space-y-4 h-full">
                @csrf

                <input
                    type="number"
                    name="id"
                    placeholder="Medewerker Nummer"
                    min="1"
                    class="w-full border border-blue-600 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                >

                <input
                    type="password"
                    name="password"
                    placeholder="Wachtwoord"
                    class="w-full border border-blue-600 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                >

                <button
                    type="submit"
                    class="w-full bg-blue-600 text-white font-bold py-2 rounded hover:bg-blue-700 transition"
                >
                    Inloggen
                </button>

            </form>

            <!-- ERROR -->
            @if(session('login_error'))
                <div class="mt-4 text-red-600 font-bold text-center">
                    {{ session('login_error') }}
                </div>
            @endif

        </div>

    </div>

@endsection
