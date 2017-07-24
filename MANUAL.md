# Emprestei

## Instalando

### Recursos necessários

- [Docker](https://docs.docker.com/engine/installation/linux/docker-ce/ubuntu/#recommended-extra-packages-for-trusty-1404)
- [Docker Compose](https://docs.docker.com/compose/install/#install-as-a-container)

### Passo a Passo

Clonando pro seu computador:

```
$ git clone https://github.com/felipemfp/emprestei
$ cd emprestei
```

Configurando o app:

```
$ ./deploy.sh
```

Rodando a aplicação:

```
$ docker-compose up
```

## Executando

### Passo a Passo

- Inserindo os dados:
  - Na tela inicial, insira o valor do empréstimo no campo **Montante**, a taxa de juros mensal no campo de **Taxa de Juros** e a quantidade de pagamento para empréstimo no campo **Quantidade de Parcelas**.
- Selecionando forma de amortização:
  - Clique no campo **Sistema** para abrir a lista de sistemas amortização possíveis para o cálculo. A lista contém os seguintes sistemas:
    - [Americano](https://pt.wikipedia.org/wiki/Sistema_de_Amortiza%C3%A7%C3%A3o_Americano)
    - [SAC](https://pt.wikipedia.org/wiki/Sistema_de_Amortiza%C3%A7%C3%A3o_Constante)
    - [Tabela Price](https://pt.wikipedia.org/wiki/Tabela_Price)
- Executando cálculo:
  - Após a inserção dos dados, clique no botão **Visualizar** para ver a tabela de amortização resultante dos dados inseridos.
- Imprimindo tabela:
  - Na página com os resultados, clique no botão **Baixar** para realizar o download de um arquivo .pdf com a tabela de amortização preenchida.
