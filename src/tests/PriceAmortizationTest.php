<?php

use App\Models\Payment;
use App\Services\PriceAmortizationService;

class PriceAmortizationTest extends TestCase
{
    private $priceAmortizationService;

    public function setUp()
    {
        parent::setUp();
        $this->priceAmortizationService = new PriceAmortizationService;
    }

    public function testPriceAmortizationService()
    {
        $expectsPayments = [
            new Payment(0, 0, 0, 0, 1000),
            new Payment(1, 269.03, 30, 239.03, 760.97),
            new Payment(2, 269.03, 22.83, 246.20, 514.77),
            new Payment(3, 269.03, 15.45, 253.58, 261.19),
            new Payment(4, 269.03, 7.84, 261.19, 0)
        ];

        $resultPayments = $this->priceAmortizationService->calculate(1000, 4, 0.03);

        for ($i=0; $i < count($expectsPayments); $i++) {
          $this->assertEquals($expectsPayments[$i]->period, $resultPayments[$i]->period);
          $this->assertEquals($expectsPayments[$i]->parcel, $resultPayments[$i]->parcel, '', 0.01);
          $this->assertEquals($expectsPayments[$i]->interest, $resultPayments[$i]->interest, '', 0.01);
          $this->assertEquals($expectsPayments[$i]->amortization, $resultPayments[$i]->amortization, '', 0.01);
          $this->assertEquals($expectsPayments[$i]->amountOwned, $resultPayments[$i]->amountOwned, '', 0.01);
        }
    }

    public function testPriceAmortizationServiceValueException()
    {
        $this->expectException(InvalidArgumentException::class);

        $resultPayments = $this->priceAmortizationService->calculate(-12, 12, 0.01);
    }

    public function testPriceAmortizationServiceLoadPeriodException()
    {
        $this->expectException(InvalidArgumentException::class);

        $resultPayments = $this->priceAmortizationService->calculate(12, -12, 0.01);
    }

    public function testPriceAmortizationServiceInterestRateException()
    {
        $this->expectException(InvalidArgumentException::class);

        $resultPayments = $this->priceAmortizationService->calculate(12, 12, -0.01);
    }
}
