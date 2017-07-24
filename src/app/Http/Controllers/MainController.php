<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AmortizationSystem;

use App\Services\ConstantAmortizationService;
use App\Services\PriceAmortizationService;
use App\Services\AmericanAmortizationService;

class MainController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
    */
    private $constantAmortizationService;
    private $priceAmortizationService;
    private $americanAmortizationService;

    public function __construct(
      ConstantAmortizationService $constantAmortizationService,
      PriceAmortizationService $priceAmortizationService,
      AmericanAmortizationService $americanAmortizationService
      )
    {
        $this->constantAmortizationService = $constantAmortizationService;
        $this->priceAmortizationService = $priceAmortizationService;
        $this->americanAmortizationService = $americanAmortizationService;
    }

    public function index()
    {
        return view('index')
          ->with('systems', AmortizationSystem::SYSTEM);
    }
    
    public function pdf(Request $request)
    {
      
    }

    public function table(Request $request)
    {
        $amount = $request->input('amount');
        $amount = str_replace('.', '', $amount);
        $amount = str_replace(',', '.', $amount);
        $interest = $request->input('interest');
        $interest = str_replace(',', '.', $interest);
        $quantity = $request->input('quantity');
        $system = $request->input('system');
        
        switch ($system) {
          case AmortizationSystem::SYSTEM_AMERICAN:
            $payments = $this->americanAmortizationService->calculate((float)$amount, (int)$quantity, (float)$interest);
            break;
          case AmortizationSystem::SYSTEM_PRICE:
            $payments = $this->priceAmortizationService->calculate((float)$amount, (int)$quantity, (float)$interest);
            break;
          case AmortizationSystem::SYSTEM_SAC:
            $payments = $this->constantAmortizationService->calculate((float)$amount, (int)$quantity, (float)$interest);
            break;
        }

        $parcelTotal = 0;
        $interestTotal = 0;
        $amortizationTotal = 0;

        foreach ($payments as $payment) {
            $parcelTotal += $payment->parcel;
            $interestTotal += $payment->interest;
            $amortizationTotal += $payment->amortization;
        }

        return view('result')
                ->with('payments', $payments)
                ->with('parcelTotal', $parcelTotal)
                ->with('interestTotal', $interestTotal)
                ->with('amortizationTotal', $amortizationTotal)
                ->with('amortizationLabel', AmortizationSystem::SYSTEM[$system]);
    }
}
