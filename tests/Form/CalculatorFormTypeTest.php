<?php

declare(strict_types=1);

namespace App\Tests\Form;

use App\Entity\CalculatorData;
use App\Entity\OperandEnum;
use App\Form\CalculatorFormType;
use Symfony\Component\Form\Test\TypeTestCase;

class CalculatorFormTypeTest extends TypeTestCase
{
    public function testEmptyData(): void
    {
        $form = $this->factory->create(CalculatorFormType::class);
        $form->submit([]);
        /** @var CalculatorData $model */
        $model = $form->getData();

        $this->assertTrue($form->isSynchronized());
        $this->assertInstanceOf(CalculatorData::class, $model);

        $expected = new CalculatorData(0.0, 0.0, new OperandEnum(OperandEnum::ADDITION));
        $this->assertEquals($expected, $model);
    }

    /**
     * @param float $argument1
     * @param float $argument2
     * @param string $operand
     * @dataProvider submitValidDataProvider
     */
    public function testSubmitValidData(float $argument1, float $argument2, string $operand): void
    {
        $formData = [
            'argument1' => $argument1,
            'argument2' => $argument2,
            'operand' => $operand,
        ];

        $form = $this->factory->create(CalculatorFormType::class);

        $expected = new CalculatorData($argument1, $argument2, new OperandEnum($operand));

        $form->submit($formData);
        /** @var CalculatorData $model */
        $model = $form->getData();

        $this->assertTrue($form->isSynchronized());
        $this->assertInstanceOf(CalculatorData::class, $model);

        $this->assertEquals($expected, $model);
    }

    /**
     * @return array[]
     */
    public function submitValidDataProvider(): array
    {
        return [
            'case 1' => [
                'argument1' => 1,
                'argument2' => 2,
                'operand' => OperandEnum::ADDITION
            ],
            'case 2' => [
                'argument1' => 1,
                'argument2' => 2,
                'operand' => OperandEnum::SUBTRACTION
            ],
            'case 3' => [
                'argument1' => 1,
                'argument2' => 2,
                'operand' => OperandEnum::MULTIPLICATION
            ],
            'case 4' => [
                'argument1' => 1,
                'argument2' => 2,
                'operand' => OperandEnum::DIVISION
            ],
        ];
    }

    /**
     * @param mixed $argument1
     * @param mixed $argument2
     * @param mixed $operand
     * @dataProvider inValidDataProvider
     */
    public function testInValidData(mixed $argument1, mixed $argument2, mixed $operand): void
    {
        $formData = [
            'argument1' => $argument1,
            'argument2' => $argument2,
            'operand' => $operand,
        ];
        $form = $this->factory->create(CalculatorFormType::class);
        $form->submit($formData);

        $this->assertFalse($form->isValid());
    }

    public function inValidDataProvider(): array
    {
        return [
            'case 1' => [
                'argument1' => 'not a number',
                'argument2' => 2,
                'operand' => OperandEnum::ADDITION
            ],
            'case 2' => [
                'argument1' => 1,
                'argument2' => 2,
                'operand' => 'not an operand'
            ],
            'case 3' => [
                'argument1' => '£$%',
                'argument2' => 2,
                'operand' => OperandEnum::MULTIPLICATION
            ],
            'case 4' => [
                'argument1' => 1,
                'argument2' => 2,
                'operand' => '+-*/'
            ],
        ];
    }
}
