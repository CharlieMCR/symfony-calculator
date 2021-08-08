<?php

declare(strict_types=1);

namespace App\Tests\Calculator;

use App\Calculator\CalculatorAdditionOperation;
use App\Calculator\CalculatorOperationInterface;
use PHPUnit\Framework\TestCase;

class CalculatorAdditionOperationTest extends CalculatorOperationTest
{
    public function calculateDataProvider(): array
    {
        return [
            'case 1' => [
                'x' => (float)1,
                'y' => (float)1,
                'result' => 2.0,
            ],
            'case 2' => [
                'x' => (float)2,
                'y' => (float)1,
                'result' => (float)3,
            ],
            'case 3' => [
                'x' => (float)-12,
                'y' => (float)100,
                'result' => (float)88,
            ],
            'case 4' => [
                'x' => (float)24,
                'y' => (float)-76,
                'result' => (float)-52,
            ],
            'case 5' => [
                'x' => 1E-8,
                'y' => 1E-6,
                'result' => 1.01E-6,
            ],
        ];
    }

    protected function getCalculatorOperation(): CalculatorOperationInterface
    {
        return new CalculatorAdditionOperation();
    }
}
