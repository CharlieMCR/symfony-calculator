<?php

declare(strict_types=1);

namespace App\Calculator;

class Calculator
{
    private CalculatorOperationInterface $calculatorOperation;

    public function __construct(CalculatorOperationInterface $calculatorOperation)
    {
        $this->calculatorOperation = $calculatorOperation;
    }

    /**
     * Uses the injected operation to calculate a result
     */
    public function solve(float $x, float $y): float
    {
        return $this->calculatorOperation->calculate($x, $y);
    }
}
