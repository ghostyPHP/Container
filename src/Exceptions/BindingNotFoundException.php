<?php

namespace Ghosty\Container\Exceptions;

use Exception;

class BindingNotFoundException extends Exception
{
    public function __construct(string $abstract)
    {
        parent::__construct("Binding $abstract not found");
    }
}
