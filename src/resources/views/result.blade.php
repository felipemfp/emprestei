@extends('layout')

@section('style')
  <style>
    .ui.segment {
      min-width: 30em;
      background: #f5f5f5;
      border-radius: 0;
      padding: 2em 4em;
    }

    .ui.form .field label {
      font-weight: 400;
    }

    .ui.form .field input {
      border: 0;
      border-radius: 0;
      background: #f5f5f5;
      box-shadow: 0px 1px 5px #ccc;
      text-align: right;
      height: 3em;
    }

    .ui.form .field input:focus {
      border-radius: 0;
      background: #fcfcfc;
      box-shadow: 0px 1px 5px #ccc;
    }

    .ui.form .field .ui.dropdown {
      border: 0;
      border-radius: 0;
      background: #f5f5f5;
      box-shadow: 0px 1px 5px #ccc;
      height: 3em;
    }

    .buttons {
      display: flex;
      align-items: center;
      justify-content: space-between;
    }

    .buttons .ui.button {
      border-radius: 0;
    }

    .footer {
      padding-top: 2em;
      color: #4F4F4F;
      text-align: center;
    }
  </style>
@endsection

@section('content')
  <div class="ui segment">
      <h1 class="ui header">
        <img class="ui image" src="/images/logo.svg" />
        <div class="content">
          Emprestei
        </div>
      </h1>
      <table class="ui celled striped table">
        <thead>
          <tr>
            <th colspan="5">
              Resultado
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
            <td>{{ $payment->period }}</td>
            <td>{{ $payment->parcel }}</td>
            <td>{{ $payment->interest }}</td>
            <td>{{ $payment->amortization }}</td>
            <td>{{ $payment->amountOwned }}</td>
          </tr>
        @endforeach
        <tr>
          <td>Total</td>
          <td>{{ $parcelTotal }}</td>
          <td>{{ $interestTotal }}</td>
          <td>{{ $amortizationTotal }}</td>
          <td> - </td>
        </tr>
      </tbody>
</table>
      <div class="footer">
        <p>
          Feito com <3 por <a href="https://github.com/felipemfp" target="_blank">Felipe</a> e <a href="https://github.com/chicobentojr" target="_blank">Francisco</a>
        </p>
      </div>
  </div>
@endsection

@section('script')
  <script>
    $(function() {
      $('.ui.dropdown').dropdown();
    });
  </script>
@endsection
