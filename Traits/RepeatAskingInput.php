<?php
require_once __DIR__ . '/../View/View.php';


trait RepeatAskingInput
{
    protected View $view;

    /**
     * @param string $placeholder
     * @param Closure $closure
     * @return string
     */
    function repeatAsking(string $placeholder, Closure $closure): string
    {
        $input = $this->view->getInput($placeholder);
        while ($closure($input)){
            $this->view->renderMessage("Wrong input!!\n", MessageType::Failed);
            $input = $this->view->getInput($placeholder);
        }
        return $input;
    }

}