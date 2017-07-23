<?php

namespace App\Contracts;

interface AmortizationService
{
    public function calculate($value, $loadPeriod, $interestRate);
}

?>
