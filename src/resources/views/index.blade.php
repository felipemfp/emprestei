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
      <form class="ui form" method="POST" action="/">
        <div class="field">
          <label>Montante</label>
          <input name="amount" type="text" placeholder="R$ 0,00" autofocus/>
        </div>
        <div class="field">
          <label>Taxa de Juros</label>
          <input name="interest" type="text" placeholder="0,15%" />
        </div>
        <div class="field">
          <label>Quantidade de Parcelas</label>
          <input name="quantity" type="text" placeholder="12" />
        </div>
        <div class="field">
          <label>Sistema</label>
          <select name="system" class="ui dropdown">
            <option value="">Selecione</option>
            <option value="1">Americano</option>
            <option value="2">Price</option>
            <option value="3">SAC</option>
          </select>
        </div>
        <div class="buttons">
          <a href="#">
            Saiba mais
          </a>
          <button class="ui primary button">
            Visualizar
          </button>
        </div>
      </form>
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
