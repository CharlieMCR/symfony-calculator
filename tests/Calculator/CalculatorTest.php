<?php

declare(strict_types=1);

namespace App\Tests\Calculator;

use App\Calculator\Calculator;
use App\Calculator\CalculatorOperationInterface;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class CalculatorTest extends TestCase
{
    public function testSolve(): void
    {
        $operationReturn = (float)5;
        /** @var CalculatorOperationInterface&MockObject $mockOperation */
        $mockOperation = $this->getMockBuilder(CalculatorOperationInterface::class)
            ->getMock();
        $mockOperation->expects($this->once())
            ->method('calculate')
            ->willReturn($operationReturn);

        $calculator = new Calculator($mockOperation);
        $result = $calculator->solve(3, 4);
        $this->assertEquals($operationReturn, $result);
    }
}
