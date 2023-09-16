<?php

require_once __DIR__ . "/../State/State.php";

readonly class FileStorage implements Storage
{
    public function __construct(private string $filename)
    {
        if (!file_exists($this->filename)){
            $this->write(new State($this));
        }
    }

    function write(State $state): void
    {
        file_put_contents($this->filename, json_encode($state));
    }

    public function load(): mixed
    {
        return json_decode(file_get_contents($this->filename));
    }
}