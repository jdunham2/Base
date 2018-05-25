<label class="control-label col-md-5" for="max_mileage">
    <small>Mileage up to</small>
</label>

<?php $mileage_intervals = explode(";", "5,000;10,000;20,000;30,000;40,000;50,000;60,000;70,000;80,000;90,000;100,000;125,000;150,000;200,000"); ?>
<div class="control-field col-md-7">
    <select name="max_mileage" class="form-control input-sm">
        <option value="">ANY</option>

        <?php foreach ($mileage_intervals as $mileage_interval) {
            $mileage_interval = trim($mileage_interval);
            echo "<option " . isSelected('max_mileage', $mileage_interval) . ">$mileage_interval</option>";
        } ?>
    </select>
</div>