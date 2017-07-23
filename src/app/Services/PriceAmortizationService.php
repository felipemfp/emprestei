<?php

namespace App\Services;

use App\Contracts\AmortizationService;
use App\Models\Payment;

class PriceAmortizationService implements AmortizationService
{
  public function calculate($value, $loadPeriod, $interestRate)
  {
      $payments = [];
      $parcelTotal = 0;
      $interestTotal = 0;
      $amortizationTotal = 0;

      $balanceDue = $value;

      $payment = new Payment;

      $payment->period = 0;
      $payment->amountOwned = $balanceDue;

      array_push($payments, $payment);

      for ($i=0; $i < $loadPeriod; $i++) {
        $payment = new Payment;

        $payment->period = $i + 1;
        $payment->parcel = ($balanceDue * $interestRate)/(1 - (1 / pow(1 + $interestRate, $loadPeriod - $i)));
        $payment->interest = $interestRate * $balanceDue;
        $payment->amortization = $payment->parcel - $payment->interest;
        $payment->amountOwned = $balanceDue - $payment->amortization;

        $balanceDue = $balanceDue - $payment->amortization;

        array_push($payments, $payment);
        $parcelTotal += $payment->parcel;
        $interestTotal += $payment->interest;
        $amortizationTotal += $payment->amortization;
      }

      return [
        'payments' => $payments,
        'parcelTotal' => $parcelTotal,
        'interestTotal' => $interestTotal,
        'amortizationTotal' => $amortizationTotal
      ];
  }
}

?>
