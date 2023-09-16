<?php

class ViewExpense extends Feature
{
    function label(): string
    {
        return 'View Expense';
    }

    function run(): void
    {
        $this->view->renderList($this->state->getExpenses(),
            fn ($expense, $index) => sprintf("%s. [%s] => %s BDT\n", $index + 1, $expense->category, $expense->money));
    }

    function postRun(): void
    {
        $this->view->renderMessage("\nTotal Expense: {$this->state->totalExpense()} BDT\n\n");
    }
}