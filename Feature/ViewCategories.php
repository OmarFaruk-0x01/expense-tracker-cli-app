<?php

class ViewCategories extends Feature
{
    function label(): string
    {
        return "View Categories";
    }

    function run(): void
    {
        $this->view->renderMessage("Income Categories:\n");
        $this->view->renderList($this->state->getIncomeCategories(),
            fn ($category, $key) => sprintf("%s. $category\n", $key+1));

        $this->view->renderMessage("\n");

        $this->view->renderMessage("Expense Categories:\n");
        $this->view->renderList($this->state->getExpenseCategories(),
            fn ($category, $key) => sprintf("%s. $category\n", $key+1));
    }

}