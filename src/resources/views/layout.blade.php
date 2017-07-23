<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Emprestei</title>
    <link href="https://fonts.googleapis.com/css?family=Lato:300" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.11/semantic.min.css" />
    <style>
    html, body {
      background: #56CCF2;  /* fallback for old browsers */
      background: -webkit-linear-gradient(to right, #56CCF2, #2D9CDB);  /* Chrome 10-25, Safari 5.1-6 */
      background: linear-gradient(to right, #56CCF2, #2D9CDB); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
    }

    body {
      display: flex;
      justify-content: center;
      align-items: center;
      align-content: center;
    }

    main {
      max-width: 920px;
    }

    .ui.header {
      font-weight: 300;
      text-align: center;
    }

    .ui.header .ui.image {
      width: 2em;
    }
    </style>
    @yield('style')
  </head>
  <body>
    <main>
      @yield('content')
    </main>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.11/semantic.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>
    @yield('script')
  </body>
</html>
