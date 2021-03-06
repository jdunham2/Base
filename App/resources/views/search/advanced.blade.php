@extends('layout.app')

@section('content')
<div class="container">

    <h3>Advanced Search</h3>

    <!--SEARCH FORM-->

    <form id="search_form" method="get" action="/search">
        <div id="search_form_container">

            <div class="form-group">
                @include('partials.search.inputs.new_used')
            </div>

            <div class="form-group">
                @include('partials.search.inputs.make')
            </div>

            <div class="form-group">
                @include('partials.search.inputs.model')
            </div>

            <div class="form-group">
                @include('partials.search.inputs.zip')
            </div>

            <div class="form-group">
                @include('partials.search.inputs.radius')
            </div>


            <div class="form-group">
                <label class="control-label col-md-5" for="year">
                    <small>Year from</small>
                </label>

                <div class="control-field col-md-7">
                    <select name="year" class="form-control input-sm">
                        <option value="">ANY</option>

                        @for ($year = date('Y') + 1; $year >= 1960; $year--)
                            <option>{{$year}}</option>
                        @endfor

                    </select>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-5" for="doors">
                    <small>Doors</small>
                </label>

                <div class="control-field col-md-7">
                    <select name="doors" class="form-control input-sm">
                        <option value="">ANY</option>

                        @for ($num_doors = 2; $num_doors <= 5; $num_doors++)
                            <option>{{$num_doors}}</option>
                        @endfor

                    </select>
                </div>
            </div>

            <div class="form-group">
                @include('partials.search.inputs.body_style')
            </div>

            <div class="form-group">
                <label class="control-label col-md-5" for="drivetrain">
                    <small>Drivetrain</small>
                </label>

                <div class="control-field col-md-7">
                    <select name="drivetrain" class="form-control input-sm">
                        <option value="">ANY</option>

                        <option value="4WD">4WD</option>
                        <option value="AWD">AWD</option>
                        <option value="RWD">RWD</option>
                        <option value="FWD">FWD</option>
                    </select>
                </div>
            </div>

            <div class="form-group">
                @include('partials.search.inputs.max_price')
            </div>

            <div class="form-group">
                @include('partials.search.inputs.keyword')
            </div>


            <div class="form-group">
                @include('partials.search.inputs.fuel_type')
            </div>


            <div class="form-group">
                @include('partials.search.inputs.transmission')
            </div>


            <div class="form-group">
                @include('partials.search.inputs.exterior_colors')
            </div>

            <div class="form-group">
                @include('partials.search.inputs.mileage')
            </div>

            <br/>


            <div class="clearfix"></div>
            <div class="col-md-4">
                <br/>
                <input type="checkbox"
                       name="only_pictures" {{ isChecked('only_pictures', 1) }}
                       value="1"/>
                show only listings with pictures
            </div>


        </div><!--end form container-->

        <input class="btn btn-primary pull-right home-search-button shop4autos-green" type="submit" value="Search"/>

    </form>
    <div class="clear"></div>

    <!--END SEARCH FORM-->

</div>


<br/>

@endsection