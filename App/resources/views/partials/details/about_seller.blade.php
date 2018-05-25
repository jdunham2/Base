<?php
use App\Services\Formatters\FormatPhoneNumber;
use App\Services\Formatters\FormatWebsite;

/**
 * Show DFP ad atop dealer info:
 * Will need to enable Small block ads script from template.php
 */
//		$toss = rand(0,10);
//		echo "<div style='height:100px; width:300px; margin-left: -20px !important; text-align: center; vertical-align: center;'>";
//		if ($toss >= 5){
//			echo App\Services\DFP\DfpAdPlacement::showMedBlock1();
//		}else {
//			echo App\Services\DFP\DfpAdPlacement::showMedBlock2();
//		}
//		echo "</div>";
?>

<div class="details-dealer-info-box">
    @if (isset($showDealerLogo))
        <img src='uploaded_images/{{ $listing->seller()->user_logo }}.jpg' style='width:100%'/>"
    @endif

    <h3>{{ $listing->seller()->agency }}</h3>

    <p class="details_dealer_info">
        @if ($listing->seller()->address)
            <a href='#tab-contact' onclick='javascript:show_map()' data-toggle='tab'> {{$listing->seller()->address}}</a><br>
        @endif

        @if ($number = $listing->seller()->phone)
            {{ $number }}
            <br>
        @endif

        <a href="{{ $listing->seller()->website }}">
            {{ substr($listing->seller()->website ?: "", 0, 30) . "..."  }}
        </a>
    </p>

    <h4><a href="/{{$listing->seller()->custom_url}}">
            See other listings from this seller
        </a></h4>

    @if ($listing->username != "PrivatePartyAds")
    <p><a class="btn btn-primary no-border" href="/details/{{$listing->id}}?contact" data-toggle="collapse" data-target=".contact-collapse">
        Contact Seller
    </a></p>
    @endif

    <br>
</div>


<script>
    document.getElementById("contact_adv_button").style.display = "none";
</script>