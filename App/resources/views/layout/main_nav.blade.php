@php
    global $vehicleTypes,$type;
    $is_logged_user=false;

    if(isset($_COOKIE["AuthU"])&&$_COOKIE["AuthU"]!="")
    {
        list($cookieUser,$cookiePassword,$cookieExpire)=explode("~",$_COOKIE["AuthU"]);

        if($cookieExpire>time())
        {
            $is_logged_user=true;
        }
    }

    if(!isset($_REQUEST["p"]))
    {
@endphp
<li><a href="/" class="top-right-button">Home</a></li>

<li><a href="/search" class="browse_count"></a></li>

<li><a href="/dealers">Dealers</a></li>

<li><a href="/rop">Current Auto Ads</a></li>

<li><a href="/PrivatePartyAds">Private Party</a></li>

<li><a href="/index.php?mod=saved">Virtual Garage</a></li>

@if ($GLOBALS['implemented']['email_alerts'])
<li><a href="index.php?mod=email_alerts">Email Alerts</a></li>
@endif

<li><a href="http://pennysaveronline.com/submit/private/"
       onclick="return confirm('You will be redirected to PennysaverOnline.com to submit an ad. Vehicles will be automatically uploaded to Shop4Autos.com and appear in the paper of your choice.')">
        Sell Your Car
    </a>
</li>
<!--    <li><a href="index.php?mod=new_listing">Sell Your Car</a></li>-->
@php
    }
@endphp

<script type="text/javascript">
    var elements = document.getElementsByClassName('browse_count');
    var vehicleCount = '{{ \App\Listings::count() }}';

    for (var index in elements) {
        elements[index].innerText = "Browse over " + vehicleCount + " vehicles!"
    }
    ;
</script>
