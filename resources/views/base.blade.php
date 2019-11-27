<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>🎓 The Logic Live - Árvore de refutação</title>

        <!-- Argon Theme CSS -->
        <link rel="stylesheet" type="text/css" href="assets\argon-dashboard\css\argon-dashboard.css">

        <!-- Custom CSS -->
        <link rel="stylesheet" type="text/css" href="assets\custom\custom.css">

        <!-- Font Awesome -->
        <script src="https://kit.fontawesome.com/f184d99102.js" crossorigin="anonymous"></script>

        <!-- Font do Google -->
        <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">
    </head>
    <body style="font-family: 'Montserrat', sans-serif;">
                <!-- Navbar Principal -->
                <div class="navbar shadow-sm style-color rounded-bottom-50">
                        <div class="container d-flex justify-content-center mt-2">
                            <div class="row ">
                                <!-- Logo -->
                                <div class="col-auto d-flex justify-content-center p-0">
                                    <img src="imagens/logo1.png" height="50">
                                </div>
                            </div>
                        </div>
                    </div>
        {{-- <!-- Navbar Principal -->
        <nav class="navbar justify-content-center navbar-light bg-light">
            <a class="navbar-brand" href="#">🎓 Logic Live - Árvore de refutação</a>
        </nav> --}}

        <!-- Conteúdo -->
        <div>
            @yield('content')
        </div>



        <div class=" mt-5 mb-0">
        <div class="container-fluid">
            <div class="col d-flex justify-content-center mb-2 mt-2">
                <div class="row">
                    <span>Feito por @Nalberthy</span>
                </div>
            </div>
        </div>
    </div>

        <!-- JQUERY 3.4.1 -->
        <script type="text/javascript" src="assets/plugins/jquery.min-3.4.1.js"></script>
        <!-- Argon Theme JS -->
        <script type="text/javascript" src="assets/argon-dashboard/js/argon-dashboard.js"></script>
        <!-- BS Custom File -->
        <script type="text/javascript" src="assets/plugins/bs-custom-file.js"></script>

        <!-- Scripts de inicialização -->
        <script>
            bsCustomFileInput.init()
        </script>
    </body>
</html>
