<?php
namespace App\Facades;

use App\Core\App as Instance;

class App extends Facade
{
	protected static function getName()
    {
        return "app";
    }

    public static function __callStatic($method, $args)
    {
        if (!method_exists(Instance::class, $method) && !method_exists(Instance::class, "__call")) {
            try {
                return App::get($method);
            } catch (\Exception $e) {
                throw new \Exception(get_called_class() . ' does not implement ' . $method . ' method.');
            }
        }

        return call_user_func_array([Instance::class, $method], $args);
    }

}