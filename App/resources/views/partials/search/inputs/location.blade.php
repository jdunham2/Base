<label class="control-label col-md-5" for="location">
    <small>Vehicle Location</small>
</label>

<div class="control-field col-md-7">
    <?php $cities = \App\Listings::select('city')
        ->where('status', 1)
        ->where("city", "!=", "  ")
        ->groupBy('city')
        ->get()
        ->flatten(); ?>

    <select type="text" class="form-control input-sm" id="location" name="location">
        <option value="">Any</option>

        <?php $cities->map(function ($city) {
            $city = ucwords(strtolower(trim($city)));

            echo "<option>{$city}</option>";
        }) ?>
    </select>
</div>