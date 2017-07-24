<?php

namespace App\Models;

class Payment
{
    public $period;
    public $parcel;
    public $interest;
    public $amortization;
    public $amountOwned;

    public function __construct($period, $parcel, $interest, $amortization, $amountOwned)
    {
      $this->period = $period;
      $this->parcel = $parcel;
      $this->interest = $interest;
      $this->amortization = $amortization;
      $this->amountOwned = $amountOwned;
    }
}
