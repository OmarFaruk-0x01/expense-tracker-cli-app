<?php

require_once __DIR__ . "/../State/State.php";

interface Storage
{
    function write(State $state): void;
    function load(): mixed;
}