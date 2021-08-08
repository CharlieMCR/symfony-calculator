<?php

declare(strict_types=1);

namespace App\Tests\Calculator;

use App\Calculator\CalculatorOperationInterface;
use App\Calculator\CalculatorSubtractionOperation;

class CalculatorSubtractionOperationTest extends CalculatorOperationTest
{
    /**
     * @return array[]
     */
    public function calculateDataProvider(): array
    {
        return [
            'case 1' => [
                'x' => (float)1,
                'y' => (float)1,
                'result' => (float)0,
            ],
            'case 2' => [
                'x' => (float)2,
                'y' => (float)1,
                'result' => (float)1,
            ],
            'case 3' => [
                'x' => (float)0,
                'y' => (float)1,
                'result' => (float)-1,
            ],
            'case 4' => [
                'x' => (float)-64,
                'y' => (float)99,
                'result' => (float)-163,
            ],
        ];
    }

    protected function getCalculatorOperation(): CalculatorOperationInterface
    {
        return new CalculatorSubtractionOperation();
    }
}
