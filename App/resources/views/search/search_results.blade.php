@extends('layout.app')

@section('sidebar')
    <div class="hidden-xs hidden-sm hidden-md">
    @include('partials.search.refine_search_widget')
    </div>
@endsection

@section('content')

@if (isset($user))
    @section('title', (stripslashes(strip_tags($user['agency']))))
    @section('meta-description', "Find Vehicles for sale at " . stripslashes(strip_tags($user['title'])))

    @include('partials/search/dealer_info')
@endif

@section('title', 'Search Results')
@section('meta-description', "The largest local automotive collection in Central New York. Search thousands of new and used vehicles for sale at Shop4Autos. ")

@include('partials.search.results_info')

<div class="hidden-lg clear">
    <!--    <span class="btn btn-default" style="width: 200px;">Filter</span>-->
    <span class="btn btn-default" data-toggle="collapse" data-target=".refine-search-widget-mobile">
        Modify Results
    </span>

    <div class="clear"></div>
    <div class="refine-search-widget-mobile collapse">
        @include('partials.search.refine_search_widget')
    </div>
</div>

<div class="results-container">

    @foreach ($listings as $listing)

    <div class="search-result">
        <div class="panel panel-default">

            <div class="panel-body padding-10">
                <div class="row no-padding">
                    <div class="col-xs-12 col-sm-4 no-padding">
                        <a class="result-details-link" href="/details/{{ $listing["id"] }}">
                            {!! show_pic($listing->main_photo, 'medium', $listing->headline, 'img-res') !!}
                        </a>
                    </div>
                    <div class="col-xs-12 col-sm-8">
                        <div class="details">
                            <div class="col-sm-9">
                                <h3 class="no-tb-margin">
                                    <strong><a href="/details/{{ $listing["id"] }}" class="search-result-title">
                                            {{ $listing->headline }}
                                    </a></strong>
                                </h3>
                            </div>
                            <div class="col-sm-3">
                                <p class="no-tb-margin shop4autos-green text-center search-price">
                                    {{ $listing["price"] }}
                                </p>
                            </div>


                            <div class="hr-white"></div>
                            <?php
                                $vehicle_details = [
                                    'transmission' => 'Transmission',
                                    'power' => 'Engine',
                                    'fuel_type' => 'Fuel Type',
                                    'mileage' => "Mileage",
                                    'exterior_color' => "Exterior Color",
                                    'city' => "Location"
                                ];

                                foreach ($vehicle_details as $field => $display_text) {
                                    if (!empty($listing[$field])) {
                                        echo "<div class=\"col-sm-12 info-column\">";
                                        echo $display_text . ": " . $listing[$field];
                                        echo "</div>";
                                    }
                                }
                            ?>

                        </div>
                    </div>

                    <div class="hr-white"></div>
                    <div class="col-xs-12">

                        <div class="col-sm-6">
                            <a href="/details/{{$listing["id"]}}?contact=1" class="contact-link">
                                <span class="search-listing-buttons btn">Make Inquiry</span>
                            </a>
                        </div>

                        <div class="col-sm-6 search-listing-buttons-right">
                            @if (isset($_COOKIE["saved_listings"]) && strpos($_COOKIE["saved_listings"], $listing["id"] . ",") !== false) {
                            <a id="save_<?php echo $listing["id"]; ?>">
                                <span class="search-listing-buttons btn">In Garage</span>
                            </a>
                            @else
                            <a href="javascript:SaveListing({{ $listing["id"] }})" id="save_{{ $listing["id"] }}">
                                <span class="search-listing-buttons btn">Park in Garage</span>
                            </a>
                            @endif
                        </div>

                    </div>
                </div>

            </div>


        </div>
    </div>
    <hr/>
    @endforeach
</div>

<div class="clear"></div>


@if (ceil(count($total_listings) / $results_per_page) > 1)
    @include('partials.pagination')
@endif


@endsection
