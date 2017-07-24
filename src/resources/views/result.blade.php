@extends('layout')

@section('style')
  @parent
  <style>
    .ui.segment {
      min-width: 30em;
      background: #f5f5f5;
      border-radius: 0;
      padding: 2em 4em;
    }

    .buttons {
      display: flex;
      align-items: center;
      justify-content: space-between;
    }

    .buttons .ui.button {
      border-radius: 0;
    }
    
    @media print {
      .ui.segment {
          background: inherit;
          box-shadow: inherit;
          padding: 0;
          border: 0;
          width: 100%;
      }
      .buttons {
        display: none;
      }
    }
  </style>
@endsection

@section('content')
  <div class="ui segment">
      @include('header')
      <table class="ui striped celled table">
        <thead>
          <tr>
            <th colspan="5">
              {{ $amortizationLabel }}
            </th>
          </tr>
          <tr>
            <th>Parcela</th>
            <th>Prestação</th>
            <th>Juros</th>
            <th>Amortização</th>
            <th>Saldo Devedor</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($payments as $payment)
            <tr>
              <td class="right aligned">{{ $payment->period }}</td>
              <td class="right aligned">R$ <span data-mask="#.##0,00" data-mask-reverse="true">{{ number_format($payment->parcel, 2) }}</span></td>
              <td class="right aligned">R$ <span data-mask="#.##0,00" data-mask-reverse="true">{{ number_format($payment->interest, 2) }}</span></td>
              <td class="right aligned">R$ <span data-mask="#.##0,00" data-mask-reverse="true">{{ number_format($payment->amortization, 2) }}</span></td>
              <td class="right aligned">R$ <span data-mask="#.##0,00" data-mask-reverse="true">{{ number_format($payment->amountOwned, 2) }}</span></td>
            </tr>
          @endforeach
        </tbody>
        <tfoot>
          <tr>
            <th>TOTAL</th>
            <th class="right aligned">R$ <span data-mask="#.##0,00" data-mask-reverse="true">{{ number_format($parcelTotal, 2) }}</span></th>
            <th class="right aligned">R$ <span data-mask="#.##0,00" data-mask-reverse="true">{{ number_format($interestTotal, 2) }}</span></th>
            <th class="right aligned">R$ <span data-mask="#.##0,00" data-mask-reverse="true">{{ number_format($amortizationTotal, 2) }}</span></th>
            <th class="right aligned"></th>
          </tr>
        </tfoot>
      </table>
      <div class="buttons">
        <a href="#">
          Saiba mais
        </a>
        <a href="{{ $pdfRoute }}" target="_blank" class="ui primary button">
          Baixar
        </a>
      </div>
      @include('footer')
  </div>
@endsection

@section('script')
  <script>
    $(function() {
      $('.ui.dropdown').dropdown();
    });
  </script>
@endsection
