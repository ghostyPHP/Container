<?php

namespace Ghosty\Container\Exceptions;

use Exception;
use Psr\Container\NotFoundExceptionInterface;

class BindingNotFoundException extends Exception implements NotFoundExceptionInterface
{
    public function __construct(string $abstract)
    {
        parent::__construct("Binding $abstract not found");
    }
}
