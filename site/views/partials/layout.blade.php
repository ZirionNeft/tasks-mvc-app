<!DOCTYPE html>
<html lang="ru" >
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <title>Список задач</title>
  <meta name="description" content="">
  <meta name="author" content="">

</head>
<body>
    @include('partials.header')


  <div class="container">
    @isset($alert)
      <div class="alert alert-{{ $alert['status'] }} m-5" role="alert">
        {{ $alert['text'] }}
      </div>
    @endisset
    @yield('content')
  </div><!-- /.container -->

  <script src="./../../dist/app.bundle.js"></script>
@yield('footer_scripts')
</body>
</html>