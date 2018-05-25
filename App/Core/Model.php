<?php
/**
 * Created by PhpStorm.
 * User: jeshuadunham
 * Date: 12/11/17
 * Time: 3:42 PM
 */

namespace App\Core;


use App\Core\Database\QueryBuilder;
use App\Facades\DB;

class Model
{
    protected $domainClass;
    /**
     * @param $name
     * @param $arguments
     * @return \App\Core\Database\QueryBuilder
     */
    public static function __callStatic($name, $arguments)
    {
        if (!method_exists(QueryBuilder::class, $name))
            return call_user_func_array([get_called_class(), $name], $arguments);

        $self = new static();

        DB::reset();

        DB::table($self->table);

        if (isset($self->domainClass)) {
            DB::setDomainClass($self->domainClass);
        }

        return call_user_func_array([DB::class, $name], $arguments);
    }
}