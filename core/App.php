<?php

/**
 * Created by PhpStorm.
 * User: barthclem
 * Date: 2/22/18
 * Time: 10:39 PM
 */

namespace App\core;
class App
{

    protected static $registry = [];

    public static  function bind($key, $value) {
        static::$registry[$key] = $value;
    }

    public static function get($key) {
        if(! array_key_exists($key, static::$registry)){
            throw new Exception("Key {$key} is not found in container");
        }
        return static::$registry[$key];
    }
}