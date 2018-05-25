<label class="control-label col-md-5" for="car_make">
    <small>Make</small>
</label>

<div class="control-field col-md-7">

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

    <select id="car_make" name="car_make" class="form-control input-sm" onChange="FindAvailableModels(this)">
        <option value="">ANY</option>

        @foreach ($current_makes as $c_make)
            <option {{ isSelected('car_make', $c_make) }}>{{ ucwords(strtolower(trim($c_make))) }}</option>
        @endforeach

    </select>
</div>

<script type="text/javascript">
    function FindAvailableModels(x) {

        var make = x.options[x.selectedIndex].value.replace(' ', "_");
        selectedModel = "";

        if ($_GET('car_model')) {
            selectedModel = $_GET('car_model').toLowerCase();
        }

        $.get('/api/vehicles/' + make, function (data) {
            var refine_widgets_count = document.getElementsByClassName("car_model").length;
            for (var i = 0; i < refine_widgets_count; i++) {
                $modelSelectBoxes = document.getElementsByClassName("car_model");
                $modelSelectBox = $modelSelectBoxes[i];
                $modelSelectBox.options.length = 0;
                $modelSelectBox.options[0] = new Option("ANY", "");

                console.log(data);
                $(data.models).each(function (index, model) {
                    var count = $modelSelectBox.options.length;
                    var isSelected = (selectedModel == model.car_model.toLowerCase());
                    $modelSelectBox.options[count] = new Option(model.car_model, model.car_model, false, isSelected);
                });
            }
        });

    }

    FindAvailableModels(document.getElementById('car_make'));
</script>