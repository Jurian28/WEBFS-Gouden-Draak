@extends('customer.layout.layout')
@section('title', 'Goodpay kassa')

@section('content')
    <div id="app">
        <customer-order-component :dishes-list='@json($dishesList)' :dishes-by-type='@json($dishesByType)'></customer-order-component>
    </div>
@endsection
