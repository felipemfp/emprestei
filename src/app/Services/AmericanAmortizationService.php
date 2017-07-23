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

      $payment = new Payment(0, 0, 0, 0, $balanceDue);

      array_push($payments, $payment);

      for ($i=0; $i < $loadPeriod - 1; $i++) {

        $period = $i + 1;
        $interest = $interestRate * $balanceDue;
        $parcel = $payment->interest;
        $amortization = 0;
        $amountOwned = $balanceDue - $payment->amortization;

        $payment = new Payment($period, $parcel, $interest, $amortization, $amountOwned);
        array_push($payments, $payment);

        $parcelTotal += $payment->parcel;
        $interestTotal += $payment->interest;
        $amortizationTotal += $payment->amortization;
      }

      $period = $loadPeriod;
      $interest = $interestRate * $balanceDue;
      $parcel = $value + $payment->interest;
      $amortization = $value;
      $amountOwned = 0;

      $payment = new Payment($period, $parcel, $interest, $amortization, $amountOwned);
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
