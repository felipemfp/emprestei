<?php

use App\Models\Payment;

class PaymentTest extends TestCase
{
    public function testPaymentConstructor()
    {
        $payment = new Payment(5, 1602, 350, 1252, 15700);

        $this->assertEquals($payment->period, 5);
        $this->assertEquals($payment->parcel, 1602);
        $this->assertEquals($payment->interest, 350);
        $this->assertEquals($payment->amortization, 1252);
        $this->assertEquals($payment->amountOwned, 15700);
    }
}
?>
