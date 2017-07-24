<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        return view('index');
    }

    public function post(Request $request)
    {
        $input = $request->all();

        $amount = $input['amount'];
        $interest = $input['interest'];
        $quantity = $input['quantity'];
        $system = $input['system'];


        switch ($system) {
          case 1:
            $payments = $this->americanAmortizationService->calculate($amount, $quantity, $interest);
            break;
          case 2:
            $payments = $this->priceAmortizationService->calculate($amount, $quantity, $interest);
            break;
          case 3:
            $payments = $this->constantAmortizationService->calculate($amount, $quantity, $interest);
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
                ->with('amortizationTotal', $amortizationTotal);
    }
}
