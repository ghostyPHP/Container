<?php

namespace Ghosty\Container;

use Ghosty\Container\Contracts\SingletonContract;

abstract class Singleton implements SingletonContract
{
    private static $instance;



    public static function getInstance(): static
    {
        if (!(static::$instance instanceof static))
        {
            static::$instance = new static;
        }

        return static::$instance;
    }



    private function __construct()
    {
    }



    private function __clone()
    {
    }
}
