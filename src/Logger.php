<?php

namespace Container;

class Logger
{
    public function __construct(private readonly File $file)
    {
    }

    public function log(string $message): void
    {
        echo "Logging\r\n";
        $this->file->write($message);
    }
}