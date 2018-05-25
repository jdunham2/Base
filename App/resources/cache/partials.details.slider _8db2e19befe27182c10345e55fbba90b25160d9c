<?php
$images = $listing->allImages();
if(!empty($listing["images"]) && file_exists("uploaded_images/" . $images[0] . ".jpg")) { ?>
<div id="slider" class="flexslider">
    <ul class="slides">

        <?php collect($images)->map(function($image) {
        if (trim($image) == "") return;?>

        <li>
            <img src='/uploaded_images/<?=$image?>.jpg'>
        </li>

        <?php }); ?>

    </ul>
</div>

<?php if ($hasMultipleImages = (count($images) > 1)) { ?>
<div id="carousel" class="flexslider">
    <ul class="slides">

        <?php collect($images)->map(function ($image) {
        if (trim($image) == "") return; ?>

        <li>
            <img src='/thumbnails/<?= $image ?>.jpg'>
        </li>

        <?php }); ?>

    </ul>
</div>

<div class="image_count">
    <span class="small-font"><?= sizeof($images) . ' images'; ?></span>
</div>

<?php }; ?>

<script type="text/javascript" src="/js/libs/flexslider.2.7/jquery.flexslider-min.js"></script>
<script>
    $(window).load(function () {
        // The slider being synced must be initialized first
        $('#carousel').flexslider({
            animation: "slide",
            controlNav: false,
            animationLoop: false,
            slideshow: false,
            itemWidth: 210,
            itemMargin: 5,
            asNavFor: '#slider'
        });

        $('#slider').flexslider({
            animation: "slide",
            controlNav: false,
            animationLoop: false,
            slideshow: false,
            sync: "#carousel"
        });
    });
</script>
<?php
}
else
{
?>
<div class="final-result-image">
    <img src="/images/no_pic.gif" width="300"/>
</div>
<?php
}
?>