<?php

namespace Container\Container;

class ContainerManual
{
    private array $bindings;

    public function set(string $abstract, callable $factory): void
    {
        $this->bindings[$abstract] = $factory;
    }

    public function get(string $abstract): mixed
    {
        return $this->bindings[$abstract]($this);
    }
}