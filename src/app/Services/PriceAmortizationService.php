<?php

namespace App\Services;

use App\Contracts\AmortizationService;
use App\Models\Payment;

class PriceAmortizationService implements AmortizationService
{
  public function calculate($value, $loadPeriod, $interestRate)
  {
      $payments = [];

      $balanceDue = $value;

      $payment = new Payment(0,0,0,0, $balanceDue);
      array_push($payments, $payment);

      for ($i=0; $i < $loadPeriod; $i++) {

        $period = $i + 1;
        $parcel = round($balanceDue * $interestRate / (1 - (1 / pow(1 + $interestRate, $loadPeriod - $i))), 2);
        $interest = round($interestRate * $balanceDue, 2);
        $amortization = round($parcel - $interest, 2);
        $amountOwned = round($balanceDue - $amortization, 2);

        $balanceDue = $balanceDue - $amortization;

        $payment = new Payment($period, $parcel, $interest, $amortization, $amountOwned);
        array_push($payments, $payment);
      }

      return $payments;
  }
}

?>
