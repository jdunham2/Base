<?php
//social share icons
$str_current_url = env('APP_URL') . "/" . $_SERVER["REQUEST_URI"];
?>

<div class="listing-feature text-right">
    <?php
    if(isset($_COOKIE["saved_listings"]) && strpos($_COOKIE["saved_listings"], $listing["id"] . ",") !== false)
    {
    ?>
    <a id="save_<?php echo $listing["id"];?>" class="btn btn-success width-100"><img width="18" height="18"
                                                                                     src="/images/save-icon.png"
                                                                                     alt="<?php echo "In Garage";?>"/> <?php echo "In Garage";?>
    </a>
    <?php
    }
    else
    {
    ?>
    <a href="javascript:SaveListing(<?php echo $listing["id"];?>)" id="save_<?php echo $listing["id"];?>"
       class="btn btn-result width-100 clear"><img width="16" height="16" src="/images/save-icon.png"
                                                   alt="<?php echo "Park in Garage";?>"/> <?php echo "Park in Garage";?>
    </a>
    <?php
    }
    ?>
</div>


<div class="social_share">
    <a class="underline-link" rel="nofollow"
       href="http://plus.google.com/share?url=<?php echo urlencode($str_current_url);?>" target="_blank">
        <img src="/images/googleplus.png" alt="Share on Google+" title="Share on Google+" height="35"/>
    </a>
    <a class="underline-link" rel="nofollow"
       href="http://www.facebook.com/sharer.php?u=<?php echo urlencode($str_current_url);?>" target="_blank">
        <img src="/images/facebook.png" alt="Share on Facebook" title="Share on Facebook" height="35"/>
    </a>
    <a class="underline-link" rel="nofollow"
       href="http://www.twitter.com/intent/tweet?text=<?php echo stripslashes(strip_tags($listing['headline']));?>&url=<?php echo urlencode($str_current_url);?>"
       target="_blank">
        <img src="/images/twitter.png" alt="Share on Twitter" title="Share on Twitter" height="35"/>
    </a>
</div>
<div class="clear"></div>


<div class="listing-feature">
    <a href="#tab-contact" onclick="javascript:show_map()" data-toggle="tab"><img src="/images/google-maps-logo.png"
                                                                                  alt="google maps" width="50px"/>
        Get Directions!</a>
</div>
<br>