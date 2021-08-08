<?php

declare(strict_types=1);

namespace App\Entity;

/**
 * A lightweight enum entity
 */
class OperandEnum
{
    public const ADDITION = '+';
    public const SUBTRACTION = '-';
    public const MULTIPLICATION = '*';
    public const DIVISION = '/';

    public const ADDITION_NAME = 'Addition';
    public const SUBTRACTION_NAME = 'Subtraction';
    public const MULTIPLICATION_NAME = 'Multiplication';
    public const DIVISION_NAME = 'Division';

    private const VALUE_TO_NAME_MAP = [
        self::ADDITION => self::ADDITION_NAME,
        self::SUBTRACTION => self::SUBTRACTION_NAME,
        self::MULTIPLICATION => self::MULTIPLICATION_NAME,
        self::DIVISION => self::DIVISION_NAME,
    ];

    private string $value;

    public function __construct(string $operand)
    {
        if (!isset(self::VALUE_TO_NAME_MAP[$operand])) {
            throw new \InvalidArgumentException('Invalid operand');
        }
        $this->value = $operand;
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function getName(): string
    {
        return self::VALUE_TO_NAME_MAP[$this->value];
    }
}
