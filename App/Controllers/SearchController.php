<?php
/**
 * Created by PhpStorm.
 * User: jeshuadunham
 * Date: 3/14/18
 * Time: 7:25 PM
 */

namespace App\Controllers;


use App\Listings;
use \App\Services\Url\UrlBuilder;

class SearchController extends BaseController
{
    public function AdvancedSearch()
    {
        return View('search.advanced');
    }

    public function SearchByStyle() {
        return View('search.browse_by_type');
    }

    public function SearchByMake()
    {
        $makes_per_column = 23;
        $dontShowMakes = ['', 'x', 'xy', 'other make'];

        $makes = Listings::select('car_make as name', 'count(car_make) as count')
            ->customWhere("car_make NOT IN ('" . implode("','", $dontShowMakes) . "')")
            ->groupBy('car_make')
            ->get()
            ->map(function($car) {
                $car['name'] = strtoupper($car['name']);
                return $car;
            })->toArray();

        $make_count = count($makes);

        return View('search.browse_by_make', compact('makes_per_column','makes', "make_count"));
    }

    public function show($user = null)
    {
        $results_per_page = old('per_page', 10);
        if ($results_per_page > 100 || !is_numeric($results_per_page))
            die(View('404'));

        $query_to_add = UrlBuilder::Where($_REQUEST);
        $order_by = UrlBuilder::OrderBy(old("order_by"));

        $total_listings = \App\Listings::where("status", 1)
            ->customWhere($query_to_add)
            ->orderBy($order_by);

        if ($user) {
            $total_listings = $total_listings->andWhere('username', $user['username']);

            $user['title'] = stripslashes($user["agency"]);
        }

        $total_listings = $total_listings->get();

        if (!$total_listings || empty($total_listings->all())) {
            return View('search.no_results');
        }

        $listings = self::movePleaseCallToLast($total_listings);
        $offset = ((old('page', 1) - 1) * $results_per_page);
        $listings = array_splice($listings, $offset, $results_per_page);

        return View('search.search_results', compact(
            'user',
            'listings',
            'total_listings',
            'results_per_page'
            ));


    }

    private static function movePleaseCallToLast($listings)
    {
        $hasNoPrices = $listings->filter(function($listing) {
            if ($listing->price == 'Please Call')
                return true;
        })->all();

        $hasPrices = $listings->filter(function($listing) {
            if ($listing->price != 'Please Call')
                return true;
        })->all();

        return (array_merge($hasPrices, $hasNoPrices));

    }
}