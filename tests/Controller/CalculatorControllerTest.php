<?php

declare(strict_types=1);

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CalculatorControllerTest extends WebTestCase
{
    public function testCalculate(): void
    {
        $client = static::createClient();

        //
        $client->request('GET', '/calculator');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('[for="calculator_form_argument1"]', 'Argument 1');
        $this->assertSelectorTextContains('[for="calculator_form_argument2"]', 'Argument 2');
        $this->assertSelectorTextContains('[for="calculator_form_operand"]', 'Operand');

        $client->submitForm(
            'calculator_form_Calculate',
            [
                'calculator_form[argument1]' => 5,
                'calculator_form[operand]' => '+',
                'calculator_form[argument2]' => 5,
            ]
        );

        $this->assertSelectorTextContains('.result', '10');

        // TODO add test cases for error handling
        $client->submitForm(
            'calculator_form_Calculate',
            [
                'calculator_form[argument1]' => 5,
                'calculator_form[operand]' => '/',
                'calculator_form[argument2]' => 0,
            ]
        );

        $this->assertSelectorTextContains('.error', 'Division by zero');
    }
}
