<label class="control-label col-md-5" for="body_style">
    <small>Type</small>
</label>

<div class="control-field col-md-7">
    <select name="body_style" class="form-control" id="body_style">
        <option <?= isSelected('body_style', ''); ?> value="">ANY</option>
        <option <?= isSelected('body_style', 'a4wd'); ?> value="a4wd">AWD/4WD</option>
        <option <?= isSelected('body_style', "incomplete"); ?> value="incomplete">Commercial</option>
        <option <?= isSelected('body_style', 'Convertible'); ?>>Convertible</option>
        <option <?= isSelected('body_style', 'Coupe'); ?>>Coupe</option>
        <option <?= isSelected('body_style', 'Hackback'); ?>>Hatchback</option>
        <option <?= isSelected('body_style', 'Hybrid/Electric'); ?>>Hybrid/Electric</option>
        <option <?= isSelected('body_style', "mpv"); ?> value="mpv">MPV (Multipurpose Vehicle)</option>
        <option <?= isSelected('body_style', "motorcycle"); ?>>Motorcycle</option>
        <option <?= isSelected('body_style', 'Sedan'); ?>>Sedan</option>
        <option <?= isSelected('body_style', 'SUV/Crossover'); ?>>SUV/Crossover</option>
        <option <?= isSelected('body_style', 'Tractor'); ?>>Tractor</option>
        <option <?= isSelected('body_style', 'Trailer'); ?>>Trailer</option>
        <option <?= isSelected('body_style', 'Truck'); ?>>Truck</option>
        <option <?= isSelected('body_style', 'Van'); ?>>Van</option>
        <option <?= isSelected('body_style', 'Wagon'); ?>>Wagon</option>
    </select>

</div>