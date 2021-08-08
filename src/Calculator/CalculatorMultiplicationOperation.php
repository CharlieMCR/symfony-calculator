<?php

declare(strict_types=1);

namespace App\Calculator;

class CalculatorMultiplicationOperation implements CalculatorOperationInterface
{
    public function calculate(float $x, float $y): float
    {
        return $x * $y;
    }
}
