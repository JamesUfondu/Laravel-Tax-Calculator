<?php

namespace BrianFaust\Tests\TaxCalculator\tests\Facades;

use GrahamCampbell\TestBenchCore\FacadeTrait;
use BrianFaust\Tests\TaxCalculator\AbstractTestCase;
use BrianFaust\TaxCalculator\Facades\TaxCalculator;
use BrianFaust\TaxCalculator\Calculator;

class TaxCalculatorTest extends AbstractTestCase
{
    use FacadeTrait;

    /**
     * Get the facade accessor.
     *
     * @return string
     */
    protected function getFacadeAccessor()
    {
        return 'tax-calculator';
    }

    /**
     * Get the facade class.
     *
     * @return string
     */
    protected function getFacadeClass()
    {
        return TaxCalculator::class;
    }

    /**
     * Get the facade root.
     *
     * @return string
     */
    protected function getFacadeRoot()
    {
        return Calculator::class;
    }
}