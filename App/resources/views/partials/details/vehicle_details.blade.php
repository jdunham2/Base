<div class="col-md-7 no-left-padding">
    @include('partials.details.slider')
</div>

<div class="col-md-5 left-padding-2">
@include('partials.details.save_and_share_links')

    <?php
    $details = [
        'year' => "Year",
        'car_make' => "Make",
        'car_model' => "Model",
        'variant' => "Trim",
        'mileage' => 'Mileage',
        'power' => 'Engine',
        'exterior_color' => "Exterior Color",
        'transmission' => 'Transmission',
        'drivetrain' => 'Drivetrain',
        'doors' => 'Doors',
        'fuel_type' => 'Fuel',
        'price' => 'Price'
    ];

    foreach ($details as $field => $display_text) {
        if ($listing[$field]) {
            echo "<div class=\"listing-feature\">";
            echo "{$display_text}: <b>" . strip_tags(stripslashes($listing[$field])) . "</b>";
            echo "</div>";
        }
    }

    ?>
</div>


<div class="clear"></div>
<br/>
@include('partials.details.recall_check_block')

@include('partials.details.description_block')

@include('partials.details.features_block')


<div class="clear"></div>
<br/>

@include('partials.details.video_block')

<br/><br/>
<span class="small-font">

<?php if ($GLOBALS['implemented']['show_hits']): ?>
    Total Hits:
<?php echo $listing["visits"];?>,
<?php endif; ?>

    Posted On:
    <?php echo date("m/d/Y", strip_tags($listing["date"]));?>

</span>
