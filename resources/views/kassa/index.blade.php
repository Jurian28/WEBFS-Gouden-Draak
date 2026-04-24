@extends('kassa.layout.layout')
@section('title', 'Goodpay kassa')

@section('content')
    <div id="cashDeskPage">
        <kassa-component :dishes-list='@json($dishesList)' :dishes-by-type='@json($dishesByType)'></kassa-component>
    </div>
@endsection
