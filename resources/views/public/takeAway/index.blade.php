@extends('public.layout.layout')

@section('content')
    <div id="app" class="bg-white p-2">
        <take-away-order-component :dishes-list='@json($dishesList)' :dishes-by-type='@json($dishesByType)'></take-away-order-component>
    </div>
@endsection
