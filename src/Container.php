<?php

namespace Ghosty\Container;

use Exception;
use Ghosty\Container\Bags\BindingBag;
use Ghosty\Container\Contracts\BindingContract;
use Ghosty\Container\Contracts\ContainerContract;
use Ghosty\Container\Exceptions\BindingNotFoundException;

class Container extends Singleton implements ContainerContract
{
    private BindingBag $BindingBag;

    protected function __construct()
    {
        $this->BindingBag = new BindingBag([]);
    }

    public function bind(string $id, Binding $binding): void
    {
        $this->BindingBag->add($id, $binding);
    }

    public function make($abstract)
    {
        return $this->handle($abstract);
    }

    public function get($abstract)
    {
        return $this->make($abstract);
    }

    private function handle(string $abstract)
    {
        if (!$this->has($abstract)) {
            return $this->resolve($abstract);
        }

        if ($this->getBinding($abstract)->isSingleton() && is_object($this->getBinding($abstract)->getImplementation())) {
            return $this->getBinding($abstract)->getImplementation();
        }

        return $this->resolveBinding($this->getBinding($abstract));
    }

    private function resolve($abstract)
    {
        if (!class_exists($abstract)) {
            throw new BindingNotFoundException($abstract);
        }

        $this->bind($abstract, new Binding($abstract));

        return $this->resolveBinding($this->getBinding($abstract));
    }

    private function resolveBinding(BindingContract $binding)
    {
        $concrete = $binding->getConcrete();

        $classReflector = new \ReflectionClass($concrete);

        if (empty($classReflector->getConstructor())) {
            if ($binding->isSingleton()) {
                return $binding->setImplementation(new $concrete)->getImplementation();
            }
            return new ($binding->getConcrete());
        }


        if (empty($classReflector->getConstructor()->getParameters())) {
            if ($binding->isSingleton()) {
                return $binding->setImplementation(new $concrete)->getImplementation();
            }

            return new ($binding->getConcrete());
        }


        $args = [];
        foreach ($classReflector->getConstructor()->getParameters() as $argument) {
            $argumentType = $argument->getType()->getName();
            if (array_key_exists($argument->getName(), $binding->getArgs())) {
                $args[$argument->getName()] = $binding->getArgs()[$argument->getName()];
            } else {
                $args[$argument->getName()] = $this->make($argumentType);
            }
        }

        if ($binding->isSingleton()) {
            return $binding->setImplementation(new $concrete(...$args))->getImplementation();
        }

        return new $concrete(...$args);
    }

    public function has($abstract): bool
    {
        return $this->BindingBag->has($abstract);
    }

    private function getBinding($abstract): BindingContract
    {
        try {
            return $this->BindingBag->get($abstract);
        } catch (Exception $e) {
            throw new BindingNotFoundException($abstract);
        }
    }
}
