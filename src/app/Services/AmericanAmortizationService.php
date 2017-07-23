<?php

namespace App\Services;

use App\Contracts\AmortizationService;
use App\Models\Payment;

class AmericanAmortizationService implements AmortizationService
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

      for ($i=0; $i < $loadPeriod - 1; $i++) {
        $payment = new Payment;

        $payment->period = $i + 1;
        $payment->interest = $interestRate * $balanceDue;
        $payment->parcel = $payment->interest;
        $payment->amortization = 0;
        $payment->amountOwned = $balanceDue - $payment->amortization;

        array_push($payments, $payment);
        $parcelTotal += $payment->parcel;
        $interestTotal += $payment->interest;
        $amortizationTotal += $payment->amortization;
      }

      $payment = new Payment;

      $payment->period = $loadPeriod;
      $payment->interest = $interestRate * $balanceDue;
      $payment->parcel = $value + $payment->interest;
      $payment->amortization = $value;
      $payment->amountOwned = 0;

      array_push($payments, $payment);
      $parcelTotal += $payment->parcel;
      $interestTotal += $payment->interest;
      $amortizationTotal += $payment->amortization;

      return [
        'payments' => $payments,
        'parcelTotal' => $parcelTotal,
        'interestTotal' => $interestTotal,
        'amortizationTotal' => $amortizationTotal
      ];
  }
}

?>
