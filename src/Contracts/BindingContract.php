<?php

namespace Ghosty\Container\Contracts;

interface BindingContract
{
    public function withArgs(array $args): BindingContract;

    public function singleton(): BindingContract;

    public function getConcrete(): string;

    public function getArgs(): array;

    public function isSingleton(): bool;

    public function setImplementation($implementation): BindingContract;

    public function getImplementation();
}
