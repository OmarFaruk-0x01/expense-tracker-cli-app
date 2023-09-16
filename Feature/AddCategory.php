<?php

require_once __DIR__ . '/../Traits/RepeatAskingInput.php';

class AddCategory extends Feature
{
    use RepeatAskingInput;
    function label(): string
    {
        return "Add Category";
    }

    function run(): void
    {

        $category = $this->view->getInput("Enter Category: ");
        $type = $this->repeatAsking("[I]ncome / [E]xpense / [C]ancel: ",
            fn ($type) => strtolower($type) != 'i' && strtolower($type) != 'e' && strtolower($type) != 'c');

        try{
            if ($type == 'c') return;
            if ($type == 'i') $this->state->addIncomeCategory($category);
            if ($type == 'e') $this->state->addExpenseCategory($category);
            $this->view->renderMessage("Category Added\n", MessageType::Success);
        }catch (Exception  $e){
            $this->view->renderMessage("{$e->getMessage()}\n", MessageType::Failed);
            $this->run();
        }
    }

}