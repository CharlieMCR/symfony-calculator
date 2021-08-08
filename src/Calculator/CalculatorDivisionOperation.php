<?php

declare(strict_types=1);

namespace App\Calculator;

use App\Calculator\Exception\CalculatorOperationException;

class CalculatorDivisionOperation implements CalculatorOperationInterface
{
    public function calculate(float $x, float $y): float
    {
        if ($y === (float)0) {
            throw new CalculatorOperationException('Division by zero');
        }
        return $x / $y;
    }
}
