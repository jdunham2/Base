@extends('layout.app')

@section('title', 'Search Vehicle Styles on ')
@section('meta-description', "Browse by style or type to find your next vehicle on Shop4autos. Checkout our latest inventory here.")

@section('content')
<div class="container">
    <div class="clear"></div>
    <h3>Browse By Type</h3>

    <div class="col-sm-4 col-xs-6 text-center">
        <a href="/search?bodytype=a4wd">
            <img class="search-bodytype" src="/images/vehicle_types/awd4wd.jpg">
        </a>
    </div>

    <div class="col-sm-4 col-xs-6 text-center">
        <a href="/search?bodytype=Truck">
            <img class="search-bodytype" src="/images/vehicle_types/truck.jpg">
        </a>
    </div>

    <div class="col-sm-4 col-xs-6 text-center">
        <a href="/search?bodytype=Sedan">
            <img class="search-bodytype" src="/images/vehicle_types/sedan.jpg">
        </a>
    </div>

    <div class="col-sm-4 col-xs-6 text-center">
        <a href="/search?bodytype=Convertible">
            <img class="search-bodytype" src="/images/vehicle_types/convertible.jpg">
        </a>
    </div>

    <div class="col-sm-4 col-xs-6 text-center">
        <a href="/search?bodytype=Coupe">
            <img class="search-bodytype" src="/images/vehicle_types/coupe.jpg">
        </a>
    </div>

    <div class="col-sm-4 col-xs-6 text-center">
        <a href="/search?bodytype=Hatchback">
            <img class="search-bodytype" src="/images/vehicle_types/hatchback.jpg">
        </a>
    </div>

    <div class="col-sm-4 col-xs-6 text-center">
        <a href="/search?bodytype=Wagon">
            <img class="search-bodytype" src="/images/vehicle_types/wagon.jpg">
        </a>
    </div>

    <div class="col-sm-4 col-xs-6 text-center">
        <a href="/search?bodytype=SUV/Crossover">
            <img class="search-bodytype" src="/images/vehicle_types/suv.jpg">
        </a>
    </div>

    <div class="col-sm-4 col-xs-6 text-center">
        <a href="/search?bodytype=Van">
            <img class="search-bodytype" src="/images/vehicle_types/van.jpg">
        </a>
    </div>

    <div class="col-sm-4 col-xs-6 text-center">
        <a href="/search?bodytype=mpv">
            <img class="search-bodytype" src="/images/vehicle_types/mpv.jpg">
        </a>
    </div>

    <div class="col-sm-4 col-xs-6 text-center">
        <a href="/search?bodytype=Hybrid/Electric">
            <img class="search-bodytype" src="/images/vehicle_types/hybrid.jpg">
        </a>
    </div>

    <div class="col-sm-4 col-xs-6 text-center">
        <a href="/search?bodytype=incomplete">
            <img class="search-bodytype" src="/images/vehicle_types/commercial.jpg">
        </a>
    </div>

    <div class="col-sm-4 col-xs-6 text-center">
        <a href="/search?bodytype=motorcycle">
            <img class="search-bodytype" src="/images/vehicle_types/motorcycle.jpg">
        </a>
    </div>

    <div class="col-sm-4 col-xs-6 text-center">
        <a href="/search?bodytype=trailer">
            <img class="search-bodytype" src="/images/vehicle_types/trailer.jpg">
        </a>
    </div>

    <div class="col-sm-4 col-xs-6 text-center">
        <a href="/search?bodytype=tractor">
            <img class="search-bodytype" src="/images/vehicle_types/tractor.jpg">
        </a>
    </div>

</div>
<br><br>

@endsection