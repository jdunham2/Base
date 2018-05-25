@extends('layout.app')

@section('title', "Search over {$make_count} Vehicle Makes or Brands on ")
@section('meta-description', "Prefer searching by a specific brand? We offer a variety of tools to search by when looking for your next vehicle at Shop4Autos.")
@section('meta-keywords')

@section('content')
    <div class="container">

        <div class="text-left">

            <div class="clear"></div>
            <h1>Browse Listings by Make</h1>

            <div class='col-sm-4'>
                @foreach ($makes as $make)

                    <div>
                        <a href="/search?make={{ urlencode($make['name']) }}"
                           class='make-link' title='{{$make['name']}}'>

                            {{$make['name']}}
                            <span class='browse_vehicle_count'>({{$make['count']}})</span>

                        </a>
                    </div>

                    @if (($loop->index % $makes_per_column) == $makes_per_column - 1)
                        {{--make a new column--}}
                    </div>
                    <div class="col-sm-4">
                    @endif

                @endforeach
            </div>
        </div>
    </div>
@endsection