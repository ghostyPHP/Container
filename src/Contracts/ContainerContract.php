<?php

namespace Ghosty\Container\Contracts;

interface ContainerContract
{
    /**
     * Bind new class
     *
     * @param  string $id Abstract or id
     * @param  string $concrete Concrete
     * @param  bool $singleton Is singleton
     * @return void
     */
    public function bind(string $id, string $concrete, bool $singleton = false): void;





    /**
     * Bind new singleton class
     *
     * @param  string $id Abstract or id
     * @param  string $concrete Concrete
     * @return void
     */
    public function singleton(string $id, string $concrete): void;





    /**
     * Resolve class from container 
     *
     * @param  mixed $id
     * @return mixed
     */
    public function make(string $id): mixed;





    /**
     * Check if class has in container
     *
     * @param  string $id Abstract or id
     * @return bool
     */
    public function has(string $id): bool;
}
