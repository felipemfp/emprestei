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

    .ui.form .field.error input {
      border-radius: 0;
      box-shadow: 0px 1px 5px #ccc!important;
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
  </style>
@endsection

@section('content')
  <div class="ui segment">
      @include('header')
      <form class="ui form" method="POST" action="/tabela">
        <div class="field">
          <label>Montante</label>
          <input name="amount" type="text" placeholder="0,00" data-mask="#.##0,00" data-mask-reverse="true" autofocus/>
        </div>
        <div class="field">
          <label>Taxa de Juros</label>
          <input name="interest" type="text" placeholder="0,15" data-mask="##0,00" data-mask-reverse="true"/>
        </div>
        <div class="field">
          <label>Quantidade de Parcelas</label>
          <input name="quantity" type="text" placeholder="12" data-mask="0#"/>
        </div>
        <div class="field">
          <label>Sistema</label>
          <select name="system" class="ui dropdown">
            <option value="">Selecione</option>
            @foreach ($systems as $key => $value)
              <option value="{{$key}}">{{$value}}</option>
            @endforeach
          </select>
        </div>
        <div class="buttons">
          <a href="https://cdn.rawgit.com/felipemfp/emprestei/ea7379d1/REFERENCIA.pdf" target="_blank">
            Saiba mais
          </a>
          <button class="ui primary button">
            Visualizar
          </button>
        </div>
      </form>
      @include('footer')
  </div>
@endsection

@section('script')
  <script>
    $(function() {
      $('.ui.dropdown').dropdown();
      $('.ui.form').form({
        inline: true,
        on: 'blur',
        fields: {
          amount: {
            rules: [{
              type:'empty',
              prompt: 'Insira o montante'
            }]
          },
          interest: {
            rules: [{
              type:'empty',
              prompt: 'Insira a taxa de juros'
            }]
          },
          quantity: {
            rules: [{
              type:'empty',
              prompt: 'Insira a quantidade de parcelas'
            }]
          },
          system: {
            rules: [{
              type:'empty',
              prompt: 'Selecione o sistema'
            }]
          }
        }
      });
    });
  </script>
@endsection
