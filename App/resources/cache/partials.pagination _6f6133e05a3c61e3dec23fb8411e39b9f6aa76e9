<?php

use App\Services\Pagination\Pagination;

// determine page (based on <_GET>)
$page = (int) old('page', 1);

// instantiate; set current page; set number of records
$pagination = (new Pagination());
$pagination->setCurrent($page);
$pagination->setTotal(count($total_listings));
$pagination->setRPP($results_per_page);

// grab rendered/parsed pagination markup
echo $pagination->parse();