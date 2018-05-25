<?php
namespace App\Facades;

use App\Core\App;

abstract class Facade
{

    protected static function getName()
    {
        throw new \Exception('Facade does not implement getName method.');
    }

    public static function __callStatic($method, $args)
    {
        $instance = App::get(static::getName());

        if (!method_exists($instance, $method) && !method_exists($instance, "__call")) {
            throw new \Exception(get_called_class() . ' does not implement ' . $method . ' method.');
        }

        return call_user_func_array([$instance, $method], $args);
    }

}