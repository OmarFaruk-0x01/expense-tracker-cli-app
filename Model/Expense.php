<?php

class Expense
{
    public function __construct(public int $money, public string $category)
    {
    }
}