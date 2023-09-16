<?php

class ExitApp extends Feature
{

    function label(): string
    {
        return "Exit App.";
    }

    function run(): void
    {
        $this->state->shutdown();
    }

    public function preRun(): void
    {
    }

    public function postRun(): void
    {
        printf("\n\n[*] Good By. Take care of your money [*]\n\n");
    }
}