<?php

namespace App\Services;

use App\Contracts\AmortizationService;
use App\Models\Payment;

class AmericanAmortizationService implements AmortizationService
{

  public function calculate($value, $loadPeriod, $interestRate)
  {
      $payments = [];

      $balanceDue = $value;

      $payment = new Payment(0, 0, 0, 0, $balanceDue);

      array_push($payments, $payment);

      for ($i=0; $i < $loadPeriod - 1; $i++) {

        $period = $i + 1;
        $interest = $interestRate * $balanceDue;
        $parcel = $interest;
        $amortization = 0;
        $amountOwned = $balanceDue - $payment->amortization;

        $payment = new Payment($period, $parcel, $interest, $amortization, $amountOwned);
        array_push($payments, $payment);
      }

      $period = $loadPeriod;
      $interest = $interestRate * $balanceDue;
      $parcel = $value + $payment->interest;
      $amortization = $value;
      $amountOwned = 0;

      $payment = new Payment($period, $parcel, $interest, $amortization, $amountOwned);
      array_push($payments, $payment);

      return $payments;
  }
}

?>
