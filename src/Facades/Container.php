<?php

namespace Ghosty\Container\Facades;





/**
 * @method static mixed make(string $abstract) Resolve class from container
 * @method static void bind(string $id, string $concrete, bool $singleton = false) Bind new class
 * @method static void singleton(string $id, string $concrete) Bind new singleton class
 * @method static bool has(string $abstract) Check if class exists in container
 * 
 */
class Container
{
    public static function __callStatic($name, $arguments)
    {
        return \Ghosty\Container\Container::getInstance()->$name(...$arguments);
    }
}
