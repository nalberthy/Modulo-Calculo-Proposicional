<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Calculo Proposicional</title>

        <link rel="stylesheet" type="text/css" href="argon-dashboard\css\argon-dashboard.css">


    </head>
    <body>
        <nav class="navbar justify-content-center navbar-light bg-light">
                <a class="navbar-brand" href="#">Calculo Proposicional</a>
        </nav>

        <div>
            @yield('content')
        </div>



        <script type="text/javascript" src="argon-dashboard/js/argon-dashboard.js"></script>
    </body>
</html>