<?php

namespace Ghosty\Container\Contracts;

use Ghosty\Container\Binding;

interface ContainerContract
{
    public function bind(string $abstract, Binding $binding): void;

    public function make($abstract);
}
