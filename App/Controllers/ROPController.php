<?php
namespace App\Controllers;

class ROPController extends BaseController {
    function show() {
        $company_display_ads = json_decode(
            file_get_contents('http://pennysaveronline.com/feeds/display_ads_by_category.php?cat=automotive'))
            ->data;

        return View('pages.rop', compact('company_display_ads'));
    }
}