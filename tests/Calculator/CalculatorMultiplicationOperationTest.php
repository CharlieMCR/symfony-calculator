<?php

declare(strict_types=1);

namespace App\Tests\Calculator;

use App\Calculator\CalculatorMultiplicationOperation;
use App\Calculator\CalculatorOperationInterface;
use PHPUnit\Framework\TestCase;

class CalculatorMultiplicationOperationTest extends CalculatorOperationTest
{
    public function calculateDataProvider(): array
    {
        return [
            'case 1' => [
                'x' => (float)1,
                'y' => (float)1,
                'result' => 1,
            ],
            'case 2' => [
                'x' => (float)2,
                'y' => (float)1,
                'result' => (float)2,
            ],
            'case 3' => [
                'x' => (float)956754,
                'y' => (float)352664,
                'result' => (float)337412692656,
            ],
            'case 4' => [
                'x' => 0.345,
                'y' => 2.84,
                'result' => 0.9798,
            ],
        ];
    }

    protected function getCalculatorOperation(): CalculatorOperationInterface
    {
        return new CalculatorMultiplicationOperation();
    }
}
