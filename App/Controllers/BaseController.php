<?php
/**
 * Created by PhpStorm.
 * User: jeshuadunham
 * Date: 6/9/17
 * Time: 5:19 PM
 */

namespace App\Controllers;


class BaseController
{
    public function __construct()
    {
        $GLOBALS['dieAfter'] = true;
    }
}