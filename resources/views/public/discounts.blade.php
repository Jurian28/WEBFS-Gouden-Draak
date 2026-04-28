@extends('public.layout.layout')

@section('content')

    <div class="container py-5">

        <h1 class="mb-4">Current Discounts</h1>

        @if($discounts->isEmpty())
            <p>No discounts available at the moment.</p>
        @else

            <div class="row g-4">

                @foreach($discounts as $discount)
                    <div class="col-12 col-md-6 col-lg-4">

                        <div class="card h-100 shadow-sm">

                            <div class="card-body">

                                <h4 class="card-title">
                                    {{ $discount->name }}
                                </h4>

                                <p class="text-muted mb-2">
                                    {{ $discount->description }}
                                </p>

                                <div class="mb-3">
                                <span class="badge bg-success">
                                    {{ $discount->percentage }}% OFF
                                </span>
                                </div>

                                <h6>Applies to:</h6>

                                @if($discount->dishes->isEmpty())
                                    <p class="text-muted">No dishes linked.</p>
                                @else
                                    <ul class="list-unstyled mb-0">
                                        @foreach($discount->dishes as $dish)
                                            <li>
                                                • {{ $dish->name }}
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif

                            </div>

                        </div>

                    </div>
                @endforeach

            </div>

        @endif

    </div>

@endsection
