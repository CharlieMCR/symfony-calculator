<?php

declare(strict_types=1);

namespace App\Tests\Calculator;

use App\Calculator\CalculatorDivisionOperation;
use App\Calculator\CalculatorOperationInterface;
use App\Calculator\Exception\CalculatorOperationException;
use PHPUnit\Framework\TestCase;

class CalculatorDivisionOperationTest extends CalculatorOperationTest
{
    public function calculateDataProvider(): array
    {
        return [
            'case 1' => [
                'x' => (float)1,
                'y' => (float)1,
                'result' => (float)1,
            ],
            'case 2' => [
                'x' => (float)2,
                'y' => (float)1,
                'result' => (float)2,
            ],
            'case 3' => [
                'x' => (float)15,
                'y' => (float)7,
                'result' => 2.1428571428571,
            ],
            'case 4' => [
                'x' => (float)12345678901,
                'y' => (float)5,
                'result' => 2469135780.2,
            ],
            'case 5' => [
                'x' => 456.456,
                'y' => 754.6,
                'result' => 0.60489795918367,
            ],
        ];
    }

    public function testCalculateDivisionByZero(): void
    {
        $this->expectException(CalculatorOperationException::class);
        $this->expectExceptionMessage('Division by zero');
        $calculator = $this->getCalculatorOperation();
        $calculator->calculate(10, 0.0);
    }

    protected function getCalculatorOperation(): CalculatorOperationInterface
    {
        return new CalculatorDivisionOperation();
    }
}
