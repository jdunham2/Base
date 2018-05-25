@if($listing["description"])

<div class="details-header-back"><span class="big-white-font">Description</span></div>
<div class="col-lg-12 no-left-padding">
    {{nl2br(stripslashes(strip_tags($listing["description"])))}}
</div>
<br/><br/>

@endif