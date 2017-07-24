<?php

use App\Models\Payment;
use App\Services\AmericanAmortizationService;

class AmericanAmortizationTest extends TestCase
{
    private $americanAmortizationService;

    public function testAmericanAmortizationService()
    {
        $this->americanAmortizationService = new AmericanAmortizationService;
        $expectsPayments = [
            new Payment(0, 0, 0, 0, 13000),
            new Payment(1, 1170, 1170, 0, 13000),
            new Payment(2, 1170, 1170, 0, 13000),
            new Payment(3, 1170, 1170, 0, 13000),
            new Payment(4, 1170, 1170, 0, 13000),
            new Payment(5, 1170, 1170, 0, 13000),
            new Payment(6, 1170, 1170, 0, 13000),
            new Payment(7, 1170, 1170, 0, 13000),
            new Payment(8, 1170, 1170, 0, 13000),
            new Payment(9, 1170, 1170, 0, 13000),
            new Payment(10, 1170, 1170, 0, 13000),
            new Payment(11, 1170, 1170, 0, 13000),
            new Payment(12, 14170, 1170, 13000, 0)
        ];

        $resultPayments = $this->americanAmortizationService->calculate(13000, 12, 0.09);

        $this->assertEquals($expectsPayments, $resultPayments);
    }
}
