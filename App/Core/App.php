<?php
namespace App\Core;

class App
{
    protected static $repository = [];

    public static function bind($key, $val)
    {
        static::$repository[$key] = $val;
    }

    public static function get($key)
    {
        if (!array_key_exists($key, static::$repository)) {
            throw new \Exception ("{$key} was not bound in App");
        }

        return App::$repository[$key];
    }
}