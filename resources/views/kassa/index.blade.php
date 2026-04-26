@extends('kassa.layout.layout')
@section('title', 'Goodpay kassa')

@section('content')
    <div id="app">
        <kassa-component :dishes-list='@json($dishesList)' :dishes-by-type='@json($dishesByType)'></kassa-component>
    </div>
@endsection
