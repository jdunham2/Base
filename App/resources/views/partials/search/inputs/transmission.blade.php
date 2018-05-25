<label class="control-label col-md-5" for="transmission">
    <small>Transmission</small>
</label>

<div class="control-field col-md-7">
    <select name="transmission" class="form-control input-sm">
        <option value="">ANY</option>
        <?php foreach (\App\SearchWidget::getTransmissions() as $transmission)
            echo "<option " . isSelected("transmission", $transmission) . ">{$transmission}</option>";
        ?>
    </select>
</div>