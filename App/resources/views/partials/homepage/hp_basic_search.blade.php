<form class="form-inline hp-basic-search-form" action="/search" method="get">

    <div class="col-sm-6">
        <h1 class="white-font hp-picture-header">Search For Autos</h1>
    </div>

    <div class="clear"></div>

    <div class="form-group col-sm-2 col-sm-offset-1 hp-search-input">
        <label class="sr-only" for="used_new">All</label>
        <select name="used_new" class="form-control" id="used_new">
            <option value="">All</option>
            <option>New</option>
            <option>Used</option>
            <option>Certified</option>
        </select>
    </div>

    <div class="form-group col-sm-2 hp-search-input">
        @php
        $current_makes = \App\Listings::select('car_make')
            ->where('status', 1)
            ->andWhere('car_make', '!=', '  ')
            ->groupBy('car_make')
            ->orderBy('car_make ASC');

        if ($username = old('user'))
            $current_makes = $current_makes->andWhere('username', $username);

        $current_makes = $current_makes->get()->flatten();
        @endphp

        <label class="sr-only" for="make">Make</label>
        <select id="car_make" name="car_make" class="form-control" onChange="FindAvailableModels(this)">
            <option value="">Make</option>

            @foreach ($current_makes as $c_make)
                <option>{{ strtoupper(trim($c_make)) }}</option>
            @endforeach

        </select>

        <script type="text/javascript">
            function FindAvailableModels(x) {
                document.getElementById("car_model").options.length = 0;
                document.getElementById("car_model").options[0] = new Option("Any", "");

                var make = x.options[x.selectedIndex].value.replace(' ', "_");

                $.get('/api/vehicles/' + make, function (data) {
                    $(data.models).each(function (index, model) {
                        var count = document.getElementById("car_model").options.length;
                        document.getElementById("car_model").options[count] = new Option(model.car_model);
                    });
                });
            }
        </script>
    </div>

    <div class="form-group col-sm-2 hp-search-input">
        <label class="sr-only" for="car_model">Model</label>
        <select id="car_model" name="car_model" class="form-control">
            <option value="">Model</option>
            <!-- Rest Loaded By JS -->
        </select>
    </div>

    <div class="form-group col-sm-2 hp-search-input">
        <label class="sr-only" for="zip">Zip</label>
        <input type="number" class="form-control" id="zip" name="zip" placeholder="Zip">
        <input type="hidden" name="zip_radius" value="20">
    </div>

    <div class="form-group col-sm-2">
    <button type="submit" class="form-control btn-success" style="margin-bottom: 9px;">Search</button>
    </div>

<div class="col-sm-5 col-md-offset-6 col-sm-offset-4">
    <span class="hp-additional-search">
        <a href="/search/by_make">Browse by Make</a> |
        <a href="/search/by_style">Browse by Type</a> |
        <a href="/search/advanced">Advanced Search</a>
    </span>
</div>

</form>