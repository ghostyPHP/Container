<?php

namespace Ghosty\Container;

use Ghosty\Container\Contracts\BindingContract;

class Binding implements BindingContract
{
    private string $concrete;

    private $implementation = null;

    private array $args = [];

    private bool $singleton = false;

    public function __construct(string $concrete)
    {
        $this->concrete = $concrete;
    }

    public function withArgs(array $args): BindingContract
    {
        $this->args = array_merge($this->args, $args);
        return $this;
    }

    public function singleton(): BindingContract
    {
        $this->singleton = true;
        return $this;
    }

    public function getConcrete(): string
    {
        return $this->concrete;
    }

    public function getArgs(): array
    {
        return $this->args;
    }

    public function isSingleton(): bool
    {
        return $this->singleton;
    }

    public function setImplementation($implementation): BindingContract
    {
        $this->implementation = $implementation;
        return $this;
    }

    public function getImplementation()
    {
        return $this->implementation;
    }
}
