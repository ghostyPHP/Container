<?php

namespace Ghosty\Container;

use Ghosty\Container\Contracts\ContainerContract;

final class Container extends Singleton implements ContainerContract
{
    private array $bindings = [];


    private array $singletons = [];



    public function bind(string $id, string|object $concrete, bool $singleton = false): void
    {
        $singleton ? $this->singletons[$id] = $concrete : $this->bindings[$id] = $concrete;
    }



    public function singleton(string $id, string $concrete): void
    {
        $this->bind($id, $concrete, true);
    }



    public function make(string $id): mixed
    {
        if ($this->isSingleton($id) && is_object($this->singletons[$id]))
        {
            return $this->singletons[$id];
        }

        return $this->resolveBinding($id);
    }



    public function has($id): bool
    {
        return $this->isSingleton($id) ? true : array_key_exists($id, $this->bindings);
    }



    private function resolveBinding(string $id)
    {

        $class = $this->getResolveClass($id);

        $classReflector = new \ReflectionClass($class);


        $constructReflector = $classReflector->getConstructor();
        if (empty($constructReflector))
        {
            if ($this->isSingleton($id))
            {
                $this->singletons[$id] = new $class;
                return $this->singletons[$id];
            }

            return new $class;
        }


        $constructArguments = $constructReflector->getParameters();
        if (empty($constructArguments))
        {
            if ($this->isSingleton($id))
            {
                $this->singletons[$id] = new $class;
                return $this->singletons[$id];
            }

            return new $class;
        }


        $args = [];
        foreach ($constructArguments as $argument)
        {

            $argumentType = $argument->getType()->getName();


            $args[$argument->getName()] = $this->make($argumentType);
        }

        if ($this->isSingleton($id))
        {
            $this->singletons[$id] = new $this->singletons[$id](...$args);
            return $this->singletons[$id];
        }

        return new $class(...$args);
    }



    private function getResolveClass(string $id)
    {
        if ($this->has($id))
        {
            return $this->isSingleton($id) ? $this->singletons[$id] : $this->bindings[$id];
        }

        return $id;
    }



    private function isSingleton($id)
    {
        return array_key_exists($id, $this->singletons);
    }
}
