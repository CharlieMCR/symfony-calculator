<?php

declare(strict_types=1);

namespace App\Tests\Calculator;

use App\Calculator\CalculatorAdditionOperation;
use App\Calculator\CalculatorDivisionOperation;
use App\Calculator\CalculatorFactory;
use App\Calculator\CalculatorMultiplicationOperation;
use App\Calculator\CalculatorSubtractionOperation;
use App\Calculator\Exception\CalculatorOperationException;
use App\Entity\OperandEnum;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class CalculatorFactoryTest extends TestCase
{
    public function testCreate(): void
    {
        $additionReturn = (float)1;
        $subtractionReturn = (float)2;
        $multiplicationReturn = (float)3;
        $divisionReturn = (float)4;
        /** @var CalculatorAdditionOperation&MockObject $mockOperation */
        $mockAdditionOperation = $this->getMockBuilder(CalculatorAdditionOperation::class)
            ->getMock();
        $mockAdditionOperation->expects($this->once())
            ->method('calculate')
            ->willReturn($additionReturn);

        /** @var CalculatorSubtractionOperation&MockObject $mockOperation */
        $mockSubtractionOperation = $this->getMockBuilder(CalculatorSubtractionOperation::class)
            ->getMock();
        $mockSubtractionOperation->expects($this->once())
            ->method('calculate')
            ->willReturn($subtractionReturn);

        /** @var CalculatorMultiplicationOperation&MockObject $mockOperation */
        $mockMultiplicationOperation = $this->getMockBuilder(CalculatorMultiplicationOperation::class)
            ->getMock();
        $mockMultiplicationOperation->expects($this->once())
            ->method('calculate')
            ->willReturn($multiplicationReturn);

        /** @var CalculatorDivisionOperation&MockObject $mockOperation */
        $mockDivisionOperation = $this->getMockBuilder(CalculatorDivisionOperation::class)
            ->getMock();
        $mockDivisionOperation->expects($this->once())
            ->method('calculate')
            ->willReturn($divisionReturn);

        $factory = new CalculatorFactory(
            $mockAdditionOperation,
            $mockSubtractionOperation,
            $mockMultiplicationOperation,
            $mockDivisionOperation
        );

        $calculator = $factory->create(new OperandEnum(OperandEnum::ADDITION));
        $result = $calculator->solve(1, 2);
        $this->assertEquals($additionReturn, $result);

        $calculator = $factory->create(new OperandEnum(OperandEnum::SUBTRACTION));
        $result = $calculator->solve(1, 2);
        $this->assertEquals($subtractionReturn, $result);

        $calculator = $factory->create(new OperandEnum(OperandEnum::MULTIPLICATION));
        $result = $calculator->solve(1, 2);
        $this->assertEquals($multiplicationReturn, $result);

        $calculator = $factory->create(new OperandEnum(OperandEnum::DIVISION));
        $result = $calculator->solve(1, 2);
        $this->assertEquals($divisionReturn, $result);
        /** @var OperandEnum&MockObject $mockOperand */
        $mockOperand = $this->getMockBuilder(OperandEnum::class)
            ->disableOriginalConstructor()
            ->getMock();

        $mockOperand->expects($this->any())
            ->method('getValue')
            ->willReturn(__METHOD__);

        $this->expectException(CalculatorOperationException::class);
        $factory->create($mockOperand);
    }
}
