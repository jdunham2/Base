@if($listing["video_html"])

<div class="details-header-back"><span class="big-white-font">Listing Video</span></div>

<?php
if (strpos($listing["video_html"], 'youtu') !== false) :
$listing["video_html"] = str_replace("http://www.youtube.com/watch?v=", "", $listing["video_html"]);
$listing["video_html"] = str_replace("https://www.youtube.com/watch?v=", "", $listing["video_html"]);
$listing["video_html"] = str_replace("http://youtu.be/", "", $listing["video_html"]);
$listing["video_html"] = str_replace("https://youtu.be/", "", $listing["video_html"]);
?>

<iframe width="560" height="315" src="http://www.youtube.com/embed/<?php echo $listing["video_html"];?>" frameborder="0"
        allowfullscreen></iframe>
<?php
else:
    echo "<a href='" . $listing["video_html"] . "'>" . $listing["video_html"] . "</a>";
endif;
?>

<br/><br/>

    @endif