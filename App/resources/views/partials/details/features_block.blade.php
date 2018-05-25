@if($features = $listing->allFeatures())

<div class="details-header-back"><span class="big-white-font">Vehicle Features</span></div>

@foreach($features as $feature)

<div class="col-sm-3 no-left-padding text-left">
    <img src="/images/check.png" alt=""/>
    {{ preg_replace('/\s+/', ' ', $feature) }}
</div>

@endforeach
@endif