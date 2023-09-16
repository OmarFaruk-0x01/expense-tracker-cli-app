<?php

class ViewIncome extends Feature
{
    function label(): string
    {
        return "View Income";
    }

    function run(): void
    {
        $this->view->renderList($this->state->getIncomes(),
            fn ($income, $index) => sprintf("%s. [%s] => %s BDT\n", $index + 1, $income->category, $income->money));
    }

    function postRun(): void
    {
        printf("\nTotal Income: {$this->state->totalIncome()} BDT\n\n");
    }
}