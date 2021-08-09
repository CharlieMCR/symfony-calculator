<?php

declare(strict_types=1);

namespace App\Controller;

use App\Calculator\CalculatorFactory;
use App\Calculator\Exception\CalculatorOperationException;
use App\Entity\CalculatorData;
use App\Form\CalculatorFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CalculatorController extends AbstractController
{
    /**
     * @Route("/calculator", name="calculator")
     * @param Request $request
     */
    public function calculate(Request $request, CalculatorFactory $calculatorFactory): Response
    {
        $form = $this->createForm(CalculatorFormType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try {
                /** @var CalculatorData $calculatorData */
                $calculatorData = $form->getData();
                $calculator = $calculatorFactory->create($calculatorData->getOperand());
                $result = $calculator->solve($calculatorData->getArgument1(), $calculatorData->getArgument2());
                $this->addFlash('success', 'Result: ' . $result);
            } catch (CalculatorOperationException $e) {
                $this->addFlash('error', $e->getMessage());
            }
        }
        return $this->render('calculator/calculator.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
