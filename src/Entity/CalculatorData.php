<?php

declare(strict_types=1);

namespace App\Entity;

class CalculatorData
{
    private float $argument1;

    private float $argument2;

    private OperandEnum $operand;

    public function __construct(float $argument1, float $argument2, OperandEnum $operandEnum)
    {
        $this->argument1 = $argument1;
        $this->argument2 = $argument2;
        $this->operand = $operandEnum;
    }

    public function getArgument1(): float
    {
        return $this->argument1;
    }

    public function getArgument2(): float
    {
        return $this->argument2;
    }

    public function getOperand(): OperandEnum
    {
        return $this->operand;
    }
}
