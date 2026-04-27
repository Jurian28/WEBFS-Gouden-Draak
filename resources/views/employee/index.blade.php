@extends('employee.layout.layout')
@section('title', 'Goodpay kassa')

@section('content')
    <div id="app">
        <employee-order-component :dishes-list='@json($dishesList)' :dishes-by-type='@json($dishesByType)'></employee-order-component>
    </div>
@endsection
