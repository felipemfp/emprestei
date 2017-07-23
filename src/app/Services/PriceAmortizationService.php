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

      $payment = new Payment(0,0,0,0, $balanceDue);
      array_push($payments, $payment);

      for ($i=0; $i < $loadPeriod; $i++) {

        $period = $i + 1;
        $parcel = $balanceDue * $interestRate / (1 - (1 / pow(1 + $interestRate, $loadPeriod - $i)));
        $interest = $interestRate * $balanceDue;
        $amortization = $parcel - $interest;
        $amountOwned = $balanceDue - $amortization;

        $balanceDue = $balanceDue - $amortization;

        $payment = new Payment($period, $parcel, $interest, $amortization, $amountOwned);
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
