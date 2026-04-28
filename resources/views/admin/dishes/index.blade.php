@extends('admin.layout.layout')

@section('title', 'Gerechten bewerken')

@section('content')
    <div class="p-6 max-w-6xl mx-auto">

        <h1 class="text-2xl font-semibold mb-6 text-gray-800">Dishes</h1>

        <!-- ===================== -->
        <!-- DISHES TABLE -->
        <!-- ===================== -->
        <div class="bg-white shadow-md rounded-xl overflow-hidden border border-gray-100">

            <table class="min-w-full text-sm">
                <thead class="bg-gray-50 text-xs uppercase text-gray-500 border-b">
                <tr>
                    <th class="px-4 py-3">#</th>
                    <th class="px-4 py-3">Name</th>
                    <th class="px-4 py-3">Beschrijving</th>
                    <th class="px-4 py-3">Type</th>
                    <th class="px-4 py-3">Price</th>
                    <th class="px-4 py-3 text-right">Actions</th>
                </tr>
                </thead>

                <tbody class="divide-y divide-gray-100">

                @foreach($dishes as $dish)
                    <tr class="hover:bg-gray-50 transition">

                        <!-- UPDATE DISH -->
                        <form method="POST" action="{{ route('admin.dishes.update', $dish->id) }}">
                            @csrf
                            @method('PUT')

                            <td class="px-4 py-2 flex gap-1">
                                <input name="menu_number"
                                       value="{{ $dish->menu_number }}"
                                       class="w-12 border-gray-200 rounded-lg px-2 py-1 text-center">

                                <input name="menu_affix"
                                       value="{{ $dish->menu_affix }}"
                                       class="w-10 border-gray-200 rounded-lg px-2 py-1 text-center">
                            </td>

                            <td class="px-4 py-2">
                                <input name="name"
                                       value="{{ $dish->name }}"
                                       class="w-full border-gray-200 rounded-lg px-2 py-1">
                            </td>


                            <td class="px-4 py-2">
                                <input name="description"
                                       value="{{ $dish->description }}"
                                       class="w-full border-gray-200 rounded-lg px-2 py-1">
                            </td>

                            <td class="px-4 py-2">
                                <select name="dish_type_id"
                                        class="border-gray-200 rounded-lg px-2 py-1">
                                    @foreach($types as $type)
                                        <option value="{{ $type->id }}"
                                            {{ $dish->dish_type_id == $type->id ? 'selected' : '' }}>
                                            {{ $type->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </td>

                            <td class="px-4 py-2">
                                <input type="number" step="0.01"
                                       name="price"
                                       value="{{ $dish->price }}"
                                       class="w-24 border-gray-200 rounded-lg px-2 py-1">
                            </td>

                            <td class="px-4 py-2 text-right flex justify-end gap-2">

                                <button class="bg-emerald-500 text-white px-3 py-1 rounded-lg hover:bg-emerald-600">
                                    Save
                                </button>
                        </form>

                        <!-- DELETE DISH -->
                        <form method="POST" action="{{ route('admin.dishes.destroy', $dish->id) }}"
                              onsubmit="return confirm('Delete this dish?')">
                            @csrf
                            @method('DELETE')

                            <button class="bg-red-500 text-white px-3 py-1 rounded-lg hover:bg-red-600">
                                Delete
                            </button>
                        </form>

                        </td>

                    </tr>
                @endforeach

                <!-- CREATE DISH -->
                <tr class="bg-gray-50 border-t">
                    <form method="POST" action="{{ route('admin.dishes.store') }}">
                        @csrf

                        <td class="px-4 py-2 flex gap-1">
                            <input name="menu_number"
                                   class="w-12 border-gray-200 rounded-lg px-2 py-1 text-center"
                                   placeholder="Nr">

                            <input name="menu_affix"
                                   class="w-10 border-gray-200 rounded-lg px-2 py-1 text-center">
                        </td>

                        <td class="px-4 py-2">
                            <input name="name"
                                   class="w-full border-gray-200 rounded-lg px-2 py-1"
                                   placeholder="New dish...">
                        </td>

                        <td class="px-4 py-2">
                            <select name="dish_type_id"
                                    class="border-gray-200 rounded-lg px-2 py-1">
                                @foreach($types as $type)
                                    <option value="{{ $type->id }}">{{ $type->name }}</option>
                                @endforeach
                            </select>
                        </td>

                        <td class="px-4 py-2">
                            <input type="number" step="0.01"
                                   name="price"
                                   class="w-24 border-gray-200 rounded-lg px-2 py-1"
                                   placeholder="0.00">
                        </td>

                        <td class="px-4 py-2 text-right">
                            <button class="bg-blue-600 text-white px-3 py-1 rounded-lg hover:bg-blue-700">
                                + Add
                            </button>
                        </td>

                    </form>
                </tr>

                </tbody>
            </table>
        </div>

        <!-- ===================== -->
        <!-- DISH TYPES -->
        <!-- ===================== -->
        <div class="mt-10">
            <h2 class="text-xl font-semibold mb-4 text-gray-800">Dish types</h2>

            <div class="bg-white shadow-md rounded-xl overflow-hidden border border-gray-100">

                <table class="min-w-full text-sm">
                    <thead class="bg-gray-50 text-xs uppercase text-gray-500 border-b">
                    <tr>
                        <th class="px-4 py-3 w-24">Order</th>
                        <th class="px-4 py-3">Name</th>
                        <th class="px-4 py-3 text-right">Actions</th>
                    </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-100">

                    @foreach($types as $type)
                        <tr class="hover:bg-gray-50 transition">

                            <!-- UPDATE TYPE -->
                            <form method="POST" action="{{ route('admin.dish-types.update', $type->id) }}">
                                @csrf
                                @method('PUT')

                                <td class="px-4 py-2">
                                    <input name="order"
                                           value="{{ $type->order }}"
                                           class="w-20 border-gray-200 rounded-lg px-2 py-1 text-center">
                                </td>

                                <td class="px-4 py-2">
                                    <input name="name"
                                           value="{{ $type->name }}"
                                           class="w-full border-gray-200 rounded-lg px-2 py-1">
                                </td>

                                <td class="px-4 py-2 text-right flex justify-end gap-2">

                                    <button class="bg-emerald-500 text-white px-3 py-1 rounded-lg hover:bg-emerald-600">
                                        Save
                                    </button>
                            </form>

                            <!-- DELETE TYPE -->
                            <form method="POST" action="{{ route('admin.dish-types.destroy', $type->id) }}"
                                  onsubmit="return confirm('Delete this type?')">
                                @csrf
                                @method('DELETE')

                                <button class="bg-red-500 text-white px-3 py-1 rounded-lg hover:bg-red-600">
                                    Delete
                                </button>
                            </form>

                            </td>

                        </tr>
                    @endforeach

                    <!-- CREATE TYPE -->
                    <tr class="bg-gray-50 border-t">

                        <form method="POST" action="{{ route('admin.dish-types.store') }}">
                            @csrf

                            <td class="px-4 py-2">
                                <input name="order"
                                       class="w-20 border-gray-200 rounded-lg px-2 py-1 text-center"
                                       placeholder="0">
                            </td>

                            <td class="px-4 py-2">
                                <input name="name"
                                       class="w-full border-gray-200 rounded-lg px-2 py-1"
                                       placeholder="New type...">
                            </td>

                            <td class="px-4 py-2 text-right">
                                <button class="bg-blue-600 text-white px-3 py-1 rounded-lg hover:bg-blue-700">
                                    + Add
                                </button>
                            </td>

                        </form>

                    </tr>

                    </tbody>
                </table>

            </div>
        </div>

    </div>
@endsection
