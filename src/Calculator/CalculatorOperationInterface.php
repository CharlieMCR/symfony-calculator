<?php

declare(strict_types=1);

namespace App\Calculator;

interface CalculatorOperationInterface
{
    public function calculate(float $x, float $y): float;
}
