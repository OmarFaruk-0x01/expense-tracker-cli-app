<?php
require_once __DIR__ . "/Feature.php";
require_once __DIR__ . "/../Traits/RepeatAskingInput.php";
class AddExpense extends Feature
{
    use RepeatAskingInput;
    function label(): string
    {
        return "Add Expense";
    }
    function run(): void
    {
        $money = $this->repeatAsking("Enter Money: ", fn ($money) => (int) $money == 0);
        $categories = $this->state->getExpenseCategories();
        $this->view->renderList($categories, fn ($category, $index) => sprintf("%s. $category\n", $index+1));

        $category = (int) $this->repeatAsking(placeholder: "Enter Number: ",
           closure: fn ($input) => (int) $input <= 0 || (int) $input > count($categories)) - 1;

        try {
            $this->state->addExpense(new Expense($money, $categories[$category]));
            $this->view->renderMessage("$money BDT Added to your Expense List on $categories[$category]", MessageType::Success);
        }catch (Exception $e){
            $this->view->renderMessage("{$e->getMessage()}!!\n", MessageType::Failed);
        }
    }




}