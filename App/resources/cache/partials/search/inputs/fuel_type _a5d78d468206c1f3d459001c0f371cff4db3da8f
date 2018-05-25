<label class="control-label col-md-5" for="fuel_type">
    <small>Fuel Type</small>
</label>

<div class="control-field col-md-7 ">
    <select name="fuel_type" class="form-control input-sm">
        <option value="">ANY</option>

        <?php foreach (\App\SearchWidget::getFuelTypes() as $fuel_type)
            echo "<option " . isSelected("fuel_type", $fuel_type) . ">{$fuel_type}</option>";
        ?>

    </select>
</div>