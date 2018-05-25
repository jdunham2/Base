@extends('layout.app')

@section('title', stripslashes(($listing['headline'] . " For Sale In " . $listing->city)))
@section('meta-description', htmlentities(strip_tags(stripslashes(($listing->seller()->agency . " | " .$listing['headline']. " | " . $listing['description'])))))
@section('meta-keywords', htmlentities(strip_tags(stripslashes(($listing->seller()->agency . " | " .$listing['headline']. " | " . $listing['description'])))))

@section('sidebar')
		@include('partials.details.about_seller')
@endsection

@section('content')

@include('partials.details.contact_form')

@if(isset($_GET["email_sent"]))
	<h3>Your message has been sent successfully!</h3><br/>
@endif

<div class="clear"></div>
<br/>


<h2 class="lfloat"><?php echo stripslashes(strip_tags($listing['headline']));?></h2>

<span class="listing-details-price">
{{$listing["price"]}}
</span>

<div class="clear"></div>



  <div class="justify-align">
		
	<div class="details-header-back green-font col-sm-12" id="top_of_page">

		<div class="col-sm-3 col-xs-4 text-center">
			<a class="top-nav-link" href="#tab-details" data-toggle="tab">Details</a>
		</div>
		<?php
		if($listing->username != "PrivatePartyAds" && ((trim($listing["latitude"])!=""&&trim($listing["longitude"])!="") || trim($listing["address"])!="" || trim($listing["location"])!=""))
		{
		?>
		<div class="col-sm-3 col-xs-4 text-center">
			<a class="top-nav-link" href="#tab-contact" onclick="javascript:show_map()" data-toggle="tab">Location</a>
		</div>
		<?php
		} ?>
		<div class="col-sm-3 col-xs-4 text-center">
			<a class="top-nav-link" href="#tab-calculator" data-toggle="tab">Loan Calculator</a>
		</div>
		<div style="clear:both"></div>



	
	</div>
				
	<div class="tabbable">
         
          <div class="tab-content">
		  <br/>
            <div class="tab-pane active" id="tab-details">
				@include('partials.details.vehicle_details')
			</div>
			
			
            <div class="tab-pane" id="tab-contact">
				@include('partials.details.directions')
			</div>

			  <div class="tab-pane" id="tab-calculator">
				@include('partials.loan_calculator')
			  </div>

          </div>
        </div>
        <!-- /tabs -->
</div><!--end listing details-->
<div class="clear"></div>
<br/><br/><br/>

@include('partials.details.similar_listings')

@endsection