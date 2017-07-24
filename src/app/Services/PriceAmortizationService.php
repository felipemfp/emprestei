<?php

namespace App\Services;

use App\Contracts\AmortizationService;
use App\Models\Payment;

class PriceAmortizationService implements AmortizationService
{
  public function calculate($value, $loadPeriod, $interestRate)
  {
      $payments = [];

      if ($value < 0) {
        throw new \InvalidArgumentException('$value should be greater than zero.');
      }
      if ($loadPeriod < 0) {
        throw new \InvalidArgumentException('$loadPeriod should be greater than zero.');
      }
      if ($interestRate < 0) {
        throw new \InvalidArgumentException('$interestRate should be greater than zero.');
      }

      $balanceDue = $value;

      $payment = new Payment(0,0,0,0, $balanceDue);
      array_push($payments, $payment);

      for ($i=0; $i < $loadPeriod; $i++) {
        $period = $i + 1;
        $parcel = $balanceDue * $interestRate / (1 - (1 / pow(1 + $interestRate, $loadPeriod - $i)));
        $interest = $interestRate * $balanceDue;
        $amortization = $parcel - $interest;
        $amountOwned = $balanceDue - $amortization;

        $balanceDue -= $amortization;

        $payment = new Payment($period, $parcel, $interest, $amortization, $amountOwned);
        array_push($payments, $payment);
      }

      return $payments;
  }
}
