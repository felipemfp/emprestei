<?php

namespace App\Models;

class Payment
{
    private const DECIMAL_FIELDS_NUMBER = 2;

    public $period;
    public $parcel;
    public $interest;
    public $amortization;
    public $amountOwned;

    public function __construct($period, $parcel, $interest, $amortization, $amountOwned)
    {
      $this->period = round($period, Payment::DECIMAL_FIELDS_NUMBER);
      $this->parcel = round($parcel, Payment::DECIMAL_FIELDS_NUMBER);
      $this->interest = round($interest, Payment::DECIMAL_FIELDS_NUMBER);
      $this->amortization = round($amortization, Payment::DECIMAL_FIELDS_NUMBER);
      $this->amountOwned = round($amountOwned, Payment::DECIMAL_FIELDS_NUMBER);
    }
}

?>
