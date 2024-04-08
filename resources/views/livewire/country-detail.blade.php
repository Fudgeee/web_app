@extends('layout')
@section('content')
    <div class="container">
        <div class="width80p mx-auto bg-color-white opacity-95 mt-10 px-5 py-4 overflow-hidden position-relative">
            <h1 class="py-3 black">{{ $country->name }}</h1>
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <p>Capital: <b>{{ $country->capital }}</b></p>
                    <p>Population: <b>{{ $country->population }}</b></p>
                    <p>Timezone: <b>{{ $country->timezone }}</b></p>
                    <img src="{{ $country->flag }}" class="border-3-solid-black mb-2" alt="{{ $country->name }} Flag">
                </div>
                <div class="col-lg-6 col-md-6" style="min-height: 160px;">
                    <p>Currency: <b>{{ $country->currency }}</b></p>
                    @if ($lastRate)
                        <h1 class="black max-width-fit-content float-start me-2">
                            @if ($country->currency === "EUR")
                                € {{ $lastRate }}
                            @else
                                € {{ $lastRate->rate }}
                                <br>
                                {{$country->currency}} {{ $lastRate->rate }} / 1 EUR
                            @endif
                        </h1>
                        <p class="{{ $changeDirection === 'up' ? 'text-success' : 'text-danger' }} mb-0">
                            <b>{{ number_format($percentageChange, 2) }}%</b>
                            @if ($changeDirection === 'up')
                                <i class="fas fa-arrow-up"></i>
                            @else
                                <i class="fas fa-arrow-down"></i>
                            @endif
                        </p>
                    @else
                        <p class="text-danger"><b>Currency rate not found.</b></p>
                    @endif
                </div>
            </div>
            <a href="{{ route('country.list') }}" class="text-decoration-none float-end display-block position-absolute bottom-3 right-4">
                <i class="fas fa-arrow-left me-1"></i>Back to Country List
            </a>
        </div>
    </div>
@endsection