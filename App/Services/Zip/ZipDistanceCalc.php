<?php
/**
 * Created by PhpStorm.
 * User: jeshuadunham
 * Date: 1/8/18
 * Time: 4:37 PM
 */

namespace App\Services\Zip;


use App\Zips;

class ZipDistanceCalc
{
    public static function ZipsWithinRadius($orig_zip, $distance)
    {
        self::validateZip($orig_zip);
        self::validateDistance($distance);

        $row = Zips::where('zip', $orig_zip)->first();

        $lat1 = $row['latitude'];
        $lon1 = $row['longitude'];
        $d = $distance;
        //earth's radius in miles
        $r = 3959;

        //compute max and min latitudes / longitudes for search square
        $latN = rad2deg(asin(sin(deg2rad($lat1)) * cos($d / $r) + cos(deg2rad($lat1)) * sin($d / $r) * cos(deg2rad(0))));
        $latS = rad2deg(asin(sin(deg2rad($lat1)) * cos($d / $r) + cos(deg2rad($lat1)) * sin($d / $r) * cos(deg2rad(180))));
        $lonE = rad2deg(deg2rad($lon1) + atan2(sin(deg2rad(90)) * sin($d / $r) * cos(deg2rad($lat1)), cos($d / $r) - sin(deg2rad($lat1)) * sin(deg2rad($latN))));
        $lonW = rad2deg(deg2rad($lon1) + atan2(sin(deg2rad(270)) * sin($d / $r) * cos(deg2rad($lat1)), cos($d / $r) - sin(deg2rad($lat1)) * sin(deg2rad($latN))));

        //find all coordinates within the search square's area
        $qualifying_zips = Zips::select("zip")
            ->where("latitude",    "<=", $latN)
            ->andwhere("latitude", ">=", $latS)
            ->andWhere("longitude", ">=", $lonE)
            ->andWhere("longitude", "<=", $lonW)
            ->orderBy("state, city, latitude, longitude")
            ->get()->flatten();

        return $qualifying_zips;
    }

    public static function validateZip($zip)
    {
        $zip = substr($zip, 0, 5);

        if (!preg_match('/^[0-9]{5}$/', $zip))
          throw new \Exception("You did not enter a properly formatted zip. Please try again.");
    }

    private static function validateDistance($distance)
    {
        if (!preg_match('/^[0-9]{1,3}$/', $distance))
            throw new \Exception("You did not enter a properly formatted distance. Please try again.");
    }

}