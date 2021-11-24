<?php

namespace Container;

class ExampleService
{
    public function __construct(private readonly Logger $logger)
    {
    }

    public function create()
    {
        $this->logger->log('Creating stuff...');
    }
}