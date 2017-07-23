<?php

namespace App\Services;

use App\Contracts\AmortizationService;
use App\Models\Payment;

class ConstantAmortizationService implements AmortizationService
{

  public function calculate($value, $loadPeriod, $interestRate)
  {
      $payments = [];
      $parcelTotal = 0;
      $interestTotal = 0;
      $amortizationTotal = 0;

      $balanceDue = $value;
      $amortization = $value / $loadPeriod;

      $payment = new Payment;

      $payment->period = 0;
      $payment->amountOwned = $balanceDue;

      array_push($payments, $payment);

      for ($i=0; $i < $loadPeriod; $i++) {
        $payment = new Payment;

        $payment->period = $i + 1;
        $payment->interest = $interestRate * $balanceDue;
        $payment->parcel = $amortization + $payment->interest;
        $payment->amortization = $payment->parcel - $payment->interest;
        $payment->amountOwned = $balanceDue - $payment->amortization;

        $balanceDue -= $payment->amortization;

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
