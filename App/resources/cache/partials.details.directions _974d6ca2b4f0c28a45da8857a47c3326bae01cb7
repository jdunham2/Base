<?php
if(trim($listing["address"]) != "")
{
?>

<?php echo stripslashes(trim($listing["address"]));?></b>
<br/>
<?php
}
?>


<!--Google Maps-->
<?php
if($listing["latitude"] != "" && $listing["latitude"] != "0" && $listing["latitude"] != "0.00" && $listing["longitude"] != "" && $listing["longitude"] != "0" && $listing["longitude"] != "0.00")
{
?>
<h3 class="col-sm-12"><b>Get directions</b><?php echo " to " . stripslashes($arrUser["agency"]); ?></h3>
<div class="col-sm-5">
    <b>From: </b>
    <input id="start" placeholder="Enter address">
</div>
<div class="col-sm-5">
    <b>To: </b>
    <span id="end"><?php echo stripslashes($arrUser["agency"]);?></span>
</div>

<script type="text/javascript" src="http://maps.google.com/maps/api/js?key=AIzaSyAo0Yxc5ml4-5N_cSuFt1u899sEA8QAzRE">
</script>
<script type="text/javascript">

    function show_map() {


        var directionsService = new google.maps.DirectionsService;
        var directionsDisplay = new google.maps.DirectionsRenderer;
        var Latlng = new google.maps.LatLng(<?php echo $listing["latitude"];?>,<?php echo $listing["longitude"];?>);
        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 15,
            center: Latlng,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        });
        var Marker = new google.maps.Marker({
            position: Latlng,
            map: map,
            title: "The Map"
        });

        Marker.setMap(map);
        directionsDisplay.setMap(map);
        directionsDisplay.setPanel(document.getElementById('right-panel'));
        var onChangeHandler = function () {
            calculateAndDisplayRoute(directionsService, directionsDisplay);
        };
        document.getElementById('start').addEventListener('change', onChangeHandler);


    }

    function calculateAndDisplayRoute(directionsService, directionsDisplay) {
        var Latlng = new google.maps.LatLng(<?php echo $listing["latitude"];?>,<?php echo $listing["longitude"];?>);
        directionsService.route({
            origin: document.getElementById('start').value,
            destination: Latlng,
            travelMode: google.maps.TravelMode.DRIVING
        }, function (response, status) {
            if (status === google.maps.DirectionsStatus.OK) {
                directionsDisplay.setDirections(response);
            } else {
                window.alert('Directions request failed due to ' + status);
            }
        });
    }

</script>

<br/>
<div id="map" style="width: 75%; height: 300px">
    <div id="map-canvas"></div>
</div>
<div id="right-panel"></div>
<br/>
<?php
}
?>

<!--end Google Maps-->
