<?php
/**
 * Created by PhpStorm.
 * User: jeshuadunham
 * Date: 6/9/17
 * Time: 11:29 AM
 */

namespace App\Controllers;

use App\Listings;

class ApiController extends BaseController
{
    public function show($make = null, $model = null)
    {
        if (!$make) {
            $makes = Listings::select('car_make')
                ->whereNotEmpty('fuel_type')
                ->groupBy('car_make')
                ->get()
                ->toArray();

            $data = compact('makes');

            return view('api_response', compact('data'));
        }

        if ($make && $model == null) {
            $make = str_replace("_", " ", $make);
            $models = Listings::select('car_model')
                ->where('car_make', $make)
                ->groupBy('car_model')
                ->get()
                ->toArray();

            $data = compact('models');

            return view('api_response', compact('data'));
        }

        return view("404");
    }
}