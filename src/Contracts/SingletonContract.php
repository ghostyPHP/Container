<?php

namespace Ghosty\Container\Contracts;

interface SingletonContract
{
    /**
     * Get instance of singleton
     *
     * @return static
     */
    public static function getInstance(): static;
}
