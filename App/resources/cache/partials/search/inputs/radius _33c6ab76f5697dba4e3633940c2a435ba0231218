<label class="control-label col-md-5" for="zip_radius">
    <small>Radius</small>
</label>

<?php $distances = collect([10, 20, 30, 35, 40, 50, 75, 100, 150, 200, 250]); ?>

<div class="control-field col-md-7">
    <select class="form-control input-sm" name="zip_radius">
        <option value="">ANY</option>

        <?php $distances->map(function ($distance) {
            $selected = isSelected("zip_radius", $distance);
            echo "<option value='{$distance}' {$selected}>{$distance} mi</option>";
        }); ?>

    </select>
</div>