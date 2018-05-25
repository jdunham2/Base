<?php

//$strFeatures = $typeFeatures[1];

$arrVehicleFeatures = explode(",", trim("Air Conditioning,ABS,Alarm,AM/FM Radio,Alloy Wheels,Auxiliary heating,Bucket Seating,Cassette Radio,Central locking,CD Player,Cruise Control,Driver-Side Airbag,Electric heated seats,Electric windows,ESP,Extra Cab,Four wheel drive,Full Service History,Immobilizer,Leather Interior,Memory Seats,Moon Roof,Navigation system,Passenger-Side Airbag,Parking sensors,Power Lock,Power Seats,Power Steering,Power Windows,Rear Air Conditioning,Remote Alarm Control,Rear Window Defroster"));

$iFeaturesCounter = 0;

foreach($arrVehicleFeatures as $arrVehicleFeature)
{

echo '
<div class="col-md-2 vehicle-feature">

    <input type="checkbox" value="'.$arrVehicleFeature.'" name="features[]"
    '.(get_param("re_opt".($iFeaturesCounter+1))!=""?"checked":"").' >

    <span class="radio-button-text">'.$arrVehicleFeature.'</span>

</div>';


$iFeaturesCounter++;

}


