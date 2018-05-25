@if (count($similar_listings = $listing->similarListings()))
<h3>Similar Listings</h3>
<hr/>
<link rel="stylesheet" href="css/results.css">
<div class="results-container">

    @foreach ($similar_listings as $listing)
        @php
            $images = $listing->allImages();
        @endphp

        <div {{ $loop->index == 1 ? "style=\"padding-left:0px\"" : "" }}
             {{ ($loop->index == 3 ? "style=\"padding-right:0px\"" : "") }} class="col-md-4 col-xs-12">

            <div class="details-similar-listings-wrap" onmouseenter="showTitle(this.getElementsByClassName('entry-overlay'))">
                <a href="{{ "/details/{$listing["id"]}" }}" class="btn-block">
                    <img src="/uploaded_images/{{$images[0]}}.jpg">
                    <div class="entry-overlay" hidden>
                        {{ (new \Domain\Listing($listing))['headline'] }}
                        @if ($listing["price"] != "")
                            , {{ $listing['price'] }}
                        @endif

                    </div>
                </a>
            </div>
        </div>
    @endforeach
</div>

<script>
    function showTitle(vehicle) {
        $(vehicle).show();
    };

</script>


<div class="clear"></div>
<br/>

@endif
