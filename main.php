#!/usr/bin/env php
<?php
require_once __DIR__ . "/Storage/FileStorage.php";
require_once __DIR__ . "/View/ConsoleView.php";
require_once __DIR__ . "/Feature/AddIncome.php";
require_once __DIR__ . "/Feature/ViewIncome.php";
require_once __DIR__ . "/Feature/ViewExpense.php";
require_once __DIR__ . "/Feature/AddExpense.php";
require_once __DIR__ . "/Feature/AddCategory.php";
require_once __DIR__ . "/Feature/ViewCategories.php";
require_once __DIR__ . "/Feature/ExitApp.php";
require_once __DIR__ . "/Kernel/Kernel.php";

$storage = new FileStorage("./db.json");
$data = $storage->load();

$state = new State($storage,
                incomes: $data->incomes ?? [],
                expenses: $data->expenses ?? [],
                incomeCategories: $data->incomeCategories ?? [],
                expenseCategories: $data->expenseCategories ?? []);

$view = new ConsoleView($state);

$app = new Kernel($state, $view);

$app->registerCommand(1, new AddCategory($state, $view));
$app->registerCommand(2, new ViewCategories($state, $view));
$app->registerCommand(3, new AddIncome($state, $view));
$app->registerCommand(4, new ViewIncome($state, $view));
$app->registerCommand(5, new AddExpense($state, $view));
$app->registerCommand(6, new ViewExpense($state, $view));
$app->registerCommand(7, new ExitApp($state, $view));


$app->run();