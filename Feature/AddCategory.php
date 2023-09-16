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
        $type = $this->repeatAsking("[I]ncome / [E]xpense: ",
            fn ($type) => strtolower($type) != 'i' && strtolower($type) != 'e');

        try{
            if ($type == 'i') $this->state->addIncomeCategory($category);
            if ($type == 'e') $this->state->addExpenseCategory($category);
            $this->view->renderMessage("Category Added\n", MessageType::Success);
        }catch (Exception  $e){
            $this->view->renderMessage(sprintf('%s\n', $e->getMessage()), MessageType::Failed);
        }
    }

}