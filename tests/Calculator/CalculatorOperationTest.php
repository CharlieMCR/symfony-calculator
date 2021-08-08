<?php

declare(strict_types=1);

namespace App\Tests\Calculator;

use App\Calculator\CalculatorOperationInterface;
use PHPUnit\Framework\TestCase;

abstract class CalculatorOperationTest extends TestCase
{
    /**
     * @dataProvider calculateDataProvider
     */
    public function testCalculate(float $x, float $y, float $expectedResult): void
    {
        $calculator = $this->getCalculatorOperation();
        $result = $calculator->calculate($x, $y);
        $this->assertIsFloat($result);
        $this->assertEquals($expectedResult, $result);
    }

    abstract public function calculateDataProvider(): array;

    abstract protected function getCalculatorOperation(): CalculatorOperationInterface;
}
