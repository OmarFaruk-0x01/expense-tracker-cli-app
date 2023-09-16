<?php

abstract class Feature
{

    public function __construct(protected State $state, protected View $view)
    {
    }

    abstract function label(): string;

    function preRun(): void{
        printf("\n$$ {$this->label()} $$\n\n");
    }

    abstract function run(): void;

    function postRun(): void
    {
        printf("\n");
    }
}