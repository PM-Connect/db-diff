<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>@yield('title', 'DBDiff')</title>

    <script>
        window.Laravel = { csrfToken: '{{ csrf_token() }}' };
    </script>

    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>

    @include('partials.header')

    <div id="app">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 col-md-6 col-mg-offset-3">
                @yield('content')
            </div>
        </div>

        <alerts></alerts>
    </div>

    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>