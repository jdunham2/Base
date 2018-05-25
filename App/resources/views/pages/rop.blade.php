@extends('layout.app')

@section('title', 'Current Automotive Specials -- Print Offers')
@section('meta-description', 'Find Special Automotive Print Offers placed in Pennysaver or Evening Sun Newspapers.')

@section('content')

<h2 class="text-center">Current Automotive Offers</h2>

<div class="container">
    <div class="col-sm-6">

        @foreach ($company_display_ads as $index => $company)
        <div class="col-sm-12">
            <h4><a href="{{ $company->current_ad }}" target="_blank">{{ $company->name }}</a></h4>
        </div>

        @if ($index == ceil(count($company_display_ads) / 2))
    </div>
    <div class='col-sm-6' style="text-align: left;">
        @endif

        @endforeach
    </div>

</div>

@endsection


