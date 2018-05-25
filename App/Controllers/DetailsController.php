<?php
/**
 * Created by PhpStorm.
 * User: jeshuadunham
 * Date: 4/11/18
 * Time: 5:27 PM
 */

namespace App\Controllers;


use App\Facades\DB;
use App\Listings;

class DetailsController extends BaseController
{
    public function show($id)
    {
        $listing = Listings::where("id", $id)->first();

        if (count($listing) == 1 && $listing[0] == false)
            return view('404', ['message' => 'Vehicle not found']);

        DB::query("UPDATE " . env('DB_PREFIX') . "listings SET visits=visits+1 WHERE id=" . $id);

        echo view('pages.details', compact(
            'arrUser',
            'id',
            'listing'
        ));
    }

}