<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('img/apple-icon.png') }}">
    <link rel="icon" type="image/png" href="{{ asset('img/favicon.ico') }}">
    <title>
        {{ env('APP_NAME') }}
    </title>
    <!-- Fonts and icons -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rubik&display=swap" rel="stylesheet">

    <!-- Nucleo Icons -->
    <link href="{{ asset('/app/css/nucleo-icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('/app/css/nucleo-svg.css') }}" rel="stylesheet" />

    <!-- Tom Select -->
    <link href="https://cdn.jsdelivr.net/npm/tom-select/dist/css/tom-select.css" rel="stylesheet">

    <!-- Flatpickr -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

    <!-- Vanilla calendar -->
    <link href="{{ asset('/app/css/vanilla-calendar.min.css') }}" rel="stylesheet">

    <!-- Filepond stylesheet -->
    <link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet">
    <link
            href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css"
            rel="stylesheet"
    />

    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/4b767d74ef.js" crossorigin="anonymous"></script>
    <link href="{{ asset('/app/css/nucleo-svg.css') }}" rel="stylesheet" />

    <!-- Flatpickr -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="https://unpkg.com/flatpickr@4.6.9/dist/plugins/monthSelect/style.css">

    <!-- CSS Files -->
    <link id="pagestyle" href="{{ asset('/app/css/soft-ui-dashboard.css?v=1.0.2') }}" rel="stylesheet" />
    <link id="pagestyle" href="{{ asset('/app/css/dark-theme-core.css') }}" rel="stylesheet" />
    <link href="{{ asset('/app/css/app.css') }}" rel="stylesheet" />

    @if(session()->has('status'))
        <link rel="stylesheet" href="{{ asset('app/plugins/growl-notification/colored-theme.min.css') }}">
    @endif

    @stack('styles')
</head>
