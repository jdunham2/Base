@extends('layout.app')

@section('title', 'Local Dealership Inventories All in One Place... Shop4Autos')
@section('meta-description', 'Search thousands of vehicles in Central New York on Shop4Autos.')

@section('content')
    @include('partials.dealers.search_form')
<h3>Search Results</h3>
<span class="col-sm-4 col-sm-offset-8">
		Results per page:
		<select id="per_page" onchange="modifyPagination(this, '{{ currentPage(['num'=>1, 'per_page'=>5]) }}')">
			<option {{ isSelected('per_page', 5) }} >5</option>
			<option {{ isSelected('per_page', 10) }} >10</option>
			<option {{ isSelected('per_page', 25) }} >25</option>
			<option {{ isSelected('per_page', 50) }} >50</option>
		</select>
		<select id="order_by" name="order_by" onchange="modifyOrder()">
			<option {{ isSelected('order_by', 'ASC') }} >A-Z</option>
			<option {{ isSelected('order_by', 'DESC') }} >Z-A</option>
		</select>
	</span>
<span id="num-results"> {{ $dealers->count() }} Dealers </span>
<span><b>Matching</b> {{ old('dealer_keyword', "Anything") }}</span>
<span><b>Within</b> {{ old('zip_distance', 'Unlimited') }} mi </span>
<span><b>From</b> {{ old('zip', "Anywhere") }}


<script type="text/javascript">
    modifyOrder = function () {
        var href = window.location.href;
        var orderBy = document.getElementById('order_by').value;

        if (!['A-Z', 'Z-A'].indexOf(orderBy))
            window.location = "/404";

        orderBy = (orderBy == 'A-Z' ? "ASC" : "DESC");

        if (href.indexOf("?") == -1)
            return window.location = href + '?order_by=' + orderBy;

        window.location = href + '&order_by=' + orderBy;
    };

</script>

<hr/>

@php $index=0; @endphp
@foreach ($dealers as $current_dealer)
@php $index++; @endphp

@if((($num - 1) * $per_page) <= $index && $index <= ($num * $per_page))

<div class="search-result">
    <h3>
        {{ $current_dealer["agency"] }}
        <div class="price-label {{ $current_dealer->listings()->count() ?'':'hidden' }}">
            <a href="{{ $current_dealer->custom_url }}">
                 {{ $current_dealer->listings()->count() }} Listings
            </a>
        </div>
    </h3>
    <div class="panel panel-default">

        <div class="panel-body padding-10">
            <div class="row no-padding">
                <div class="col-md-3 col-xs-12">
                    <a href="{{ $current_dealer->custom_url }}">
                        <?php
                        if (trim($current_dealer["user_logo"]) != "") {
                            echo show_pic($current_dealer["user_logo"], "medium");
                        }
                        ?>
                    </a>
                </div>
                <div class="col-md-5 col-xs-12">

                    <?php
                    if(trim($current_dealer["address"]) != "")
                    {
                    ?>
                    Address:
                    <br/>
                    <?php echo strip_tags(stripslashes($current_dealer["address"]));?>
                    <br/>
                    <?php
                    }
                    ?>

                    <?php
                    if(trim($current_dealer["user_phone"]) != "")
                    {
                    ?>
                    <img src="/images/phone_icon.png" alt="phone icon"/>
                    <?php echo strip_tags(stripslashes($current_dealer["user_phone"]));?>
                    <br/>
                    <?php
                    }
                    ?>

                    <?php
                    if($current_dealer->website)
                    {
                    ?>
                    <a href="{{ $current_dealer->website }}" rel="nofollow"
                       target="_blank">{{ $current_dealer->website }}</a>
                    <br/>
                    <?php
                    }
                    ?>

                </div>
                <div class="col-md-4 col-xs-12 min-height-150">
                    <?php
                    $latest_listings = $current_dealer->listingsWithImages();
                    $i_latest_counter = 0;
                    foreach ($latest_listings as $latest_listing)
                    {
                    if ($i_latest_counter >= 8) {
                        break;
                    }

                    $images = $latest_listing->allImages();

                    ?>
                    <a title="{{ $latest_listing->headline }}" href="{{ $latest_listing->link }}">
                        <img class="img-details-margin" height="30"
                                src="<?php if ($images[0] == "" || !file_exists("uploaded_images/" . $images[0] . ".jpg")) echo "images/no_pic.gif"; else echo "thumbnails/" . $images[0] . ".jpg";?>"/></a>
                    <?php
                    $i_latest_counter++;
                    }


                    ?>
                    <br/>
                    <a class="small-font underline-link"
                       href="{{ $current_dealer->custom_url }}">See All</a>
                    <?php


                    ?>


                </div>
            </div>

        </div>
    </div>
</div>
<hr/>
@endif
@endforeach

<div class="clear"></div>

{{--//pagination logic--}}
@if($per_page < $dealers->count())

<ul class="pagination">
    <?php
    if ($num != 1) {
        echo "<li><a class=\"pagination-link\" href=" . currentPage(['num'=>1]) ."><<</a></li>";

        echo "<li><a class=\"pagination-link\" href=" . currentPage(['num' => ($num - 1)]) . "><</a></li>";
    }

    $resultsLeft = $dealers->count() - ($num * $per_page);
    if ($resultsLeft < 0)
        $resultsLeft = 0;

    $paginationStartNum = $num - 2;
    if ($paginationStartNum < 1)
        $paginationStartNum = 1;

    $paginationEndNum = $paginationStartNum + 4;
    if ($paginationEndNum * $per_page > $dealers->count()){
        $paginationEndNum = ceil($dealers->count() / $per_page);
        $paginationStartNum = $paginationEndNum - 4;
        if ($paginationStartNum < 1)
            $paginationStartNum = 1;
    }


    for ($i = $paginationStartNum; $i <= $paginationEndNum; $i++) {
        if ($i == $num) {
            echo "<li><a><b>" . $i . "</b></a></li>";
        } else {
            echo "<li><a class=\"pagination-link\" href=" . currentPage(['num' => $i]) . ">" . $i . "</a></li>";
        }
    }

    if ($num < ceil($dealers->count() / $per_page)) {
        echo "<li><a class=\"pagination-link\" href=\"" . currentPage(['num' => ($num + 1)]) . "\">></a></li>";

        echo "<li><a class=\"pagination-link\" href=\"" . currentPage(['num' => (ceil($dealers->count() / $per_page))]) . "\">>></a></li>";
    }
    ?>
</ul>

@endif


@endsection('content')