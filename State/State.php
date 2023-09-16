<?php

require_once __DIR__ . "/../Model/Income.php";
require_once __DIR__ . "/../Model/Expense.php";
require_once __DIR__ . "/../Storage/Storage.php";

class State implements JsonSerializable
{
    public bool $isRunning = true;

    public function __construct(private readonly Storage $storage,

    /**
     * @var array<Income>
     */
    private array $incomes = [],
    /**
     * @var array<Expense>
     */
    private array $expenses = [],
    /**
     * @var array<string>
     */
    private array $incomeCategories = ["Salary", "SideProjects"], // Default Categories for demo purpose
    /**
     * @var array<string>
     */
    private array $expenseCategories = ["Gift", "Food"], // Default Categories for demo purpose
    )
    {

    }


    /**
     * @throws Exception
     */
    function addIncome(Income $income): bool{
        if  (gettype(array_search($income->category, $this->incomeCategories)) != "integer")
            throw new Exception('Unknown category selected');
        $this->incomes[] = $income;
        $this->sync();
        return true;
    }

    /**
     * @throws Exception
     */
    function addIncomeCategory(string $category): void {
        if  (in_array($category, $this->incomeCategories)){
            throw new Exception('Category already exists');
        }
        $this->incomeCategories[] = $category;
        $this->sync();
    }

    /**
     * @throws Exception
     */
    function addExpense(Expense $expense): bool{
        if  (gettype(array_search($expense->category, $this->expenseCategories)) != "integer")
            throw new Exception('Unknown category selected');
        $this->expenses[] = $expense;
        $this->sync();
        return true;
    }

    /**
     * @throws Exception
     */
    function addExpenseCategory(string $category): bool {
        if  (in_array($category, $this->expenseCategories)){
            throw new Exception('Category already exists');
        }
        $this->expenseCategories[] = $category;
        $this->sync();
        return true;
    }
    /**
     * @return array<Income>
     */
    function getIncomes(): array{
        return $this->incomes;
    }

    /**
     * @return array<Expense>
     */
    function getExpenses(): array{
        return $this->expenses;
    }

    /**
     * @return array<string>
     */
    public function getIncomeCategories(): array
    {
        return $this->incomeCategories;
    }

    /**
     * @return array<string>
     */
    public function getExpenseCategories(): array
    {
        return $this->expenseCategories;
    }


    function totalExpense(): int {
        return array_reduce($this->expenses, fn ($ax, $expense) => $ax + $expense->money, 0);
    }

    function totalIncome(): int {
        return array_reduce($this->incomes, fn ($ax, $income) => $ax + $income->money, 0);
    }

    function getWalletMoney(): int{
        return $this->totalIncome() - $this->totalExpense();
    }


    private function sync(): void {
        $this->storage->write($this);
    }

    function shutdown(): void
    {
        $this->isRunning = false;
    }

    public function jsonSerialize(): array
    {
        return [
            "incomes" => $this->incomes,
            "expenses" => $this->expenses,
            "incomeCategories" => $this->incomeCategories,
            "expenseCategories" => $this->expenseCategories
        ];
    }


}