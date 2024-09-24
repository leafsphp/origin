<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>{{ getenv('APP_NAME') }} {{ $title ? ":: $title" : null  }}</title>

        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        {!! csrf_meta() !!}
        
        <meta content="Coderthemes" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        
        <link rel="shortcut icon" href="/assets/images/favicon.ico">
        <link href="/assets/css/bootstrap5.min.css" rel="stylesheet"/>
        <link href="/assets/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-stylesheet" />
		<link href="/assets/fonts/phosphor/duotone/style.css" rel="stylesheet"/>
        <link href="/assets/css/app.min.css" rel="stylesheet" id="app-stylesheet" />
        <link href="/assets/css/iziToast.min.css" rel="stylesheet"/>

        <style>
            input[name="password"]::placeholder {
                font-size: 1.3rem;
            }

            .card {
                border-radius: 1.5rem;
            }

            .togglePassword {
                position: absolute;
                right: .5rem;
                bottom: .7rem;
                cursor: pointer;
            }

        </style>
    </head>

    <body style="background: url('/assets/images/vector/gbg.jpg') center center; background-size: cover;">

        <div class="account-pages my-5 pt-5">
            <div class="container mt-5">
                <div class="row justify-content-center">
                    <div class="col-md-8 col-xl-5">
                        @yield('content')      
                    </div>
                </div>
            </div>
        </div>

        <script src="/assets/js/vendor.min.js"></script>
        <script src="/assets/js/app.min.js"></script>
        <script src="/assets/js/iziToast.min.js"></script>
        <script src="/assets/js/app.js"></script>

        @stack('scripts')

    </body>
</html>