<?php

namespace App\Controllers;


use App\Listings;
use App\Services\Url\UrlBuilder;
use App\Users;

class DealerController extends BaseController
{
    public function show()
    {
        $request = new \Domain\HttpRequest($_REQUEST);
        $request->validate([
            'order_by' => 'in_array:ASC,DESC',
            'zip' => 'numeric',
            'radius' => 'numeric',
            'per_page' => 'numeric',
            'num' => 'numeric'
        ], false);

        $query_to_add = UrlBuilder::Where($request->all());
        $order_by = UrlBuilder::OrderBy($request->order_by ?: 'ASC');

        $per_page = $request->per_page ?: 5;
        $num = $request->num ? $request->num : 1;

        $dealers = Users::where('user_type', 2)
            ->customWhere($query_to_add)
            ->orderBy($order_by)
            ->get();

        $total_listings = Listings::count();

        return view('pages.dealers', compact(
            'dealers',
            'num',
            'per_page',
            'total_dealers',
            'total_listings'
        ));
    }
}
