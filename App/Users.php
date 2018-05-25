<?php
/**
 * Created by PhpStorm.
 * User: jeshuadunham
 * Date: 12/11/17
 * Time: 5:24 PM
 */

namespace App;


use App\Core\Model;

class Users extends Model
{
    protected $table = "re_users";
    protected $domainClass = "\Domain\User";

}