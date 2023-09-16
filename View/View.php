<?php

require_once __DIR__ . "/../Feature/Feature.php";

enum MessageType {
    case Success;
    case Failed;
    case Normal;
}


interface View
{
    function preRender();

    public function renderHeader(): void;

    public function renderMessage(string $message, MessageType $type): void;

    /**
     * @param array $list
     * @param Closure<string> $callback
     * @return void
     */
    public function renderList(array $list, Closure $callback): void;

    public function getInput(string $placeholder): string;

}