<?php

namespace App\Services;

use App\Contracts\AmortizationService;
use App\Models\Payment;

class ConstantAmortizationService implements AmortizationService
{

  public function calculate($value, $loadPeriod, $interestRate)
  {
      $payments = [];

      $balanceDue = $value;
      $amortization = $value / $loadPeriod;

      $payment = new Payment(0,0,0,0, $balanceDue);

      array_push($payments, $payment);

      for ($i=0; $i < $loadPeriod; $i++) {

        $period = $i + 1;
        $interest = $interestRate * $balanceDue;
        $parcel = $amortization + $interest;
        $amortization = $parcel - $interest;
        $amountOwned = $balanceDue - $amortization;

        $balanceDue -= $amortization;

        $payment = new Payment($period, $parcel, $interest, $amortization, $amountOwned);
        array_push($payments, $payment);
      }

      return $payments;
  }
}

?>
