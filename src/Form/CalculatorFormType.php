<?php

declare(strict_types=1);

namespace App\Form;

use App\Entity\CalculatorData;
use App\Entity\OperandEnum;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\DataMapperInterface;
use Symfony\Component\Form\Exception;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class CalculatorFormType extends AbstractType implements DataMapperInterface
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->add('argument1', NumberType::class, ['label' => 'Argument 1'])
            ->add('operand', ChoiceType::class, [
                'placeholder' => 'Choose an operand',
                'choices' => [
                    new OperandEnum(OperandEnum::ADDITION),
                    new OperandEnum(OperandEnum::SUBTRACTION),
                    new OperandEnum(OperandEnum::MULTIPLICATION),
                    new OperandEnum(OperandEnum::DIVISION),
                ],
                'choice_value' => 'value',
                'choice_label' => 'name',
            ])
            ->add('argument2', NumberType::class, ['label' => 'Argument 2'])
            ->add('Calculate', SubmitType::class)
            ->setDataMapper($this);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults(
            [
                'data_class' => CalculatorData::class,
                'empty_data' => function () {
                    return new CalculatorData(
                        (float)0,
                        (float)0,
                        new OperandEnum(OperandEnum::ADDITION)
                    );
                }
            ]
        );
    }

    /**
     * @param CalculatorData|mixed $viewData
     * @param FormInterface[]|\Traversable $forms
     */
    public function mapDataToForms($viewData, $forms): void
    {
        if (null === $viewData) {
            return;
        }

        if (!$viewData instanceof CalculatorData) {
            throw new Exception\UnexpectedTypeException($viewData, CalculatorData::class);
        }

        if ($forms instanceof \Traversable) {
            /** @var FormInterface[] $forms */
            $forms = iterator_to_array($forms);
        }

        $forms['argument1']->setData($viewData->getArgument1());
        $forms['operand']->setData($viewData->getOperand());
        $forms['argument2']->setData($viewData->getArgument2());
    }

    /**
     * @param FormInterface[]|\Traversable $forms
     * @param mixed $viewData
     */
    public function mapFormsToData($forms, &$viewData): void
    {
        if ($forms instanceof \Traversable) {
            /** @var FormInterface[] $forms */
            $forms = iterator_to_array($forms);
        }

        /** @var OperandEnum $operandEnum */
        $operandEnum = isset($forms['operand']) && $forms['operand']->getData() instanceof OperandEnum
            ? $forms['operand']->getData()
            : new OperandEnum(OperandEnum::ADDITION);
        $viewData = new CalculatorData(
            isset($forms['argument1']) && $forms['argument1']->getData()
                ? (float)$forms['argument1']->getData()
                : 0.0,
            isset($forms['argument2']) && $forms['argument2']->getData()
                ? (float)$forms['argument2']->getData()
                : 0.0,
            $operandEnum
        );
    }
}
