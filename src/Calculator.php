<?php

namespace BrianFaust\TaxCalculator;

class Calculator
{
    /**
     * @var int
     */
    private $amount;

    /**
     * @var string
     */
    private $currency;

    /**
     * @var string
     */
    private $locale;

    /**
     * @var float
     */
    private $taxRate;

    /**
     * @var float
     */
    private $discount = 0;

    /**
     * @param string $currency
     * @param string $locale
     * @param int    $taxRate
     */
    public function __construct(string $currency = 'USD', string $locale = 'en', float $taxRate = 0)
    {
        $this->setTaxRate($taxRate);
        $this->setCurrency($currency);
        $this->setLocale($locale);
    }

    /**
     * @param int $value
     *
     * @return \BrianFaust\TaxCalculator\Calculator
     */
    public function setAmount(int $value) : Calculator
    {
        $this->amount = $value * 100;

        return $this;
    }

    /**
     * @return int
     */
    public function getAmount() : integer
    {
        return $this->amount;
    }

    /**
     * @param float $value
     *
     * @return \BrianFaust\TaxCalculator\Calculator
     */
    public function setTaxRate(float $value) : Calculator
    {
        $this->taxRate = $value / 100;

        return $this;
    }

    /**
     * @return float
     */
    public function getTaxRate() : float
    {
        return $this->taxRate;
    }

    /**
     * @param string $value
     *
     * @return \BrianFaust\TaxCalculator\Calculator
     */
    public function setCurrency(string $value) : Calculator
    {
        $this->currency = $value;

        return $this;
    }

    /**
     * @return string
     */
    public function getCurrency() : string
    {
        return $this->currency;
    }

    /**
     * @param string $value
     *
     * @return \BrianFaust\TaxCalculator\Calculator
     */
    public function setLocale(string $value) : Calculator
    {
        $this->locale = $value;

        return $this;
    }

    /**
     * @return string
     */
    public function getLocale() : string
    {
        return $this->locale;
    }

    /**
     * @param float $value
     *
     * @return \BrianFaust\TaxCalculator\Calculator
     */
    public function setDiscount(float $value) : Calculator
    {
        $this->discount = $value / 100;

        return $this;
    }

    /**
     * @return float
     */
    public function getDiscount() : float
    {
        return $this->discount;
    }

    /**
     * @return \BrianFaust\TaxCalculator\Money
     */
    public function subtotal() : Money
    {
        return $this->toMoney($this->amount);
    }

    /**
     * @return \BrianFaust\TaxCalculator\Money
     */
    public function discount() : Money
    {
        $amount = $this->subtotal()->getAmount() * $this->discount;

        return $this->toMoney($amount);
    }

    /**
     * @return float
     */
    public function taxRate() : float
    {
        return $this->taxRate;
    }

    /**
     * @return \BrianFaust\TaxCalculator\Money
     */
    public function taxValue() : Money
    {
        $amount = ($this->subtotal()->getAmount() - $this->discount()->getAmount()) * $this->taxRate();

        return $this->toMoney($amount);
    }

    /**
     * @return \BrianFaust\TaxCalculator\Money
     */
    public function total() : Money
    {
        $amount = ($this->subtotal()->getAmount() - $this->discount()->getAmount()) + $this->taxvalue()->getAmount();

        return $this->toMoney($amount);
    }

    /**
     * @param int    $amount
     * @param string $currency
     *
     * @return \Money\Money
     */
    private function toMoney(int $amount)
    {
        return new Money($amount, $this->currency, $this->locale);
    }
}
