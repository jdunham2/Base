<?php

$router::get('api/vehicles', "ApiController@show");
$router::get('api/vehicles/{make}', "ApiController@show");
$router::get('api/vinchecker/{vin}', "VinCheckerController@lookup");

$router::get('dealers', 'DealerController@show');

$router::get('details/{id}', 'DetailsController@show');

$router::post('details/{id}/contact', 'ContactSellerController@create');

$router::post('imager/{username}', 'ImagerController@store');

$router::get('loan_calculator', function() {
    return die(view('pages.loan_calculator'));
});

$router::get('rop', "ROPController@show");

$router::get('search', 'SearchController@show');
$router::get('search/by_make', 'SearchController@SearchByMake');
$router::get('search/by_style', 'SearchController@SearchByStyle');
$router::get('search/advanced', 'SearchController@AdvancedSearch');

$router::get("404", function() {
    return die(view('404'));
});


customDealerRoutes($router);

function customDealerRoutes(&$router) {
    if ($user = DealerPageURL()) {
        $router::get(strtolower($user['custom_url']), function() use ($user) {
            return (new App\Controllers\SearchController())->show($user);
        });
    }
}

function DealerPageURL()
{
    if (!empty(\App\Core\Request::uri())) {
        $user = \App\Users::where('custom_url', \App\Core\Request::uri())->first();

        return $user ?: false;
    }
}
