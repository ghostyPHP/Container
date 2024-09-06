<?php

namespace Ghosty\Container\Contracts;

use Ghosty\Container\Binding;
use Psr\Container\ContainerInterface;

interface ContainerContract extends ContainerInterface
{
    public function bind(string $abstract, Binding $binding): void;

    public function make($abstract, array $args = []);
}
