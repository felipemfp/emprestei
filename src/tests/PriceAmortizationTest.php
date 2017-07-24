<?php

use App\Models\Payment;
use App\Services\PriceAmortizationService;

class PriceAmortizationTest extends TestCase
{
    private $priceAmortizationService;

    public function testPriceAmortizationService()
    {
        $this->priceAmortizationService = new PriceAmortizationService;
        $expectsPayments = [
            new Payment(0, 0, 0, 0, 1000),
            new Payment(1, 269.03, 30, 239.03, 760.97),
            new Payment(2, 269.03, 22.83, 246.20, 514.77),
            new Payment(3, 269.03, 15.45, 253.58, 261.19),
            new Payment(4, 269.03, 7.84, 261.19, 0)
        ];

        $resultPayments = $this->priceAmortizationService->calculate(1000, 4, 0.03);

        $this->assertEquals($expectsPayments, $resultPayments);
    }
}
?>
