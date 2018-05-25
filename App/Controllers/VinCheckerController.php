<?php
/**
 * Created by PhpStorm.
 * User: jeshuadunham
 * Date: 8/15/17
 * Time: 6:22 AM
 */

namespace App\Controllers;


use GuzzleHttp\Client;

class VinCheckerController extends BaseController
{
    public function lookup($vin) {
        $return = "";

        $client = new Client();

        $request = new \GuzzleHttp\Psr7\Request("GET", "https://api.nhtsa.gov/vinLookup?vin=" . $vin);
        $promise = $client->sendAsync($request)->then(function ($response) {
            echo $response->getBody();
        });

        $promise->wait();

        return $promise;
    }

}