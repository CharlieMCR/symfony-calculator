<?php

declare(strict_types=1);

namespace App\Calculator;

use App\Calculator\Exception\CalculatorOperationException;
use App\Entity\OperandEnum;

class CalculatorFactory
{
    private CalculatorAdditionOperation $additionOperation;
    private CalculatorSubtractionOperation $subtractionOperation;
    private CalculatorMultiplicationOperation $multiplicationOperation;
    private CalculatorDivisionOperation $divisionOperation;

    public function __construct(
        CalculatorAdditionOperation $additionOperation,
        CalculatorSubtractionOperation $subtractionOperation,
        CalculatorMultiplicationOperation $multiplicationOperation,
        CalculatorDivisionOperation $divisionOperation
    ) {
        $this->additionOperation = $additionOperation;
        $this->subtractionOperation = $subtractionOperation;
        $this->multiplicationOperation = $multiplicationOperation;
        $this->divisionOperation = $divisionOperation;
    }

    public function create(OperandEnum $operand): Calculator
    {
        return match ($operand->getValue()) {
            OperandEnum::ADDITION => new Calculator($this->additionOperation),
            OperandEnum::SUBTRACTION => new Calculator($this->subtractionOperation),
            OperandEnum::MULTIPLICATION => new Calculator($this->multiplicationOperation),
            OperandEnum::DIVISION => new Calculator($this->divisionOperation),
            default => throw new CalculatorOperationException('No Calculator Operation for ' . $operand->getValue()),
        };
    }
}
