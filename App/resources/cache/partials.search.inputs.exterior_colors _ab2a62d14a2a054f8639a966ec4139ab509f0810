<label class="control-label col-md-5" for="exterior_color">
    <small>Exterior Color</small>
</label>

<div class="control-field col-md-7">

    <select name="exterior_color" class="form-control input-sm">

        <option value="">ANY</option>
        <?php
        $colors = explode(",", 'BEIGE,BLACK,BLUE,BROWN,GREEN,GREY,ORANGE,PURPLE,RED,SILVER,WHITE,YELLOW');
        foreach ($colors as $color)
            echo "<option " . isSelected('exterior_color', $color) . ">{$color}</option>";
        ?>

    </select>
</div>