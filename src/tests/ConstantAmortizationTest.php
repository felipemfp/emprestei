<?php

use App\Models\Payment;
use App\Services\ConstantAmortizationService;

class ConstantAmortizationTest extends TestCase
{
    private $constantAmortizationService;

    public function testConstantAmortizationService()
    {
        $this->constantAmortizationService = new ConstantAmortizationService;
        $expectsPayments = [
            new Payment(0, 0, 0, 0, 120000),
            new Payment(1, 11200, 1200, 10000, 110000),
            new Payment(2, 11100, 1100, 10000, 100000),
            new Payment(3, 11000, 1000, 10000, 90000),
            new Payment(4, 10900, 900, 10000, 80000),
            new Payment(5, 10800, 800, 10000, 70000),
            new Payment(6, 10700, 700, 10000, 60000),
            new Payment(7, 10600, 600, 10000, 50000),
            new Payment(8, 10500, 500, 10000, 40000),
            new Payment(9, 10400, 400, 10000, 30000),
            new Payment(10, 10300, 300, 10000, 20000),
            new Payment(11, 10200, 200, 10000, 10000),
            new Payment(12, 10100, 100, 10000, 0)
        ];

        $resultPayments = $this->constantAmortizationService->calculate(120000, 12, 0.01);

        $this->assertEquals($expectsPayments, $resultPayments);
    }
}
?>
