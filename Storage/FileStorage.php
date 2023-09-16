<?php

require_once __DIR__ . "/../State/State.php";

readonly class FileStorage implements Storage
{
    public function __construct(private string $filename)
    {
    }

    function write(State $state): void
    {
        file_put_contents($this->filename, json_encode($state));
    }

    public function load(): State
    {
        $data = json_decode(file_get_contents($this->filename));

        return new State($this,
                incomes: $data->incomes ?? [],
                expenses: $data->expenses ?? [],
                incomeCategories: $data->incomeCategories ?? [],
                expenseCategories: $data->expenseCategories ?? []);
    }

}