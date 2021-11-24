<?php

namespace Container;

class File
{
    public function write(string $message)
    {
        echo "Writing '$message' to a file\r\n";
    }
}