<?php

require_once __DIR__ . "/../View/View.php";
readonly class ConsoleView implements View
{
    public function __construct(private State $state)
    {
    }

    public function preRender(): void
    {
        system("clear");
    }

    public function renderHeader(): void
    {
        printf("======================================================\n");
        printf("Your Wallet: {$this->state->getWalletMoney()} BDT\n");
        printf("Total Income: {$this->state->totalIncome()} BDT\n");
        printf("Total Expense: {$this->state->totalExpense()} BDT\n");
        printf("======================================================\n");
    }

    public function renderMessage(string $message, MessageType $type = MessageType::Normal): void
    {
        if ($type == MessageType::Success){
            $message = "[√] $message";
        }else if ($type == MessageType::Failed){
            $message = "[x] $message";
        }
        printf($message);
    }


    public function renderList($list, $callback): void
    {
        foreach ($list as $key => $item){
            $this->renderMessage($callback($item, $key));
        }
    }

    public function getInput($placeholder): string
    {
        return readline($placeholder);
    }
}