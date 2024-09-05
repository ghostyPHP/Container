<?php

namespace Ghosty\Container\Facades;

/**
 * @method static mixed make(string $abstract) Resolve class from container
 * @method static void bind(string $id, string $concrete, bool $singleton = false) Bind new class
 */

class Container
{
    public static function __callStatic($name, $arguments)
    {
        return \Ghosty\Container\Container::getInstance()->$name(...$arguments);
    }
}
