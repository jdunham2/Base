<?php
/**
 * Created by PhpStorm.
 * User: jeshuadunham
 * Date: 12/11/17
 * Time: 1:54 PM
 */

namespace App;


use App\Core\Model;

class Listings extends Model
{
    protected $table = "listings";
    protected $domainClass = "\Domain\Listing";
}