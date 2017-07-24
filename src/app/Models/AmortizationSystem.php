<?php

namespace App\Models;

class AmortizationSystem
{
   const SYSTEM_AMERICAN = 1;
   const SYSTEM_PRICE = 2;
   const SYSTEM_SAC = 3;
   
   const SYSTEM = [
     AmortizationSystem::SYSTEM_AMERICAN => 'Americano',
     AmortizationSystem::SYSTEM_PRICE => 'Price',
     AmortizationSystem::SYSTEM_SAC => 'SAC',
   ];
}