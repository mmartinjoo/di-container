<?php

namespace Container\Container;

use ReflectionClass;
use ReflectionParameter;

class ContainerAuto
{
    private array $bindings;

    public function set(string $abstract, callable $factory): void
    {
        $this->bindings[$abstract] = $factory;
    }

    public function get(string $abstract)
    {
        if (isset($this->bindings[$abstract])) {
            return $this->bindings[$abstract]($this);
        }

        $constructor = (new ReflectionClass($abstract))
            ->getConstructor();

        if ($constructor === null) {
            return new $abstract;
        }

        $parameters = $constructor->getParameters();
        if (count($parameters) === 0) {
            return new $abstract;
        }

        $dependencies = array_map(
            fn (ReflectionParameter $parameter) => $parameter->getType()->getName(),
            $parameters
        );

        $resolvedDependencies = array_map(fn (string $dependency) => $this->get($dependency), $dependencies);
        return new $abstract(...$resolvedDependencies);
    }
}