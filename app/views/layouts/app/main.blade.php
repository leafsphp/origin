<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>{{ $title ?? getenv('APP_NAME')  }}</title>

        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        {!! csrf_meta() !!}
        
        <meta content="Coderthemes" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@400;500;600;700&display=swap">
		<link href="/assets/fonts/phosphor/duotone/style.css" rel="stylesheet"/>
        
        <link rel="shortcut icon" href="/assets/images/favicon.ico">
        <link href="/assets/css/bootstrap5.min.css" rel="stylesheet"/>
        <link href="/assets/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-stylesheet" />
        <link href="/assets/css/app.min.css" rel="stylesheet" id="app-stylesheet" />
        <link href="/assets/css/iziToast.min.css" rel="stylesheet"/>
        <link href="/assets/css/app.css" rel="stylesheet"/>

    </head>

    <body data-layout="horizontal">

        <div id="wrapper">
            @include('layouts.app.partials.topbar')

            @yield('content')

        </div>

        <script src="/assets/js/vendor.min.js"></script>
        <script src="/assets/js/app.min.js"></script>
        <script src="/assets/js/iziToast.min.js"></script>
        <script src="/assets/js/app.js"></script>

        @stack('scripts')

    </body>
</html>